<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = Character::with('element')->orderBy('sort_order')->orderBy('name')->paginate(15);
        return view('admin.characters.index', compact('characters'));
    }

    public function create()
    {
        $elements = Element::all();
        return view('admin.characters.create', compact('elements'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'title'       => 'nullable|string|max:100',
            'bio'         => 'required|string',
            'lore'        => 'nullable|string',
            'element_id'  => 'nullable|exists:elements,id',
            'rarity'      => 'required|in:common,uncommon,rare,epic,legendary',
            'role'        => 'required|in:warrior,mage,healer,ranger,assassin,tank,support',
            'faction'     => 'nullable|string|max:100',
            'weapon_type' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_playable' => 'boolean',
            'is_published'=> 'boolean',
            'sort_order'  => 'integer',
        ]);

        $data['slug'] = Str::slug($request->name);
        $data['is_featured']  = $request->boolean('is_featured');
        $data['is_playable']  = $request->boolean('is_playable');
        $data['is_published'] = $request->boolean('is_published');

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('characters', 'public');
        }

        // Parse stats/abilities JSON
        if ($request->filled('stats')) {
            $data['stats'] = json_decode($request->stats, true);
        }
        if ($request->filled('abilities_json')) {
            $data['abilities'] = json_decode($request->abilities_json, true);
        }

        Character::create($data);
        return redirect()->route('admin.characters.index')->with('success', 'Character created successfully!');
    }

    public function edit(Character $character)
    {
        $elements = Element::all();
        return view('admin.characters.edit', compact('character', 'elements'));
    }

    public function update(Request $request, Character $character)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'title'       => 'nullable|string|max:100',
            'bio'         => 'required|string',
            'lore'        => 'nullable|string',
            'element_id'  => 'nullable|exists:elements,id',
            'rarity'      => 'required|in:common,uncommon,rare,epic,legendary',
            'role'        => 'required|in:warrior,mage,healer,ranger,assassin,tank,support',
            'faction'     => 'nullable|string|max:100',
            'weapon_type' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_playable' => 'boolean',
            'is_published'=> 'boolean',
            'sort_order'  => 'integer',
        ]);

        $data['is_featured']  = $request->boolean('is_featured');
        $data['is_playable']  = $request->boolean('is_playable');
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('characters', 'public');
        }
        if ($request->filled('stats')) {
            $data['stats'] = json_decode($request->stats, true);
        }
        if ($request->filled('abilities_json')) {
            $data['abilities'] = json_decode($request->abilities_json, true);
        }

        $character->update($data);
        return redirect()->route('admin.characters.index')->with('success', 'Character updated successfully!');
    }

    public function show(Character $character)
    {
        return view('admin.characters.show', compact('character'));
    }

    public function destroy(Character $character)
    {
        $character->delete();
        return redirect()->route('admin.characters.index')->with('success', 'Character deleted.');
    }
}
