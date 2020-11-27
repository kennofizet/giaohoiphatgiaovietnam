<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class OfficialPosition extends Model
{
	use Sluggable,CascadesDeletes;

    protected $cascadeDeletes = ['Official'];
    protected $table = "official_position";

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function Official()
    {
        return $this->hasMany('App\Model\Official','position','id');
    }
}
