<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Page;
use App\Models\Event;
use App\Models\EventAsk;
use App\Models\EventNews;
use App\Models\AllCategory;
use Illuminate\Http\Request;

class WebEventController extends Controller
{
    public function events()
    {
        $currents = Event::active()->latest()->take(3)->with('country', 'city', 'category')->get();
        $events = Event::active()->with('country', 'city', 'category')->paginate(getPaginate());
        $event_news = EventNews::active()->latest()->take(4)->get();
        $categories = AllCategory::where('type', 'event')->get();
        $eventTypeElements = getContent('event_type.element', null, false, true);
        $audienceTypeElements = getContent('audience_type.element', null, false, true);
        $eventSectorElements = getContent('event_sector.element', null, false, true);

        $sections = Page::where('slug', 'events')->first()->secs;

        return view('web.pages.events', compact('currents', 'events', 'event_news','categories', 'eventTypeElements', 'audienceTypeElements', 'eventSectorElements', 'sections'));
    }

    public function eventFilter(Request $request)
    {
        $query = Event::query();

        if ($request->category != 0) {
            $query->where('category_id', $request->category);
        }

        if ($request->audience_type != 0) {
            $query->where('audience_type', $request->audience_type);
        }

        if ($request->sector != 0) {
            $query->where('sector', $request->sector);
        }

        if ($request->type != 0) {
            $query->where('type', $request->type);
        }

        $query->active()->with('country', 'city', 'category');

        $events = $query->paginate(getPaginate());

        return view('web.pages.includes.__event_filter', compact('events'))->render();
    }


    public function eventDetails($slug)
    {
        $event = Event::active()->with('country', 'city', 'category')->where('slug', $slug)->first();
        return view('web.pages.event_details', compact('event'));
    }

    public function eventNews()
    {
        $event_news =  EventNews::active()->latest()->paginate(getPaginate());
        return view('web.pages.event_news', compact('event_news'));
    }

    public function eventNewsDetails($slug)
    {
        $event = EventNews::active()->where('slug', $slug)->first();
        $recentPosts = EventNews::active()->latest()->take(4)->get();
        return view('web.pages.event_news_details', compact('event', 'recentPosts'));
    }

    public function eventAskFormSubmit(Request $request)
    {
        $request->validate([
            "event_id"      => "required|exists:events,id",
            "name"          => "required|max:140",
            "phone"         => "required|max:140",
            "email"         => "required|max:140",
            "city"          => "required|max:140",
            "message"       => "required",
        ]);

        try{

            $eventAsk = new EventAsk();

            $eventAsk->event_id = $request->event_id;
            $eventAsk->name = $request->name;
            $eventAsk->phone = $request->phone;
            $eventAsk->email = $request->email;
            $eventAsk->city = $request->city;
            $eventAsk->message = $request->message;
            $eventAsk->save();

            $message = __('Event ask send success');
            $notify[] = ['success', $message];
            return back()->withNotify($notify);

        } catch (Exception $exp) {
            $message = __('Something went wrong');
            $notify[] = ['error', $message];
            return back()->withNotify($notify);
        }
    }
}
