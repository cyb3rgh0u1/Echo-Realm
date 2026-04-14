<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\Story;

class StoryController extends Controller {
    public function index() {
        $stories = Story::where('is_published',true)->orderBy('arc_number')->orderBy('chapter_number')->get();
        $arcs = $stories->groupBy('arc_number');
        return view('client.story.index', compact('stories','arcs'));
    }
    public function show($slug) {
        $story = Story::where('slug',$slug)->where('is_published',true)->firstOrFail();
        $next = Story::where('is_published',true)->where('sort_order','>',$story->sort_order)->orderBy('sort_order')->first();
        $prev = Story::where('is_published',true)->where('sort_order','<',$story->sort_order)->orderBy('sort_order','desc')->first();
        return view('client.story.show', compact('story','next','prev'));
    }
}
