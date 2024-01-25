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
        Schema::create('destination_holiday_bindings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('destination_id')->nullable()->constrained('destinations');
            $table->foreignId('holiday_id')->nullable()->constrained('holiday_categories');
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
        Schema::dropIfExists('destination_holiday_bindings');
    }
};