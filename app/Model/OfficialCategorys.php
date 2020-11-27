<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class OfficialCategorys extends Model
{
	use Sluggable,CascadesDeletes;

    protected $cascadeDeletes = ['Official'];
    protected $table = "official_category";

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    // public function Category()
    // {
    //     return $this->belongsTo('App\Category','parent','id');
    // }
    public function Official()
    {
        return $this->hasMany('App\Model\Official','category','id');
    }
}
