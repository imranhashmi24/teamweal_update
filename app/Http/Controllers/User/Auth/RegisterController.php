<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use App\Models\Country;
use App\Constants\Status;
use App\Models\UserLogin;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('registration.status');
    }

    public function showRegistrationForm()
    {
        $countries = Country::orderByRaw('ISNULL(sort_order), sort_order')->get();
        return view('user.auth.register', compact('countries'));
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $exist = User::where('mobile', $request->mobile)->first();
        if ($exist) {
            $notify[] = ['error', 'The mobile number already exists'];
            return back()->withNotify($notify)->withInput();
        }

        event(new Registered($user = $this->create($request->all())));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    protected function validator(array $data)
    {
        $general = gs();
        $passwordValidation = Password::min(6);
        if ($general->secure_password) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }
        $agree = 'nullable';
        if ($general->agree) {
            $agree = 'required';
        }
    
        $validate = Validator::make($data, [
            'email' => 'required|string|email|unique:users',
            'mobile' => 'required|unique:users|regex:/^([0-9]*)$/',
            'name' => 'required|string|max:192',
            'city' => 'required|string|max:192',
            'country' => 'required|exists:countries,id',
            'national_id_number' => 'required|string|max:192',
            'date_of_birth' => 'required|date',
            'preferred_investment_sectors' => 'nullable|array',
            'is_regular_opportunity_alert' => 'nullable|in:yes',
            'identity_proof' => 'nullable|in:resume_or_investor_profile,identity_proof',
            'file_upload' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'password' => ['required', 'confirmed', $passwordValidation],
            'captcha' => 'sometimes|required',
            'agree' => $agree
        ], [
            // General validation messages
            'required' => __('This field is required'),
            'string' => __('Please enter a valid text'),
            'email' => __('Please enter a valid email address'),
            'unique' => __('This value is already taken'),
            'max.string' => __('Text should not exceed :max characters'),
            'max.file' => __('File size should not exceed :max KB'),
            'in' => __('The selected value is invalid'),
            'exists' => __('The selected value does not exist'),
            'date' => __('Please enter a valid date'),
            'array' => __('Please select valid options'),
            'file' => __('Please upload a valid file'),
            'mimes' => __('Allowed file types: :values'),
            'confirmed' => __('Confirmation does not match'),
            'regex' => __('Invalid format'),
            
            // Field-specific messages
            'email.required' => __('Please enter your email address'),
            'email.email' => __('Please enter a valid email'),
            'email.unique' => __('This email is already registered'),
            'mobile.required' => __('Please enter your mobile number'),
            'mobile.unique' => __('This mobile number is already registered'),
            'mobile.regex' => __('Mobile number should contain only numbers'),
            'name.required' => __('Please enter your name'),
            'city.required' => __('Please enter your city'),
            'country.required' => __('Please select your country'),
            'national_id_number.required' => __('Please enter your national ID/Iqama number'),
            'date_of_birth.required' => __('Please enter your date of birth'),
            'password.required' => __('Please enter a password'),
            'password.confirmed' => __('Password confirmation does not match'),
            'agree.required' => __('You must agree to the terms and conditions')
        ]);
    
        return $validate;
    }

    protected function create(array $data)
    {
        // Handle file upload
        $fileUploadPath = null;
        if (isset($data['file_upload'])) {
            $fileUploadPath = $data['file_upload']->store('uploads/user_documents', 'public');
        }

        // Process preferred investment sectors
        $preferredInvestmentSectors = null;
        if (isset($data['preferred_investment_sectors'])) {
            // Filter out empty values and "Other" if no specific value is provided
            $preferredInvestmentSectors = array_filter($data['preferred_investment_sectors'], function($value) {
                return !empty($value) && $value !== 'Other';
            });
            $preferredInvestmentSectors = !empty($preferredInvestmentSectors) ? json_encode($preferredInvestmentSectors) : null;
        }

        // User Create
        $user = new User();
        $user->email = strtolower($data['email']);
        $user->password = Hash::make($data['password']);
        $user->mobile = $data['mobile'];
        $user->name = $data['name'];
        $user->city = $data['city'];
        $user->country_id = $data['country'];
        $user->national_id_number = $data['national_id_number'];
        $user->date_of_birth = $data['date_of_birth'];
        $user->preferred_investment_sectors = $preferredInvestmentSectors;
        $user->is_regular_opportunity_alert = isset($data['is_regular_opportunity_alert']) ? Status::YES : Status::NO;
        $user->identity_proof_type = $data['identity_proof'] ?? null;
        $user->identity_proof_file = $fileUploadPath;
        
        // Set default values for fields not in the form
        $user->username = $this->generateUsername($data['name']);
        $user->address = [
            'address' => '',
            'state' => '',
            'zip' => '',
            'city' => $data['city']
        ];
        $user->ev = gs()->ev ? Status::NO : Status::YES;
        $user->sv = gs()->sv ? Status::NO : Status::YES;
        $user->profile_complete = Status::YES; 
        $user->save();

        // Admin Notification
        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New service provider registered';
        $adminNotification->click_url = urlPath('admin.users.detail', $user->id);
        $adminNotification->save();

        // Login Log Create
        $ip = getRealIP();
        $exist = UserLogin::where('user_ip', $ip)->first();
        $userLogin = new UserLogin();

        if ($exist) {
            $userLogin->longitude = $exist->longitude;
            $userLogin->latitude = $exist->latitude;
            $userLogin->city = $exist->city;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country = $exist->country;
        } else {
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude = @implode(',', $info['long']);
            $userLogin->latitude = @implode(',', $info['lat']);
            $userLogin->city = @implode(',', $info['city']);
            $userLogin->country_code = @implode(',', $info['code']);
            $userLogin->country = @implode(',', $info['country']);
        }

        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip = $ip;
        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();

        return $user;
    }

    /**
     * Generate a unique username from the name
     */
    protected function generateUsername($name)
    {
        $baseUsername = strtolower(str_replace(' ', '', $name));
        $username = $baseUsername;
        $counter = 1;
        
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }
        
        return $username;
    }

    public function checkUser(Request $request)
    {
        $exist['data'] = false;
        $exist['type'] = null;
        if ($request->email) {
            $exist['data'] = User::where('email', $request->email)->exists();
            $exist['type'] = 'email';
        }
        if ($request->mobile) {
            $exist['data'] = User::where('mobile', $request->mobile)->exists();
            $exist['type'] = 'mobile';
        }
        if ($request->username) {
            $exist['data'] = User::where('username', $request->username)->exists();
            $exist['type'] = 'username';
        }
        return response($exist);
    }
}