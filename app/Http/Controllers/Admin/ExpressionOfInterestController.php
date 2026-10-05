<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departure;
use Illuminate\Http\Request;

class ExpressionOfInterestController extends Controller
{
    public function index(Departure $departure)
    {
        $departure->load('trek');
        $interests = $departure->expressionsOfInterest()->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.departures.interest', compact('departure', 'interests'));
    }
}
