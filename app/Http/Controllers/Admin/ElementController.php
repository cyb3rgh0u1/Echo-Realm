<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ElementController extends Controller
{
    public function index() {
        $elements = Element::withCount('characters')->get();
        return view('admin.elements.index', compact('elements'));
    }
    public function create() { return view('admin.elements.create'); }
    public function store(Request $request) {
        $data = $request->validate(['name'=>'required','description'=>'required','color'=>'required','glow_color'=>'required','symbol'=>'nullable']);
        $data['slug'] = Str::slug($request->name);
        Element::create($data);
        return redirect()->route('admin.elements.index')->with('success','Element created!');
    }
    public function edit(Element $element) { return view('admin.elements.edit', compact('element')); }
    public function update(Request $request, Element $element) {
        $data = $request->validate(['name'=>'required','description'=>'required','color'=>'required','glow_color'=>'required','symbol'=>'nullable']);
        $element->update($data);
        return redirect()->route('admin.elements.index')->with('success','Element updated!');
    }
    public function show(Element $element) { return view('admin.elements.show', compact('element')); }
    public function destroy(Element $element) {
        $element->delete();
        return redirect()->route('admin.elements.index')->with('success','Element deleted.');
    }
}
