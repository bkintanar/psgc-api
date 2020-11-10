<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'region_id', 'name', 'income_class', 'population'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id', 'region_id'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'code';
    }

    public function cities()
    {
        return $this->morphMany(City::class, 'geographic');
    }

    public function municipalities()
    {
        return $this->morphMany(Municipality::class, 'geographic');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
