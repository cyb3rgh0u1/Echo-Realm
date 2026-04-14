<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        DB::table('users')->insert([
            'name' => 'Echo Admin',
            'username' => 'admin',
            'email' => 'admin@echo-realm.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sample Users
        $users = [
            ['name' => 'Aria Voss', 'username' => 'ariavoss', 'email' => 'aria@example.com'],
            ['name' => 'Kael Storm', 'username' => 'kaelstorm', 'email' => 'kael@example.com'],
            ['name' => 'Nova Chen', 'username' => 'novachen', 'email' => 'nova@example.com'],
        ];
        foreach ($users as $u) {
            DB::table('users')->insert(array_merge($u, [
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Elements
$elements = [
    [
        'name' => 'Voidfire',
        'slug' => 'voidfire',
        'description' => 'Ancient dark flame born from the collapse of a dying star. It burns without fuel and dims without shadow.',
        'color' => '#7c3aed',
        'glow_color' => '#a855f7',
        'symbol' => '✦'
    ],
    [
        'name' => 'Crystalmind',
        'slug' => 'crystalmind',
        'description' => 'The element of pure thought, manifested as shimmering crystalline energy that bends reality through will alone.',
        'color' => '#06b6d4',
        'glow_color' => '#22d3ee',
        'symbol' => '◇'
    ],
    [
        'name' => 'Stormblood',
        'slug' => 'stormblood',
        'description' => 'Lightning and rain fused into living force. Stormblood wielders carry the fury of the sky in their veins.',
        'color' => '#3b82f6',
        'glow_color' => '#60a5fa',
        'symbol' => '⟐'        // Changed from ⚡
    ],
    [
        'name' => 'Verdance',
        'slug' => 'verdance',
        'description' => 'Life-force drawn from deep root networks beneath the Echo-Realm. It heals, grows, and consumes with equal patience.',
        'color' => '#10b981',
        'glow_color' => '#34d399',
        'symbol' => '❀'
    ],
    [
        'name' => 'Ashenbloom',
        'slug' => 'ashenbloom',
        'description' => 'The paradox element — beauty wrought from destruction. Phoenix fire refined over ten thousand deaths.',
        'color' => '#f59e0b',
        'glow_color' => '#fbbf24',
        'symbol' => '❂'
    ],
    [
        'name' => 'Nullrift',
        'slug' => 'nullrift',
        'description' => 'The absence between dimensions. Nullrift users can erase matter from existence and step between worlds.',
        'color' => '#6b7280',
        'glow_color' => '#9ca3af',
        'symbol' => '◉'
    ],
];

        foreach ($elements as $el) {
            DB::table('elements')->insert(array_merge($el, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Characters
        $characters = [
            [
                'name' => 'Seraphon', 'slug' => 'seraphon', 'title' => 'The Last Ember',
                'bio' => 'Once a celestial guardian sworn to protect the Echo-Realm\'s sun-core, Seraphon fell from grace when she chose to save a single village over following divine protocol. Now she walks the mortal world, her wings burned to obsidian, seeking redemption through fire.',
                'lore' => 'In the age before the Shattering, seven guardians were appointed to protect the seven pillars of reality. Seraphon was the Flame Warden — tasked with maintaining the sacred equilibrium between light and void. When the Cult of Nullrift attacked the village of Ashenveil, she was ordered to stand down and preserve her power for the greater war ahead. She refused. The village was saved. The pillar cracked. And Seraphon was cast down, her celestial fire transmuted into something rawer, darker, and far more dangerous.',
                'element_id' => 1, 'rarity' => 'legendary', 'role' => 'warrior', 'faction' => 'Ashenveil Remnant',
                'weapon_type' => 'Dual Blades', 'is_featured' => true,
                'stats' => json_encode(['attack' => 95, 'defense' => 70, 'speed' => 85, 'magic' => 88, 'hp' => 1240]),
                'abilities' => json_encode([
                    ['name' => 'Voidfire Slash', 'description' => 'Unleash a wide arc of dark flame that burns through magical barriers.', 'type' => 'Active'],
                    ['name' => 'Fallen Wings', 'description' => 'Summon spectral wings for 8 seconds, enhancing speed and evasion.', 'type' => 'Active'],
                    ['name' => 'Ember\'s Resolve', 'description' => 'Passive: When HP drops below 30%, gain 40% increased damage for 10 seconds.', 'type' => 'Passive'],
                    ['name' => 'Celestial Pyre', 'description' => 'ULTIMATE: Call down a pillar of combined celestial and void fire, dealing massive area damage.', 'type' => 'ultimate'],
                ]),
            ],
            [
                'name' => 'Kyrath', 'slug' => 'kyrath', 'title' => 'Echo Architect',
                'bio' => 'A Crystalmind savant who sees the world as an infinite lattice of breakable and buildable patterns. Kyrath designed the Echo-Realm\'s most sophisticated defense grids before a vision of its coming destruction drove him to abandon his post.',
                'lore' => 'Kyrath was born blind but perceived the world through Crystalmind resonance — a gift that made him the greatest structural architect in history. His masterwork, the Echo Lattice, remains the most complex magical structure ever built. But Kyrath saw its flaw: a resonance point deep within the Lattice that, if struck correctly, could unravel reality itself. He tried to warn the Council. They saw only treason. Now he wanders with his stolen blueprints, racing to find the weapon that doesn\'t exist yet — but must.',
                'element_id' => 2, 'rarity' => 'epic', 'role' => 'mage', 'faction' => 'Unbound Scholarium',
                'weapon_type' => 'Focus Staff', 'is_featured' => true,
                'stats' => json_encode(['attack' => 75, 'defense' => 55, 'speed' => 70, 'magic' => 98, 'hp' => 890]),
                'abilities' => json_encode([
                    ['name' => 'Lattice Spike', 'description' => 'Fire a crystal shard that splinters on impact, hitting multiple enemies.', 'type' => 'Active'],
                    ['name' => 'Mind Fortress', 'description' => 'Erect a crystalline barrier that absorbs damage and reflects 20% back.', 'type' => 'Active'],
                    ['name' => 'Pattern Recognition', 'description' => 'Passive: Reveal enemy weaknesses after 3 hits, increasing damage by 25%.', 'type' => 'Passive'],
                    ['name' => 'Reality Lattice', 'description' => 'ULTIMATE: Trap enemies in a crystalline cage, dealing pulsing damage for 6 seconds.', 'type' => 'ultimate'],
                ]),
            ],
            [
                'name' => 'Vela', 'slug' => 'vela', 'title' => 'The Storm\'s Memory',
                'bio' => 'A Stormblood hunter whose village was erased by the Nullrift. Vela carries the weather patterns of her lost homeland encoded in her very bloodstream, calling storms that should not exist in any known climate.',
                'element_id' => 3, 'rarity' => 'rare', 'role' => 'ranger', 'faction' => 'Wandering Gale',
                'weapon_type' => 'Storm Bow', 'is_featured' => false,
                'bio' => 'Vela\'s village did not burn or flood or fall to siege. It simply stopped being. The Nullrift erased it between one heartbeat and the next. She survived because she was storm-walking — literally inside a lightning bolt — when it happened. Now she carries the memory of her home\'s weather in her blood, able to summon impossible storms as acts of remembrance.',
                'stats' => json_encode(['attack' => 88, 'defense' => 60, 'speed' => 92, 'magic' => 72, 'hp' => 1050]),
                'abilities' => json_encode([
                    ['name' => 'Remembered Storm', 'description' => 'Call a localized storm from a lost land, striking with precision lightning.', 'type' => 'Active'],
                    ['name' => 'Gale Step', 'description' => 'Ride a wind burst to quickly reposition, leaving a static field behind.', 'type' => 'Active'],
                    ['name' => 'Storm Sight', 'description' => 'Passive: Detect enemies through obstacles during stormy conditions you create.', 'type' => 'Passive'],
                    ['name' => 'The Last Rain', 'description' => 'ULTIMATE: Summon the final storm of your lost home — a catastrophic downpour of lightning, hail, and thunder.', 'type' => 'ultimate'],
                ]),
            ],
            [
                'name' => 'Thornveil', 'slug' => 'thornveil', 'title' => 'Root Speaker',
                'bio' => 'The ancient forest\'s voice made flesh. Thornveil is neither fully human nor fully plant — a symbiotic fusion that occurred after a Verdance ritual gone magnificently wrong.',
                'element_id' => 4, 'rarity' => 'epic', 'role' => 'support', 'faction' => 'Deep Root Council',
                'weapon_type' => 'Living Spear', 'is_featured' => false,
                'lore' => 'The Deep Root ritual was meant to let a single shaman temporarily channel the forest\'s voice. Thornveil — then known only as a young herbalist named Moss — completed the ritual perfectly. Too perfectly. The forest decided not to let go. Over seven years, the two became one: a being who speaks for the trees but dreams of being human again, while simultaneously never wanting to leave.',
                'stats' => json_encode(['attack' => 65, 'defense' => 80, 'speed' => 58, 'magic' => 90, 'hp' => 1380]),
                'abilities' => json_encode([
                    ['name' => 'Thorn Barrage', 'description' => 'Launch a volley of razor-sharp thorns that apply poison stacks.', 'type' => 'Active'],
                    ['name' => 'Root Network', 'description' => 'Entangle multiple enemies with rapid root growth, immobilizing them.', 'type' => 'Active'],
                    ['name' => 'Verdant Pulse', 'description' => 'Passive: Heal nearby allies for 2% HP every 4 seconds.', 'type' => 'Passive'],
                    ['name' => 'World Tree\'s Wrath', 'description' => 'ULTIMATE: Channel the full fury of the ancient forest — massive roots erupt globally, dealing damage and healing allies.', 'type' => 'ultimate'],
                ]),
            ],
            [
                'name' => 'Cinderquill', 'slug' => 'cinderquill', 'title' => 'The Undying Jester',
                'bio' => 'A trickster deity of the Ashenbloom who can\'t seem to stay dead. Each resurrection makes Cinderquill slightly less sane and significantly more powerful. Current death count: 847.',
                'element_id' => 5, 'rarity' => 'legendary', 'role' => 'assassin', 'faction' => 'The Laughing Funeral',
                'weapon_type' => 'Twin Fans', 'is_featured' => true,
                'stats' => json_encode(['attack' => 92, 'defense' => 45, 'speed' => 98, 'magic' => 85, 'hp' => 820]),
                'abilities' => json_encode([
                    ['name' => 'Petal Blitz', 'description' => 'Dash through enemies leaving burning blossom trails.', 'type' => 'Active'],
                    ['name' => 'Death\'s Joke', 'description' => 'Fake a death, releasing a burst of Ashenbloom that confuses and damages.', 'type' => 'Active'],
                    ['name' => 'Resurrection Surge', 'description' => 'Passive: Upon death, resurrect with 30% HP and 50% increased speed for 5 seconds.', 'type' => 'Passive'],
                    ['name' => 'The Final Punchline', 'description' => 'ULTIMATE: Explode in a shower of Phoenix fire, then immediately resurrect dealing AoE damage on return.', 'type' => 'ultimate'],
                ]),
            ],
            [
                'name' => 'Vox', 'slug' => 'vox', 'title' => 'Silence Incarnate',
                'bio' => 'Vox has no past that can be verified. Every document about their origin has been erased. Every witness has forgotten. They arrived one day and simply were, carrying a Nullrift blade that cuts things out of existence.',
                'element_id' => 6, 'rarity' => 'legendary', 'role' => 'assassin', 'faction' => 'Unknown',
                'weapon_type' => 'Existence Blade', 'is_featured' => false,
                'stats' => json_encode(['attack' => 99, 'defense' => 50, 'speed' => 95, 'magic' => 80, 'hp' => 950]),
                'abilities' => json_encode([
                    ['name' => 'Erase', 'description' => 'Strike an enemy, removing a random buff from existence.', 'type' => 'Active'],
                    ['name' => 'Between', 'description' => 'Step into the space between dimensions for 3 seconds, becoming untargetable.', 'type' => 'Active'],
                    ['name' => 'Null Presence', 'description' => 'Passive: Reduce enemy detection range by 40% when approaching from behind.', 'type' => 'Passive'],
                    ['name' => 'Unwrite', 'description' => 'ULTIMATE: Temporarily erase a single target from the battlefield for 8 seconds. They return with 50% HP.', 'type' => 'ultimate'],
                ]),
            ],
        ];

        foreach ($characters as $char) {
            if (!isset($char['lore'])) $char['lore'] = null;
            DB::table('characters')->insert(array_merge($char, [
                'is_published' => true, 'sort_order' => 0,
                'created_at' => now(), 'updated_at' => now()
            ]));
        }

        // Lore Entries
        $loreEntries = [
            [
                'title' => 'The First Shattering',
                'slug' => 'the-first-shattering',
                'excerpt' => 'Before the Echo-Realm as we know it existed, there was only the Resonance — a single note of pure creation. Then someone struck a dissonant chord.',
                'content' => '<p>In the beginning, there was the <strong>Resonance</strong> — a perfect harmonic frequency that vibrated across all possible dimensions simultaneously. It was not a sound you could hear; it was the frequency of existence itself, the hum beneath all matter, the silence inside all silence.</p>

<p>The Resonance sustained itself for what scholars estimate to be approximately 400,000 years of our current calendar. During this period, no conscious beings existed — only the pure mathematics of existence, folding and unfolding in perfect symmetry.</p>

<p>Then, from some direction that has no name in any known compass system, something <em>struck</em> the Resonance. A dissonant frequency. A wrong note. The scholars of the Unbound Scholarium call it the <strong>Fundamental Discord</strong>.</p>

<p>The Resonance did not simply break. It <em>echoed</em> — bouncing its shattered frequencies across the newly broken dimensional walls, creating reality as a cascade of harmonic mistakes. What we call the Echo-Realm is, technically, the reverb of a cosmic error.</p>

<blockquote>"We do not live in creation. We live in the aftermath." — Kyrath, Echo Architect</blockquote>

<p>The First Shattering created six major dimensional fractures, which correspond directly to the six known elements. Each element is, in essence, a different way that existence tries to restore the original Resonance — and fails beautifully in its own unique way.</p>',
                'category' => 'history', 'classification' => 'public', 'read_time' => 8, 'is_published' => true,
            ],
            [
                'title' => 'The Nullrift Manifesto',
                'slug' => 'the-nullrift-manifesto',
                'excerpt' => 'A recovered document from the Cult of Nullrift. Most of it makes perfect, terrifying sense.',
                'content' => '<p><em>[Classification: TOP SECRET — Retrieved from Nullrift Cult stronghold, Sector 7-Null. Original author unknown.]</em></p>

<p>We are not destroyers. We are <strong>correctors</strong>.</p>

<p>Every being in this realm believes existence is a gift. We know the truth: it was an accident. The Fundamental Discord that created reality was not an act of divine will. It was a mistake. And every moment this mistake continues, the universe suffers in silent, beautiful agony.</p>

<p>The Nullrift is not nothing. It is <em>potential</em> — the state before the mistake, the infinite silence that the Discord interrupted. To channel Nullrift is to touch the universe\'s original state. To return something to the Nullrift is to grant it peace.</p>

<p>We do not hate life. We believe life deserves better than this broken echo of existence.</p>

<p><strong>The Great Correction will not be an ending. It will be a homecoming.</strong></p>',
                'category' => 'faction', 'classification' => 'classified', 'read_time' => 5, 'is_published' => true,
            ],
            [
                'title' => 'Bestiary: Resonance Wraiths',
                'slug' => 'bestiary-resonance-wraiths',
                'excerpt' => 'Field notes on the creatures that form from broken resonance pockets in the Echo-Realm\'s more unstable zones.',
                'content' => '<p><strong>Classification:</strong> Echo-Born Entity / Threat Level: Varies (Moderate to Extreme)</p>

<p>Resonance Wraiths are not creatures in the traditional sense. They do not eat, reproduce, or die of natural causes. They are, more accurately, <em>living mistakes</em> — pockets of broken resonance that have accumulated enough dimensional debris to achieve a form of semi-consciousness.</p>

<h3>Physical Description</h3>
<p>Most Wraiths appear as translucent humanoid forms with visual distortion around their edges — as though the air cannot quite decide where they end. Their cores pulse with the color of whatever element dominates their local resonance pocket. In documented cases, these have ranged from the common Voidfire-purple to the extremely rare and dangerous Nullrift-grey.</p>

<h3>Behavior Patterns</h3>
<p>Wraiths are attracted to strong emotional resonance in living beings. Joy, grief, rage, love — all of these create resonance spikes that Wraiths navigate toward with animal instinct. They do not attack out of malice. They absorb because they are incomplete, and they seek completion in the frequencies of conscious beings.</p>

<h3>Notable Variants</h3>
<ul>
<li><strong>Echo Mimic</strong>: Copies the visual appearance of the last living being it absorbed. Extremely dangerous.</li>
<li><strong>Deep Null Wraith</strong>: Grey-cored. Can temporarily erase matter. Encounter: RUN.</li>
<li><strong>Bloom Specter</strong>: Ashenbloom-core. Actually beneficial — releases healing frequencies when dispersed.</li>
</ul>',
                'category' => 'bestiary', 'classification' => 'public', 'read_time' => 6, 'is_published' => true,
            ],
            [
                'title' => 'The Seven Pillars — A Summary',
                'slug' => 'the-seven-pillars-summary',
                'excerpt' => 'The structural underpinnings of the Echo-Realm. Currently: six remaining. Status of the seventh is disputed.',
                'content' => '<style>
    .briefing-report {
        margin: 3rem 0;
        border: 1px solid var(--border);
        background: rgba(255, 255, 255, 0.01);
        border-radius: 4px;
        overflow: hidden;
    }
    .report-row {
        display: grid;
        grid-template-columns: 200px 1fr 140px;
        gap: 2rem;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
        align-items: center;
        transition: background 0.3s;
    }
    .report-row:last-child { border-bottom: none; }
    .report-row:hover { background: rgba(255, 255, 255, 0.02); }

    .p-label { display: flex; align-items: center; gap: 10px; font-family: var(--font-heading); font-size: 0.8rem; color: #fff; }
    .p-svg { width: 14px; height: 14px; flex-shrink: 0; }
    .p-intel { font-size: 0.8rem; color: var(--text-muted); line-height: 1.5; opacity: 0.8; }
    .p-status { font-family: var(--font-heading); font-size: 0.55rem; text-align: right; letter-spacing: 0.15em; font-weight: 700; }

    /* Tactical Status Colors */
    .s-stable { color: var(--accent); }
    .s-warning { color: var(--gold); }
    .s-danger { color: var(--red); animation: pulse-red 2s infinite; }
    .s-ghost { color: var(--text-dim); opacity: 0.4; }

    @keyframes pulse-red { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }

    @media (max-width: 768px) {
        .report-row { grid-template-columns: 1fr; gap: 0.5rem; }
        .p-status { text-align: left; margin-top: 0.5rem; }
    }
</style>

<div class="lore-body">
    <p>The Echo-Realm is not held together by gravity, magic, or faith — it is held together by seven <strong>Resonance Pillars</strong>, massive dimensional anchors that were formed in the immediate aftermath of the First Shattering. Think of them as load-bearing columns in a building constructed during an earthquake, by the earthquake itself.</p>

    <p>Each Pillar corresponds to one of the major elements, regulating that element's presence in the realm and preventing it from collapsing back into raw Discord. Without the Pillars, the elements would devour each other and reality would revert to the pre-Shattering state.</p>

    <div class="briefing-report">
        <div class="report-row">
            <div class="p-label">
                <svg class="p-svg" viewBox="0 0 24 24" fill="none" stroke="var(--red)" stroke-width="2"><path d="M12 2l3 9 9 3-9 3-3 9-3-9-9-3 9-3 3-9z"/></svg>
                Voidfire
            </div>
            <div class="p-intel">Cracked during the Seraphon Incident (~200 years ago). Localized thermal bleed detected.</div>
            <div class="p-status s-warning">UNSTABLE</div>
        </div>

        <div class="report-row">
            <div class="p-label">
                <svg class="p-svg" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 12h18M12 3v18"/></svg>
                Crystalmind
            </div>
            <div class="p-intel">Intact. Kyrath's Echo Lattice currently supplementing structural load.</div>
            <div class="p-status s-stable">OPTIMAL</div>
        </div>

        <div class="report-row">
            <div class="p-label">
                <svg class="p-svg" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                Stormblood
            </div>
            <div class="p-intel">Intact. No significant static variance reported.</div>
            <div class="p-status s-stable">OPTIMAL</div>
        </div>

        <div class="report-row">
            <div class="p-label">
                <svg class="p-svg" viewBox="0 0 24 24" fill="none" stroke="#34D399" stroke-width="2"><path d="M12 2v10M18 9l-6 6-6-6"/></svg>
                Verdance
            </div>
            <div class="p-intel">Intact. Deep Root Council maintains active repair protocols.</div>
            <div class="p-status s-stable">OPTIMAL</div>
        </div>

        <div class="report-row">
            <div class="p-label">
                <svg class="p-svg" viewBox="0 0 24 24" fill="none" stroke="#F472B6" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/></svg>
                Ashenbloom
            </div>
            <div class="p-intel">Territory controlled by the Laughing Funeral. Reconnaissance data corrupted.</div>
            <div class="p-status s-ghost">UNKNOWN</div>
        </div>

        <div class="report-row">
            <div class="p-label">
                <svg class="p-svg" viewBox="0 0 24 24" fill="none" stroke="var(--red)" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                Nullrift
            </div>
            <div class="p-intel">Destroyed or relocated during the Third Collapse (600 years ago).</div>
            <div class="p-status s-danger">MISSING</div>
        </div>

        <div class="report-row" style="background: rgba(0,0,0,0.2)">
            <div class="p-label">
                <svg class="p-svg" viewBox="0 0 24 24" fill="none" stroke="var(--text-dim)" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                The Seventh
            </div>
            <div class="p-intel">Existence disputed. No element assigned. Signal non-existent.</div>
            <div class="p-status s-ghost">THEORETICAL</div>
        </div>
    </div>

    <p>Without the Pillars, reality would revert to the pre-Shattering state — which is either paradise or oblivion, depending on who you ask.</p>
</div>',
                'category' => 'cosmology', 'classification' => 'public', 'read_time' => 7, 'is_published' => true,
            ],
        ];

        foreach ($loreEntries as $entry) {
            DB::table('lore_entries')->insert(array_merge($entry, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Stories
        $stories = [
            [
                'title' => 'Arc I: The Ember Descends',
                'slug' => 'arc-1-the-ember-descends',
                'synopsis' => 'The story begins with Seraphon\'s fall from grace and her first steps into the mortal world. An unlikely alliance, a prophecy that shouldn\'t exist, and a crack in the sky that everyone is pretending not to notice.',
                'content' => '<p class="story-intro">She fell for seventeen days.</p>

<p>Not because the distance was that great — the gap between the celestial sphere and the mortal world could be crossed in an hour by a healthy wind. She fell slowly because falling was all she had left to do, and she did not want to arrive.</p>

<p>The village of Ashenveil appeared below her as a collection of amber lights. It had been rebuilt three times since she saved it. The original structures were long gone — replaced by new wood, new stone, new generations who had heard the story of the guardian who broke heaven\'s law for them but wouldn\'t recognize her face if they passed her on the road.</p>

<p>Seraphon hit the ground at the edge of the wheat fields and lay there for a while, looking at the sky she\'d been banished from. Her wings — what was left of them — were making a sound like distant fire dying. Her Voidfire responded to grief by burning inward. She was always slightly on fire, now. An occupational hazard of having celestial energy transmuted by a traumatic exile.</p>

<p><em>"You\'re burning my wheat,"</em> said a voice.</p>

<p>She turned her head. A child of perhaps nine was standing at a safe distance, watching her with the specific curiosity of someone who has seen strange things before and has learned that most of them are less dangerous than they look.</p>

<p><em>"I\'m aware,"</em> said Seraphon. <em>"I apologize."</em></p>

<p><em>"Are you the one who saved the village?"</em></p>

<p>Seraphon sat up slowly, her dark wings folding against her back with the sound of cooled embers. <em>"Technically."</em></p>

<p><em>"Why did you come back?"</em></p>

<p>She looked at the amber lights of the village and thought about this honestly. <em>"I don\'t know yet,"</em> she said. <em>"I think something terrible is coming and I\'m the only one who can see it."</em></p>

<p>The child considered this with great seriousness. <em>"Is it the crack?"</em></p>

<p>Seraphon went very still. <em>"What crack?"</em></p>

<p>The child pointed up at the perfectly normal-looking night sky. <em>"The one only I can see. It\'s been there for six months. I thought maybe I was going mad."</em></p>

<p>Seraphon looked at the sky with her celestial perception extended for the first time since her fall. And there it was: a hairline fracture in the dimensional membrane directly above Ashenveil. Imperceptible to mortal eyes. Invisible to regular magical scans. But to a Flame Warden\'s perception — catastrophically obvious.</p>

<p>She stood up, ignoring the burning wheat.</p>

<p><em>"What is your name?"</em></p>

<p><em>"Pip."</em></p>

<p><em>"Pip, I need you to show me exactly where you first saw it."</em></p>',
                'arc_number' => 1, 'chapter_number' => 1, 'status' => 'ongoing', 'is_published' => true, 'sort_order' => 1,
            ],
            [
                'title' => 'Arc I, Chapter II: The Architect\'s Confession',
                'slug' => 'arc-1-the-architects-confession',
                'synopsis' => 'Kyrath makes contact with Seraphon. He claims to have designed the flaw that is now threatening to crack the world open. He also claims it was intentional.',
                'content' => '<p>The message arrived not as paper or crystal or light, but as a structural impossibility: a cube of crystalline air that appeared in Seraphon\'s hand at precisely the moment she wanted information she didn\'t have.</p>

<p>This was, she had been informed, Kyrath\'s preferred communication style.</p>

<p>The cube dissolved into words she perceived directly without reading — another Crystalmind trick that she found profoundly annoying — and the words said: <em>I designed the flaw you\'re looking at. I did it on purpose. I need you to stop trying to fix it before you make it worse. Meet me at the Third Unmapped Bridge. Bring no one. I\'ll know if you do.</em></p>

<p>Seraphon stared at the space where the message had been for a long time.</p>

<p>Then she left Pip in the care of the village elder and went to the Third Unmapped Bridge, which was unmapped because it connected two places that technically didn\'t exist simultaneously — a quirk of local dimensional geography that made it extremely useful for meetings you didn\'t want recorded.</p>

<p>Kyrath was already there, because Kyrath was always already there. He was a slight figure wrapped in Crystalmind-reActive cloth that shifted pattern based on nearby resonance frequencies, currently displaying a complicated equation that Seraphon didn\'t recognize. He was holding a staff that functioned primarily as a focusing instrument for his abilities, though he seemed to be using it as a walking stick at the moment. His eyes, when he turned to face her, were solid crystal — pale blue, interior-lit, slightly disturbing.</p>

<p><em>"You came alone,"</em> he said, with what sounded like relief.</p>

<p><em>"I was tempted to bring an army,"</em> Seraphon said. <em>"But then I thought, if someone built a flaw into a Resonance Pillar on purpose, they probably have very good reasons that I should hear before I incinerate them."</em></p>

<p><em>"The Seventh Pillar,"</em> Kyrath said, without preamble. <em>"You know the scholars claim it\'s mythological."</em></p>

<p><em>"Yes."</em></p>

<p><em>"It isn\'t. I\'ve seen it. And someone — something — is trying to activate it. The flaw in the Voidfire Pillar isn\'t damage. It\'s a key."</em></p>

<p>The dimensional membrane above them hummed very softly in a way that neither of them acknowledged but both of them heard.</p>

<p><em>"A key,"</em> Seraphon repeated slowly. <em>"To what?"</em></p>

<p><em>"That,"</em> said Kyrath, <em>"is the question I\'ve been trying to answer for thirty years, and I believe the answer is somewhere that neither of us will enjoy going."</em></p>',
                'arc_number' => 1, 'chapter_number' => 2, 'status' => 'ongoing', 'is_published' => true, 'sort_order' => 2,
            ],
        ];

        foreach ($stories as $story) {
            DB::table('stories')->insert(array_merge($story, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Timeline Events
        $timeline = [
            ['title' => 'The Fundamental Discord', 'slug' => 'fundamental-discord', 'era' => 'The Before', 'year_in_lore' => 'Year 0', 'description' => 'An unknown force strikes the primordial Resonance, shattering it into the dimensional cascade that creates the Echo-Realm.', 'type' => 'catastrophe', 'color' => '#7c3aed', 'sort_order' => 1],
            ['title' => 'Formation of the Seven Pillars', 'slug' => 'formation-seven-pillars', 'era' => 'The First Age', 'year_in_lore' => 'Year 1-400', 'description' => 'The six elements stabilize into their Resonance Pillars. The Seventh Pillar forms silently, undetected, in an unmapped region.', 'type' => 'discovery', 'color' => '#06b6d4', 'sort_order' => 2],
            ['title' => 'The Deep Root Accord', 'slug' => 'deep-root-accord', 'era' => 'The Second Age', 'year_in_lore' => 'Year 1,200', 'description' => 'The sentient forests and mortal civilizations sign the Deep Root Accord, establishing peaceful coexistence and the beginning of Verdance cultivation.', 'type' => 'political', 'color' => '#10b981', 'sort_order' => 3],
            ['title' => 'The Third Collapse', 'slug' => 'the-third-collapse', 'era' => 'The Collapse Era', 'year_in_lore' => 'Year 2,847', 'description' => 'The Nullrift Pillar catastrophically destabilizes. Half the known realm is remapped. The Pillar disappears. 40% of the global population is lost.', 'type' => 'catastrophe', 'color' => '#6b7280', 'sort_order' => 4],
            ['title' => 'The Celestial Guardian Pact', 'slug' => 'celestial-guardian-pact', 'era' => 'The Rebuilding', 'year_in_lore' => 'Year 3,100', 'description' => 'Seven celestial guardians are appointed to protect the remaining Pillars. Seraphon is assigned to the Voidfire Pillar.', 'type' => 'political', 'color' => '#a855f7', 'sort_order' => 5],
            ['title' => 'The Ashenveil Defiance (Seraphon Incident)', 'slug' => 'ashenveil-defiance', 'era' => 'The Current Age', 'year_in_lore' => 'Year 3,247', 'description' => 'Seraphon disobeys the Guardian Council to save Ashenveil village. The Voidfire Pillar cracks. She is cast down and her celestial fire transmuted.', 'type' => 'war', 'color' => '#ef4444', 'sort_order' => 6],
            ['title' => 'Kyrath\'s Dismissal', 'slug' => 'kyraths-dismissal', 'era' => 'The Current Age', 'year_in_lore' => 'Year 3,260', 'description' => 'Architect Kyrath presents evidence of a flaw in the Echo Lattice to the Unbound Scholarium. He is accused of treason and forced to flee with his blueprints.', 'type' => 'political', 'color' => '#06b6d4', 'sort_order' => 7],
            ['title' => 'Vela\'s Village Erased', 'slug' => 'vela-village-erased', 'era' => 'The Current Age', 'year_in_lore' => 'Year 3,271', 'description' => 'An unregistered Nullrift surge erases the village of Stormhaven. Vela, caught inside a lightning strike, is the sole survivor. The surge matches no known Nullrift activity pattern.', 'type' => 'catastrophe', 'color' => '#3b82f6', 'sort_order' => 8],
            ['title' => 'Seraphon Returns to Ashenveil', 'slug' => 'seraphon-returns-ashenveil', 'era' => 'The Current Age', 'year_in_lore' => 'Year 3,280 (Now)', 'description' => 'Seraphon descends to Ashenveil. A child named Pip reveals they can see a crack in the sky. The story begins.', 'type' => 'miracle', 'color' => '#f59e0b', 'sort_order' => 9],
        ];

        foreach ($timeline as $event) {
            DB::table('timeline_events')->insert(array_merge($event, ['is_published' => true, 'details' => null, 'created_at' => now(), 'updated_at' => now()]));
        }

        // Shop Items
        $shopItems = [
            ['name' => 'Echo-Realm: Base Game', 'slug' => 'base-game', 'description' => 'Enter the Echo-Realm. Full base game access including all six starting characters, Arc I story content, and the complete base world. This is where the resonance begins.', 'price' => 29.99, 'type' => 'game', 'rarity' => 'common', 'stock' => -1, 'is_featured' => true,
                'includes' => json_encode(['Base campaign (Arc I)', 'All 6 starter characters', 'Full world exploration', 'Multiplayer access', 'Basic cosmetic set'])],
            ['name' => 'Seraphon Character Bundle', 'slug' => 'seraphon-bundle', 'description' => 'Unlock Seraphon: The Last Ember with all her default abilities and her exclusive Obsidian Wings cosmetic variant. Includes her full voice line collection and personal lore chapter.', 'price' => 14.99, 'type' => 'character', 'rarity' => 'legendary', 'stock' => -1, 'is_featured' => true,
                'includes' => json_encode(['Seraphon character unlock', 'Obsidian Wings skin', '47 voice lines', 'Exclusive lore chapter: "Before the Fall"'])],
            ['name' => 'Kyrath Character Bundle', 'slug' => 'kyrath-bundle', 'description' => 'Unlock Kyrath: Echo Architect. Includes his base form, his rare Lattice Weave cosmetic armor, and access to his personal questline "The Scholarium Heresy."', 'price' => 12.99, 'type' => 'character', 'rarity' => 'epic', 'stock' => -1, 'is_featured' => false,
                'includes' => json_encode(['Kyrath character unlock', 'Lattice Weave armor skin', 'Personal questline', '38 voice lines'])],
            ['name' => 'Resonance Currency — 500 Shards', 'slug' => 'shards-500', 'description' => '500 Resonance Shards — the in-game premium currency. Use them for cosmetics, skip tokens, and special event items.', 'price' => 4.99, 'type' => 'currency', 'rarity' => 'common', 'stock' => -1, 'is_featured' => false],
            ['name' => 'Resonance Currency — 2200 Shards', 'slug' => 'shards-2200', 'description' => '2,200 Resonance Shards (best value — includes 200 bonus shards). For the serious traveler of the Echo-Realm.', 'price' => 19.99, 'original_price' => 21.99, 'type' => 'currency', 'rarity' => 'uncommon', 'stock' => -1, 'is_featured' => true],
            ['name' => 'Cinderquill: Midnight Bloom Skin', 'slug' => 'cinderquill-midnight-bloom', 'description' => 'A rare cosmetic skin for Cinderquill featuring dark petals, ghost-blue fire effects, and a special death/resurrection animation sequence. Very limited availability.', 'price' => 9.99, 'type' => 'skin', 'rarity' => 'legendary', 'stock' => 500, 'is_featured' => true,
                'includes' => json_encode(['Midnight Bloom skin', 'Custom death animation', 'Custom resurrection animation', 'Special particle effects'])],
            ['name' => 'The Founders Bundle', 'slug' => 'founders-bundle', 'description' => 'For those who were here at the beginning. Includes the base game, all 6 starter character bundles, 1000 Resonance Shards, and an exclusive Founders Frame cosmetic that permanently marks you as an original player.', 'price' => 59.99, 'original_price' => 94.94, 'type' => 'bundle', 'rarity' => 'legendary', 'stock' => 1000, 'is_featured' => true,
                'includes' => json_encode(['Base Game', 'All 6 starter character bundles', '1,000 Resonance Shards', 'Exclusive Founders Frame', 'Exclusive in-game title: "First Echo"', 'Priority beta access for all future expansions'])],
            ['name' => 'Lore Archive: Complete Tome Collection', 'slug' => 'complete-tome-collection', 'description' => 'Unlock all current and future Lore Tome entries, including classified and top-secret documents that hint at the true nature of the Seventh Pillar.', 'price' => 7.99, 'type' => 'cosmetic', 'rarity' => 'rare', 'stock' => -1, 'is_featured' => false,
                'includes' => json_encode(['All current lore tomes', 'Future lore tome access', '3 classified documents', '1 top-secret document: "The Seventh Frequency"'])],
        ];

        foreach ($shopItems as $item) {
            if (!isset($item['original_price'])) $item['original_price'] = null;
            if (!isset($item['includes'])) $item['includes'] = null;
            DB::table('shop_items')->insert(array_merge($item, ['is_Active' => true, 'preview_images' => null, 'created_at' => now(), 'updated_at' => now()]));
        }

        // Site Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Echo-Realm', 'type' => 'string'],
            ['key' => 'site_tagline', 'value' => 'The Resonance Awaits', 'type' => 'string'],
            ['key' => 'hero_title', 'value' => 'Enter the Echo-Realm', 'type' => 'string'],
            ['key' => 'hero_subtitle', 'value' => 'An immersive universe where ancient resonance and cosmic mystery converge. Choose your element. Find your echo. Uncover what shattered the world.', 'type' => 'string'],
            ['key' => 'maintenance_mode', 'value' => '0', 'type' => 'boolean'],
            ['key' => 'featured_banner', 'value' => 'The Seventh Pillar — Discover the truth behind the myth', 'type' => 'string'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insert(array_merge($setting, ['created_at' => now(), 'updated_at' => now()]));
        }
    }
}
