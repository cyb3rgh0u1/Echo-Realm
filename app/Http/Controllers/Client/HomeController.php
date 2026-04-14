<?php
// HomeController
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\Character; use App\Models\LoreEntry; use App\Models\ShopItem; use App\Models\Story; use App\Models\TimelineEvent; use App\Models\Setting;

class HomeController extends Controller {
    public function index() {
        $featuredCharacters = Character::with('element')->where('is_featured',true)->where('is_published',true)->take(4)->get();
        $featuredShop = ShopItem::where('is_featured',true)->where('is_active',true)->take(4)->get();
        $latestLore = LoreEntry::where('is_published',true)->latest()->take(3)->get();
        $latestStory = Story::where('is_published',true)->orderBy('arc_number')->orderBy('chapter_number')->first();
        $settings = Setting::all()->pluck('value','key');
        return view('client.home.index', compact('featuredCharacters','featuredShop','latestLore','latestStory','settings'));
    }
}
