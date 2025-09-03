<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAsk extends Model
{
    use HasFactory, Searchable;

    protected $guarded = ['id'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
