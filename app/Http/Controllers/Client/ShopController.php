<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\ShopItem;
use Illuminate\Http\Request;

class ShopController extends Controller {
    public function index(Request $request) {
        $query = ShopItem::where('is_active',true);
        if ($request->type) $query->where('type',$request->type);
        if ($request->rarity) $query->where('rarity',$request->rarity);
        $items = $query->orderByDesc('is_featured')->orderBy('name')->paginate(12);
        return view('client.shop.index', compact('items'));
    }
    public function show($slug) {
        $item = ShopItem::where('slug',$slug)->where('is_active',true)->firstOrFail();
        $related = ShopItem::where('type',$item->type)->where('id','!=',$item->id)->where('is_active',true)->take(4)->get();
        return view('client.shop.show', compact('item','related'));
    }
}
