<?php

namespace App\Models;

use App\Traits\LangDb;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenBankingForm extends Model
{
    use HasFactory, LangDb, Searchable;

    protected $fillable = [
        'title',
        'title_ar',
        'description',
        'description_ar',
        'image',
        'status',
    ];

    public static array $searchable = [
        'title',
        'title_ar',
        'description',
        'description_ar',
    ];

    public function lists()
    {
        return $this->hasMany(OpenBankingFormList::class, 'service_id', 'id');
    }


    public function forms()
    {
        return $this->hasMany(OpenBankingFormForm::class, 'service_id', 'id');
    }
}
