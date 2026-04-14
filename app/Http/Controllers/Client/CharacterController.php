<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\Character; use App\Models\Element;
use Illuminate\Http\Request;

class CharacterController extends Controller {
    public function index(Request $request) {
        $elements = Element::all();
        $query = Character::with('element')->where('is_published',true);
        if ($request->element) $query->where('element_id',$request->element);
        if ($request->rarity) $query->where('rarity',$request->rarity);
        if ($request->role) $query->where('role',$request->role);
        $characters = $query->orderBy('sort_order')->orderBy('name')->get();
        return view('client.characters.index', compact('characters','elements'));
    }
    public function show($slug) {
        $character = Character::with('element')->where('slug',$slug)->where('is_published',true)->firstOrFail();
        $related = Character::with('element')->where('element_id',$character->element_id)->where('id','!=',$character->id)->where('is_published',true)->take(3)->get();
        return view('client.characters.show', compact('character','related'));
    }
}
