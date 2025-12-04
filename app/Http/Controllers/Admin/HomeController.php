<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TimelineRepository;
use Carbon\Carbon;
use App\Models\Timeline;

class HomeController extends Controller
{
    protected $timelineRepository;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
    }
    
    public function index(){
        $timelineToday = Timeline::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->limit(10)->get();
        return view('admin.home', compact('timelineToday'));
    }
}
