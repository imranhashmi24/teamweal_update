<?php

namespace App\Models;

use App\Traits\LangDb;
use App\Constants\Status;
use App\Traits\Searchable;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, Searchable, GlobalStatus, LangDb;

    protected $guarded = ['id'];

    protected $appends = ['image_url'];

    protected $image_url;

    public function getImageUrlAttribute()
    {
        $this->image_url = getFilePath('events');
        return $this->image_url;
    }

    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', Status::INACTIVE);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }


    public function category()
    {
        return $this->belongsTo(AllCategory::class, 'category_id', 'id');
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->status == Status::ACTIVE) {
                $html = '<span class="badge bg-success">' . trans("Active") . '</span>';
            } elseif ($this->status == Status::INACTIVE) {
                $html = '<span class="badge bg-warning">' . trans("Inactive") . '</span>';
            }
            return $html;
        });
    }

}
