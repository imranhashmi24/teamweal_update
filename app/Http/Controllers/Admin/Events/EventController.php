<?php

namespace App\Http\Controllers\Admin\Events;

use App\Http\Controllers\Controller;
use App\Models\AllCategory;
use App\Models\Event;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;

class EventController extends Controller
{
    public function index()
    {
        $events = $this->propertyData();
        return view('admin.event.index', compact('events'));
    }

    public function pending()
    {
        $events = $this->propertyData('inactive');
        return view('admin.event.index', compact('events'));
    }

    public function published()
    {
        $events = $this->propertyData('active');
        return view('admin.event.index', compact('events'));
    }

    protected function propertyData($scope = null)
    {
        if ($scope) {
            $events = Event::$scope();
        } else {
            $events = Event::query();
        }
        return $events->searchable(['country:name', 'city:name', 'category:name'])->latest()->paginate(getPaginate());
    }

    // $auctionMethodologyElements = getContent('auction_methodology.element', null, false, true);

    public function create()
    {
        $data['eventTypeElements'] = getContent('event_type.element', null, false, true);
        $data['audienceTypeElements'] = getContent('audience_type.element', null, false, true);
        $data['eventSectorElements'] = getContent('event_sector.element', null, false, true);
        $data['categories'] = AllCategory::where('type', 'event')->get();

        $o_countries = Country::orderByRaw('ISNULL(sort_order), sort_order')->with('city')->get();
        $data['countries'] = sortOrder($o_countries);
        
        return view('admin.event.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "title"              => "required|string|max:191",
            "title_ar"           => "required|string|max:191",
            "slug"               => "required|string|unique:events,slug",
            "category_id"        => "required|exists:all_categories,id",
            "type"               => "required|max:191",
            "audience_type"      => "required|max:191",
            "sector"             => "required|max:191",
            "start_time"         => "nullable",
            "end_time"           => "nullable",
            "same_time"          => "nullable",
            "same_time_date"     => "nullable",
            "country_id"         => "required|exists:countries,id",
            "city_id"            => "nullable|exists:cities,id",
            "latitude"           => "nullable",
            "longitude"          => "nullable",
            "address"            => "required",
            "image"              => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            "description"        => "required",
            "description_ar"     => "required",
        ]);


        try{

            $start_time = $request->same_time == 1 ? $request->same_time_date : $request->start_time;
            $end_time   = $request->same_time == 1 ? $request->same_time_date : $request->end_time;

           // return $end_time;

            $event = new Event();
            $event->title = $request->title;
            $event->title_ar = $request->title_ar;
            $event->slug = $request->slug;
            $event->category_id = $request->category_id;
            $event->type = $request->type;
            $event->audience_type = $request->audience_type;
            $event->sector = $request->sector;
            $event->start_time = $start_time;
            $event->end_time = $end_time;
            $event->same_time = $request->same_time == 1 ? 1 : 0;
            $event->country_id = $request->country_id;
            $event->city_id = $request->city_id;
            $event->latitude = $request->latitude;
            $event->longitude = $request->longitude;
            $event->address = $request->address;
            $event->description = $request->description;
            $event->description_ar = $request->description_ar;

            if ($request->hasFile('image')) {
                try {
                    $old = $event->image;
                    $event->image = fileUploader($request->image, getFilePath('events'), getFileSize('events'), $old);
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Couldn\'t upload your image'];
                    return back()->withNotify($notify);
                }
            }

            $event->save();

            $message = __('Event created successful!');
            $notify[] = ['success', $message];
            return to_route('admin.events.index')->withNotify($notify);

        }catch(\Exception $e){
            $message = $e->getMessage();
            $notify[] = ['success', $message];
            return back()->withNotify($notify);
        }
    }

    public function edit($id)
    {
        $data['eventTypeElements'] = getContent('event_type.element', null, false, true);
        $data['audienceTypeElements'] = getContent('audience_type.element', null, false, true);
        $data['eventSectorElements'] = getContent('event_sector.element', null, false, true);
        $data['categories'] = AllCategory::where('type', 'event')->get();
        $o_countries = Country::orderByRaw('ISNULL(sort_order), sort_order')->with('city')->get();
        $data['countries'] = sortOrder($o_countries);
        $data['event'] = Event::find($id);
        return view('admin.event.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title"              => "required|string|max:191",
            "title_ar"           => "required|string|max:191",
            "slug"               => "required|string|unique:events,slug,$id", // Exclude current ID from unique check
            "category_id"        => "required|exists:all_categories,id",
            "type"               => "required|max:191",
            "audience_type"      => "required|max:191",
            "sector"             => "required|max:191",
            "start_time"         => "nullable|date",
            "end_time"           => "nullable|date|after:start_time",
            "same_time"          => "nullable",
            "same_time_date"     => "nullable|date",
            "country_id"         => "required|exists:countries,id",
            "city_id"            => "nullable|exists:cities,id",
            "latitude"           => "nullable",
            "longitude"          => "nullable",
            "address"            => "required|string",
            "image"              => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            "description"        => "required|string",
            "description_ar"     => "required|string",
        ]);



        try{

            $start_time = $request->same_time == 1 ? $request->same_time_date : $request->start_time;
            $end_time   = $request->same_time == 1 ? $request->same_time_date : $request->end_time;

           // return $end_time;
            $event = Event::find($id);
            $event->title = $request->title;
            $event->title_ar = $request->title_ar;
            $event->slug = $request->slug;
            $event->category_id = $request->category_id;
            $event->type = $request->type;
            $event->audience_type = $request->audience_type;
            $event->sector = $request->sector;
            $event->start_time = $start_time;
            $event->end_time = $end_time;
            $event->same_time = $request->same_time == 1 ? 1 : 0;
            $event->country_id = $request->country_id;
            $event->city_id = $request->city_id;
            $event->latitude = $request->latitude;
            $event->longitude = $request->longitude;
            $event->address = $request->address;
            $event->description = $request->description;
            $event->description_ar = $request->description_ar;


            if ($request->hasFile('image')) {
                try {
                    $old = $event->image;
                    $event->image = fileUploader($request->image, getFilePath('events'), getFileSize('events'), $old);
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Couldn\'t upload your image'];
                    return back()->withNotify($notify);
                }
            }

            $event->save();

            $message = __('Event updated successful!');
            $notify[] = ['success', $message];
            return to_route('admin.events.index')->withNotify($notify);

        }catch(\Exception $e){
            $message = $e->getMessage();
            $notify[] = ['success', $message];
            return back()->withNotify($notify);
        }
    }

    public function status($id, $status)
    {
        $event = Event::findOrFail($id);
        $event->status = $status;
        $event->save();
        $notify[] = ['success', __('Change Status Successfully')];
        return back()->withNotify($notify);

    }

    public function show($id)
    {
        $event = Event::with( 'country', 'city', 'category')->findOrFail($id);
        return view('admin.event.show', compact('event'));
    }

}
