<?php

namespace App\Http\Controllers\Admin\SettlementRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettlementRequest;

class SettlementRequestController extends Controller
{

    public $model = SettlementRequest::class;
    public $searchable = ['title', 'title_ar'];
    public $view = "admin.settlement_requests";
    public $route = "admin.settlement_requests";
    public $redirect = "admin.settlement_requests";
    public $notify = "SettlementRequest";
    public $file_path = "settlement_requests";
    public $is_list = true;
    public $is_form = true;
    public $is_category = false;
    
    public function index()
    {
        $datas = $this->model::searchable(request()->search, $this->searchable)->latest()->paginate(10);
        $route = $this->route;
        $title = $this->notify;
        $file_path = $this->file_path;
        $emptyMessage = __('No data found');
        $is_list = $this->is_list;
        $is_form = $this->is_form;
        $is_category = $this->is_category;
        return view($this->view . '.index', compact('datas', 'route', 'title', 'file_path', 'emptyMessage', 'is_list', 'is_form', 'is_category'));
    }

    public function create()
    {
        $route = $this->route;
        $title = $this->notify;
        $file_path = $this->file_path;
        $is_category = $this->is_category;
        return view($this->view . '.create', compact('route', 'title', 'file_path', 'is_category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $data = $this->model::create([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'description' => $request->description,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ]);


        if ($request->hasFile('image')) {
            $data->update([
                'image' => fileUploader($request->image, getFilePath($this->file_path)),
            ]);
        }


        $notify[] = ['success', $this->notify . __('created successfully')];

        return redirect()->route($this->route . '.index')->withNotify($notify);
    }

    public function edit($id)
    {
        $data = $this->model::findOrFail($id);
        $route = $this->route;
        $title = $this->notify;
        $file_path = $this->file_path;
        $is_category = $this->is_category;
        return view($this->view . '.edit', compact('data', 'route', 'title', 'file_path', 'is_category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $this->model::findOrFail($id);

        $data->update([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'description' => $request->description,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ]);


        if ($request->hasFile('image')) {
            $data->update([
                'image' => fileUploader($request->image, getFilePath($this->file_path)),
            ]);
        }


        $notify[] = ['success', $this->notify . __('updated successfully')];

        return redirect()->route($this->route . '.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $data = $this->model::findOrFail($id);

        if ($data->image) {
            fileDeleter($data->image, getFilePath($this->file_path));
        }

        
        $data->delete();

        $notify[] = ['success', $this->notify . __('deleted successfully')];

        return redirect()->route($this->route . '.index')->withNotify($notify);
    }
}
