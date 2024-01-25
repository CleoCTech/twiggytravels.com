<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_category_bindings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('destination_id')->nullable()->constrained('destinations');
            $table->foreignId('price_category_id')->nullable()->constrained('price_categories');
            $table->float('price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_category_bindings');
    }
};
