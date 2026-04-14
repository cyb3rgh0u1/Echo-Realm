<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoreEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoreController extends Controller
{
    public function index() {
        $lore = LoreEntry::orderBy('sort_order')->orderBy('created_at','desc')->paginate(15);
        return view('admin.lore.index', compact('lore'));
    }
    public function create() { return view('admin.lore.create'); }
    public function store(Request $request) {
        $data = $request->validate([
            'title'=>'required','excerpt'=>'nullable','content'=>'required',
            'category'=>'required','classification'=>'required|in:public,classified,top_secret',
            'read_time'=>'integer','is_published'=>'boolean','sort_order'=>'integer',
        ]);
        $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->boolean('is_published');
        if ($request->filled('tags')) $data['tags'] = array_filter(explode(',', $request->tags));
        LoreEntry::create($data);
        return redirect()->route('admin.lore.index')->with('success','Lore entry created!');
    }
    public function edit(LoreEntry $lore) { return view('admin.lore.edit', compact('lore')); }
    public function update(Request $request, LoreEntry $lore) {
        $data = $request->validate([
            'title'=>'required','excerpt'=>'nullable','content'=>'required',
            'category'=>'required','classification'=>'required|in:public,classified,top_secret',
            'read_time'=>'integer','is_published'=>'boolean','sort_order'=>'integer',
        ]);
        $data['is_published'] = $request->boolean('is_published');
        if ($request->filled('tags')) $data['tags'] = array_filter(explode(',', $request->tags));
        $lore->update($data);
        return redirect()->route('admin.lore.index')->with('success','Lore entry updated!');
    }
    public function show(LoreEntry $lore) { return view('admin.lore.show', compact('lore')); }
    public function destroy(LoreEntry $lore) {
        $lore->delete();
        return redirect()->route('admin.lore.index')->with('success','Lore entry deleted.');
    }
}
