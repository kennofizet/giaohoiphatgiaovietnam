<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Official extends Model
{
	use Sluggable;

    protected $table = "official";

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function Category()
    {
        return $this->belongsTo('App\Model\OfficialCategorys','category','id');
    }
    public function Position()
    {
        return $this->belongsTo('App\Model\OfficialPosition','position','id');
    }
}
