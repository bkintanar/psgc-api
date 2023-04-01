<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public $attributes = ['hits' => 0];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ip', 'date'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($tracker) {
            $tracker->time = date('H:i:s');
            $tracker->hits++;
        });
    }

    public static function hit()
    {
        static::firstOrCreate(['ip' => request()->server->get('REMOTE_ADDR'), 'date' => date('Y-m-d')])->save();
    }
}
