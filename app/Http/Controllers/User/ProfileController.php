<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $countries = \App\Models\Country::orderByRaw('ISNULL(sort_order), sort_order')->get();
        return view('user.profile_setting', compact('user', 'countries'));
    }

    public function submitProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:192',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'country' => 'required|exists:countries,id',
            'city' => 'required|string|max:192',
            'mobile' => 'required|regex:/^([0-9]*)$/|unique:users,mobile,'.$user->id,
            'email' => 'required|string|email|unique:users,email,'.$user->id,
            'national_id_number' => 'required|string|max:192',
            'date_of_birth' => 'required|date',
            'preferred_investment_sectors' => 'nullable|array',
            'preferred_investment_sectors_other' => 'nullable|string|max:255',
            'is_regular_opportunity_alert' => 'nullable|in:yes',
            'identity_proof' => 'nullable|in:resume_or_investor_profile,identity_proof',
            'file_upload' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        // Handle identity proof file upload
        if ($request->hasFile('file_upload')) {
            try {
                $old = $user->identity_proof_file;
                $user->identity_proof_file = fileUploader(
                    $request->file_upload, 
                    'uploads/user_documents',
                    null,
                    $old
                );
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload identity proof file'];
                return back()->withNotify($notify);
            }
        }

        // Handle profile image
        if ($request->hasFile('image')) {
            try {
                $old = $user->image;
                $user->image = fileUploader(
                    $request->image, 
                    getFilePath('userProfile'), 
                    getFileSize('userProfile'), 
                    $old
                );
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        // Process preferred investment sectors
        $preferredInvestmentSectors = [];
        if ($request->has('preferred_investment_sectors')) {
            $sectors = $request->preferred_investment_sectors;
            
            // If "Other" is selected and a value is provided, use that value
            if (in_array('Other', $sectors) && $request->preferred_investment_sectors_other) {
                // Remove "Other" from the array and add the custom value
                $sectors = array_filter($sectors, function($value) {
                    return $value !== 'Other';
                });
                $sectors[] = $request->preferred_investment_sectors_other;
            }
            
            $preferredInvestmentSectors = array_filter($sectors);
        }

        // Update user data
        $user->name = $request->name;
        $user->country_id = $request->country;
        $user->city = $request->city;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->val_license_number = $request->national_id_number;
        $user->date_of_birth = $request->date_of_birth;
        $user->services_provided = !empty($preferredInvestmentSectors) ? json_encode($preferredInvestmentSectors) : null;
        $user->is_regular_opportunity_alert = $request->has('is_regular_opportunity_alert') ? 1 : 0;
        $user->identity_proof_type = $request->identity_proof;
        
        // Calculate age from date of birth for age_of_company field
        if ($request->date_of_birth) {
            $dateOfBirth = new \DateTime($request->date_of_birth);
            $today = new \DateTime();
            $age = $today->diff($dateOfBirth)->y;
            $user->age_of_company = $age;
        }

        $user->address = [
            'address' => @$user->address->address,
            'state' => @$user->address->state,
            'zip' => @$user->address->zip,
            'country' => @$user->address->country,
            'city' => $request->city,
        ];

        $user->save();

        $notify[] = ['success', 'Profile updated successfully'];
        return back()->withNotify($notify);
    }

    public function changePassword()
    {
        return view('user.password');
    }

    public function submitPassword(Request $request)
    {
        $passwordValidation = Password::min(6);
        if (gs('secure_password')) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'password' => ['required', 'confirmed', $passwordValidation],
        ]);

        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            $password = Hash::make($request->password);
            $user->password = $password;
            $user->save();
            $notify[] = ['success', 'Password changes successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'The password doesn\'t match!'];
            return back()->withNotify($notify);
        }
    }
}