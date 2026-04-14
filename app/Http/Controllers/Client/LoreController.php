<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\LoreEntry;
use Illuminate\Http\Request;

class LoreController extends Controller {
    public function index(Request $request) {
        $query = LoreEntry::where('is_published',true);
        if ($request->category) $query->where('category',$request->category);
        if ($request->classification) $query->where('classification',$request->classification);
        $lore = $query->orderBy('sort_order')->orderBy('created_at','desc')->paginate(12);
        $categories = LoreEntry::where('is_published',true)->distinct()->pluck('category');
        return view('client.lore.index', compact('lore','categories'));
    }
    public function show($slug) {
        $entry = LoreEntry::where('slug',$slug)->where('is_published',true)->firstOrFail();
        $related = LoreEntry::where('category',$entry->category)->where('id','!=',$entry->id)->where('is_published',true)->take(3)->get();
        return view('client.lore.show', compact('entry','related'));
    }
}
