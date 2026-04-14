<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShopController extends Controller {
    public function index() { $items = ShopItem::orderBy('type')->orderBy('name')->paginate(15); return view('admin.shop.index', compact('items')); }
    public function create() { return view('admin.shop.create'); }
    public function store(Request $request) {
        $data = $request->validate(['name'=>'required','description'=>'required','price'=>'required|numeric','original_price'=>'nullable|numeric','type'=>'required','rarity'=>'required','stock'=>'integer','is_featured'=>'boolean','is_active'=>'boolean']);
        $data['slug'] = Str::slug($request->name);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        if ($request->filled('includes')) $data['includes'] = array_filter(explode("\n", $request->includes));
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('shop', 'public');
        ShopItem::create($data);
        return redirect()->route('admin.shop.index')->with('success','Shop item created!');
    }
    public function edit(ShopItem $shop) { return view('admin.shop.edit', compact('shop')); }
    public function update(Request $request, ShopItem $shop) {
        $data = $request->validate(['name'=>'required','description'=>'required','price'=>'required|numeric','original_price'=>'nullable|numeric','type'=>'required','rarity'=>'required','stock'=>'integer','is_featured'=>'boolean','is_active'=>'boolean']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        if ($request->filled('includes')) $data['includes'] = array_filter(explode("\n", $request->includes));
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('shop', 'public');
        $shop->update($data);
        return redirect()->route('admin.shop.index')->with('success','Shop item updated!');
    }
    public function show(ShopItem $shop) { return view('admin.shop.show', compact('shop')); }
    public function destroy(ShopItem $shop) { $shop->delete(); return redirect()->route('admin.shop.index')->with('success','Item deleted.'); }
    public function toggleFeatured($id) {
        $item = ShopItem::findOrFail($id);
        $item->update(['is_featured' => !$item->is_featured]);
        return back()->with('success','Featured status toggled.');
    }
}
