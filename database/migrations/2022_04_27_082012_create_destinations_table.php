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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string("title");
            $table->foreignId('category_id')->nullable()->constrained('destination_categories');
            $table->string("content",3000);
            $table->string("cover_image");
            $table->string("extra_info")->nullable();
            $table->date("validity_from")->nullable();
            $table->date("validity_to")->nullable();
            $table->integer("status");
            $table->datetime("publish_time")->nullable();
            $table->integer("sequence")->nullable();
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
        Schema::dropIfExists('destinations');
    }
};
