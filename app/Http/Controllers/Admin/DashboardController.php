<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Element;
use App\Models\LoreEntry;
use App\Models\Order;
use App\Models\Setting;
use App\Models\ShopItem;
use App\Models\Story;
use App\Models\TimelineEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users'      => User::where('role','user')->count(),
            'orders'     => Order::count(),
            'revenue'    => Order::where('status','completed')->sum('total'),
            'characters' => Character::count(),
            'lore'       => LoreEntry::count(),
            'shop_items' => ShopItem::count(),
        ];
        $recentOrders   = Order::with('user')->latest()->take(8)->get();
        $recentUsers    = User::where('role','user')->latest()->take(8)->get();
        $ordersByStatus = Order::selectRaw('status, count(*) as count')->groupBy('status')->pluck('count','status');
        return view('admin.dashboard.index', compact('stats','recentOrders','recentUsers','ordersByStatus'));
    }

    public function settings()
    {
        $settings = Setting::all()->pluck('value','key');
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'hero_bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'hero_bg_video' => 'nullable|mimetypes:video/mp4,video/webm|max:51200',
        ]);

        // Hero background image
        if ($request->hasFile('hero_bg_image')) {
            $old = Setting::get('hero_bg_image');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('hero_bg_image', $request->file('hero_bg_image')->store('hero','public'));
        }

        // Hero background video
        if ($request->hasFile('hero_bg_video')) {
            $old = Setting::get('hero_bg_video');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('hero_bg_video', $request->file('hero_bg_video')->store('hero','public'));
        }

        // Remove actions
        if ($request->boolean('remove_bg_image')) {
            $old = Setting::get('hero_bg_image');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('hero_bg_image','');
        }
        if ($request->boolean('remove_bg_video')) {
            $old = Setting::get('hero_bg_video');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('hero_bg_video','');
        }

        // All text fields
        $skip = ['_token','_method','hero_bg_image','hero_bg_video','remove_bg_image','remove_bg_video'];
        foreach ($request->except($skip) as $key => $value) {
            Setting::set($key, $value ?? '');
        }

        return back()->with('success','Settings saved.');
    }
}
