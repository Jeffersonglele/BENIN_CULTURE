<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;

class RegionshowController extends Controller
{
    public function index()
    {
        $region = Region::all();
        return view('front.region', compact('region'));
    }
}
