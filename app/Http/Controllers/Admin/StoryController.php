<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoryController extends Controller
{
    public function index() {
        $stories = Story::orderBy('arc_number')->orderBy('chapter_number')->paginate(15);
        return view('admin.stories.index', compact('stories'));
    }
    public function create() { return view('admin.stories.create'); }
    public function store(Request $request) {
        $data = $request->validate([
            'title'=>'required','synopsis'=>'required','content'=>'required',
            'arc_number'=>'required|integer','chapter_number'=>'required|integer',
            'status'=>'required|in:ongoing,completed,hiatus','is_published'=>'boolean','sort_order'=>'integer',
        ]);
        $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->boolean('is_published');
        Story::create($data);
        return redirect()->route('admin.stories.index')->with('success','Story chapter created!');
    }
    public function edit(Story $story) { return view('admin.stories.edit', compact('story')); }
    public function update(Request $request, Story $story) {
        $data = $request->validate([
            'title'=>'required','synopsis'=>'required','content'=>'required',
            'arc_number'=>'required|integer','chapter_number'=>'required|integer',
            'status'=>'required|in:ongoing,completed,hiatus','is_published'=>'boolean','sort_order'=>'integer',
        ]);
        $data['is_published'] = $request->boolean('is_published');
        $story->update($data);
        return redirect()->route('admin.stories.index')->with('success','Story updated!');
    }
    public function show(Story $story) { return view('admin.stories.show', compact('story')); }
    public function destroy(Story $story) {
        $story->delete();
        return redirect()->route('admin.stories.index')->with('success','Story deleted.');
    }
}
