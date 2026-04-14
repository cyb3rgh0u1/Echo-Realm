<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->text('bio');
            $table->longText('lore')->nullable();
            $table->string('image')->nullable();
            $table->string('portrait')->nullable();
            $table->string('splash_art')->nullable();
            $table->foreignId('element_id')->nullable()->constrained('elements')->nullOnDelete();
            $table->enum('rarity', ['common', 'uncommon', 'rare', 'epic', 'legendary'])->default('rare');
            $table->enum('role', ['warrior', 'mage', 'healer', 'ranger', 'assassin', 'tank', 'support'])->default('warrior');
            $table->string('faction')->nullable();
            $table->string('weapon_type')->nullable();
            $table->json('stats')->nullable();
            $table->json('abilities')->nullable();
            $table->json('voice_lines')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_playable')->default(true);
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('characters'); }
};
