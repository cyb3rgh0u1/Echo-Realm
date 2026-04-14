<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Lore Tomes
        Schema::create('lore_entries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('cover_image')->nullable();
            $table->string('category')->default('general');
            $table->json('tags')->nullable();
            $table->enum('classification', ['public', 'classified', 'top_secret'])->default('public');
            $table->boolean('is_published')->default(true);
            $table->integer('read_time')->default(5);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Story Arcs
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('synopsis');
            $table->longText('content');
            $table->string('cover_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->integer('arc_number')->default(1);
            $table->integer('chapter_number')->default(1);
            $table->enum('status', ['ongoing', 'completed', 'hiatus'])->default('ongoing');
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Timeline Events
        Schema::create('timeline_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->longText('details')->nullable();
            $table->string('era')->nullable();
            $table->string('year_in_lore')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->default('#a855f7');
            $table->enum('type', ['war', 'discovery', 'birth', 'death', 'catastrophe', 'miracle', 'political', 'cultural'])->default('cultural');
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Shop Items
        Schema::create('shop_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->enum('type', ['game', 'character', 'skin', 'bundle', 'currency', 'consumable', 'cosmetic'])->default('cosmetic');
            $table->enum('rarity', ['common', 'uncommon', 'rare', 'epic', 'legendary'])->default('common');
            $table->integer('stock')->default(-1); // -1 = unlimited
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->json('includes')->nullable();
            $table->json('preview_images')->nullable();
            $table->timestamps();
        });

        // Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pending', 'paid', 'processing', 'completed', 'cancelled', 'refunded'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('payment_id')->nullable();
            $table->json('billing_info')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Order Items
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shop_item_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        // Site Settings
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->string('type')->default('string');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('shop_items');
        Schema::dropIfExists('timeline_events');
        Schema::dropIfExists('stories');
        Schema::dropIfExists('lore_entries');
        Schema::dropIfExists('settings');
    }
};
