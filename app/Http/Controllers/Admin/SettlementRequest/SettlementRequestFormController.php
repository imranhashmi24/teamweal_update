<?php

namespace App\Http\Controllers\Admin\SettlementRequest;

use Illuminate\Http\Request;
use App\Models\SettlementRequestForm;
use App\Http\Controllers\Controller;

class SettlementRequestFormController extends Controller
{

    public $model = SettlementRequestForm::class;
    public $searchable = ['name', 'name_ar'];
    public $view = "admin.settlement_requests.forms";
    public $route = "admin.settlement_requests.forms";
    public $redirect = "admin.settlement_requests.forms";
    public $notify = "SettlementRequestForm";
    public $file_path = "settlement_requests";


    public function index($service_id)
    {
        $datas = $this->model::where('service_id', $service_id)->searchable(request()->search, $this->searchable)->latest()->paginate(10);
        $route = $this->route;
        $title = $this->notify;
        return view($this->view . '.index', compact('datas', 'service_id', 'route', 'title'));
    }

    public function create($service_id)
    {
        $route = $this->route;
        $title = $this->notify;
        return view($this->view . '.create', compact('service_id', 'route', 'title'));
    }

    public function store(Request $request, $service_id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'required' => 'required|in:yes,no',
            'col' => 'required|numeric|between:1,12',
            'placeholder' => 'nullable|string|max:255',
            'placeholder_ar' => 'nullable|string|max:255',
            'options' => 'nullable|array',
            'options_ar' => 'nullable|array',
            'status' => 'required|in:active,inactive',
        ]);


        $options = $request->options;
        $options_ar = $request->options_ar;

        // convert options to array
        $options = json_encode($options);
        $options_ar = json_encode($options_ar);

        $form = $this->model::create([
            'service_id' => $service_id,
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'type' => $request->type,
            'required' => $request->required,
            'col' => $request->col,
            'placeholder' => $request->placeholder,
            'placeholder_ar' => $request->placeholder_ar,
            'options' => $options,
            'options_ar' => $options_ar,
            'status' => $request->status,
        ]);

        if ($form) {
            $notify[] = ['success', __('Form created successfully')];
            return redirect()->route($this->route . '.index', $service_id)->with($notify);
        }

        $notify[] = ['error', __('Form created failed')];
        return redirect()->route($this->route . '.index', $service_id)->with($notify);
    }

    public function edit($service_id, $id)
    {
        $form = $this->model::where('service_id', $service_id)->where('id', $id)->firstOrFail();
        $route = $this->route;
        $title = $this->notify;
        return view($this->view . '.edit', compact('form', 'service_id', 'route', 'title'));
    }

    public function update(Request $request, $service_id, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'required' => 'required|in:yes,no',
            'col' => 'required|numeric|between:1,12',
            'placeholder' => 'nullable|string|max:255',
            'placeholder_ar' => 'nullable|string|max:255',
            'options' => 'nullable|array',
            'options_ar' => 'nullable|array',
            'status' => 'required|in:active,inactive',
        ]);

        $form = $this->model::where('service_id', $service_id)->where('id', $id)->firstOrFail();

        $options = $request->options;
        $options_ar = $request->options_ar;

        // convert options to array
        $options = json_encode($options);
        $options_ar = json_encode($options_ar);

        $form->update([
            'service_id' => $service_id,
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'type' => $request->type,
            'required' => $request->required,
            'col' => $request->col,
            'placeholder' => $request->placeholder,
            'placeholder_ar' => $request->placeholder_ar,
            'options' => $options,
            'options_ar' => $options_ar,
            'status' => $request->status,
        ]);

        if ($form) {
            $notify[] = ['success', $this->notify . ' updated successfully'];
            return redirect()->route($this->route . '.index', $service_id)->with($notify);
        }

        $notify[] = ['error', $this->notify . ' updated failed'];
        return redirect()->route($this->route . '.index', $service_id)->with($notify);
    }

    public function destroy($service_id, $id)
    {
        $form = $this->model::where('service_id', $service_id)->where('id', $id)->firstOrFail();
        $form->delete();

        if ($form) {
            $notify[] = ['success', $this->notify . ' deleted successfully'];
            return redirect()->route($this->route . '.index', $service_id)->with($notify);
        }

        $notify[] = ['error', $this->notify . ' deleted failed'];
        return redirect()->route($this->route . '.index', $service_id)->with($notify);
    }

    public function status($service_id, $id)
    {
        $form = $this->model::where('service_id', $service_id)->where('id', $id)->firstOrFail();
        $form->update([
            'status' => $form->status == 'active' ? 'inactive' : 'active',
        ]);

        if ($form) {
            $notify[] = ['success', $this->notify . ' status updated successfully'];
            return redirect()->route($this->route . '.index', $service_id)->with($notify);
        }

        $notify[] = ['error', $this->notify . ' status updated failed'];
        return redirect()->route($this->route . '.index', $service_id)->with($notify);
    }
}
