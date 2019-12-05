<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'province_id', 'name', 'income_class', 'population'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id', 'province_id'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'code';
    }

    /**
     * Collection of barangays under this municipality.
     */
    public function barangays()
    {
        return $this->morphMany(Barangay::class, 'geographic');
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
