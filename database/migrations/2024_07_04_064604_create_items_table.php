<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('mfg_name')->nullable();
            $table->string('mfg_item_number')->nullable();
            $table->string('item_number')->nullable();
            $table->integer('available')->default(0);
            $table->boolean('ltl')->default(false);
            $table->integer('mfg_qty_available')->nullable();
            $table->string('stocking')->nullable();
            $table->string('special_order')->nullable();
            $table->string('oversize')->nullable();
            $table->string('addtl_handling_charge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
