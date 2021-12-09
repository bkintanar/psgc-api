<?php

namespace App\Http\Controllers;

use App\Eloquent\Visitor;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const ITEMS_PER_PAGE = 15;

    public function __construct()
    {
        if (! request()->get('health')) {
            Visitor::hit();
        }
    }
}
