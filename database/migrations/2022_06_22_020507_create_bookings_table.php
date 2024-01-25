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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('destination_id')->nullable()->constrained('destinations');
            $table->string('name');
            $table->string('email');
            $table->string('phone_no');
            $table->string('resident_country');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('adults_no')->default(0);
            $table->integer('children_no')->default(0);
            $table->string('message', 3000);
            $table->integer("status")->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
