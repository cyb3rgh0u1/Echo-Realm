<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\TimelineEvent;

class TimelineController extends Controller {
    public function index() {
        $events = TimelineEvent::where('is_published',true)->orderBy('sort_order')->get();
        $eras = $events->groupBy('era');
        return view('client.timeline.index', compact('events','eras'));
    }
}
