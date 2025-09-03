<?php

namespace App\Http\Controllers\Admin\Events;

use App\Models\EventNews;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;

class EventNewsController extends Controller
{
    public function index()
    {
        $events = $this->propertyData();
        return view('admin.event_news.index', compact('events'));
    }

    public function pending()
    {
        $events = $this->propertyData('inactive');
        return view('admin.event_news.index', compact('events'));
    }

    public function published()
    {
        $events = $this->propertyData('active');
        return view('admin.event_news.index', compact('events'));
    }

    protected function propertyData($scope = null)
    {
        if ($scope) {
            $events = EventNews::$scope();
        } else {
            $events = EventNews::query();
        }
        return $events->searchable(['title'])->latest()->paginate(getPaginate());
    }



    public function create()
    {

        return view('admin.event_news.create' );
    }

    public function store(Request $request)
    {
        $request->validate([
            "title"              => "required|string|max:191",
            "title_ar"           => "required|string|max:191",
            "slug"               => "required|string|unique:event_news,slug",
            "image"              => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            "description"        => "required",
            "description_ar"     => "required",
        ]);


        try{
            $event = new EventNews();
            $event->title = $request->title;
            $event->title_ar = $request->title_ar;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->description_ar = $request->description_ar;

            if ($request->hasFile('image')) {
                try {
                    $old = $event->image;
                    $event->image = fileUploader($request->image, getFilePath('event_news'), getFileSize('event_news'), $old);
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Couldn\'t upload your image'];
                    return back()->withNotify($notify);
                }
            }

            $event->save();

            $message = __('Event created successful!');
            $notify[] = ['success', $message];
            return to_route('admin.event_news.index')->withNotify($notify);

        }catch(\Exception $e){
            $message = $e->getMessage();
            $notify[] = ['success', $message];
            return back()->withNotify($notify);
        }
    }

    public function edit($id)
    {

        $data['event'] = EventNews::find($id);
        return view('admin.event_news.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title"              => "required|string|max:191",
            "title_ar"           => "required|string|max:191",
            "slug"               => "required|string|unique:events,slug,$id", // Exclude current ID from unique check
            "image"              => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            "description"        => "required|string",
            "description_ar"     => "required|string",
        ]);
        
        
        



        try{
           // return $end_time;
            $event = EventNews::find($id);
            $event->title = $request->title;
            $event->title_ar = $request->title_ar;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->description_ar = $request->description_ar;

            if ($request->hasFile('image')) {
                try {
                    $old = $event->image;
                    $event->image = fileUploader($request->image, getFilePath('event_news'), getFileSize('event_news'), $old);
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Couldn\'t upload your image'];
                    return back()->withNotify($notify);
                }
            }

            $event->save();

            $message = __('Event news updated successful!');
            $notify[] = ['success', $message];
            return to_route('admin.event_news.index')->withNotify($notify);

        }catch(\Exception $e){
            $message = $e->getMessage();
            $notify[] = ['success', $message];
            return back()->withNotify($notify);
        }
    }

    public function status($id, $status)
    {
        $event = EventNews::findOrFail($id);
        $event->status = $status;
        $event->save();
        $notify[] = ['success', __('Change Status Successfully')];
        return back()->withNotify($notify);

    }

    public function show($id)
    {
        $event = EventNews::findOrFail($id);
        return view('admin.event_news.show', compact('event'));
    }

}
