<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('icon')->nullable();
            $table->string('color')->default('#ffffff');
            $table->string('glow_color')->default('#ffffff');
            $table->string('symbol')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('elements'); }
};
