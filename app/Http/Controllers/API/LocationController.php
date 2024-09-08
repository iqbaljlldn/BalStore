<?php

namespace App\Http\Controllers\API;

use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function provinces(Request $request)
    {
        return Province::all();
    }

    public function regencies(Request $request, $province_id)
    {
        return Regency::where('province_id', $province_id)->get();
    }

    public function districts(Request $request, $regency_id)
    {
        return District::where('regency_id', $regency_id)->get();
    }
    public function villages(Request $request, $district_id)
    {
        return Village::where('district_id', $district_id)->get();
    }
}
