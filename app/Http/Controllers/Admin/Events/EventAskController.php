<?php

namespace App\Http\Controllers\Admin\Events;

use App\Http\Controllers\Controller;
use App\Models\EventAsk;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class EventAskController extends Controller
{
    public function index()
    {
        $event_asks = EventAsk::searchable(['name', 'email', 'phone', 'event:title'])->with('event')->paginate(getPaginate());
        return view('admin.event_ask.index', compact('event_asks'));
    }

    public function show($id)
    {
        $event_ask = EventAsk::with('event')->where('id', $id)->first();
        return view('admin.event_ask.show', compact('event_ask'));
    }
}
