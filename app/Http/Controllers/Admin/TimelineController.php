<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TimelineEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TimelineController extends Controller {
    public function index() { $events = TimelineEvent::orderBy('sort_order')->paginate(20); return view('admin.timeline.index', compact('events')); }
    public function create() { return view('admin.timeline.create'); }
    public function store(Request $request) {
        $data = $request->validate(['title'=>'required','description'=>'required','era'=>'nullable','year_in_lore'=>'nullable','color'=>'required','type'=>'required','is_published'=>'boolean','sort_order'=>'integer']);
        $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->boolean('is_published');
        TimelineEvent::create($data);
        return redirect()->route('admin.timeline.index')->with('success','Timeline event created!');
    }
    public function edit(TimelineEvent $timeline) { return view('admin.timeline.edit', compact('timeline')); }
    public function update(Request $request, TimelineEvent $timeline) {
        $data = $request->validate(['title'=>'required','description'=>'required','era'=>'nullable','year_in_lore'=>'nullable','color'=>'required','type'=>'required','is_published'=>'boolean','sort_order'=>'integer']);
        $data['is_published'] = $request->boolean('is_published');
        $timeline->update($data);
        return redirect()->route('admin.timeline.index')->with('success','Timeline event updated!');
    }
    public function show(TimelineEvent $timeline) { return view('admin.timeline.show', compact('timeline')); }
    public function destroy(TimelineEvent $timeline) { $timeline->delete(); return redirect()->route('admin.timeline.index')->with('success','Event deleted.'); }
}
