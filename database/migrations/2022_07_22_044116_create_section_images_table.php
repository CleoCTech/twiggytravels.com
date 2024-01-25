<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Traits\Admin\UuidTrait;

return new class extends Migration
{
    use UuidTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_images', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string("area");
            $table->string("highlight")->nullable();
            $table->string("other_info")->nullable();
            $table->string("cover_image")->nullable();
            $table->integer("status");
            $table->timestamp("publish_time")->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
        $array = [
            ['uuid' =>Uuid::generate(),'area' => "Welcome/Highlight section ->[Home Page]", 'status' => 1],
            ['uuid' =>Uuid::generate(),'area' => "About Us section ->[Home Page]", 'status' => 1],
            ['uuid' =>Uuid::generate(),'area' => "Video Section ->[Home Page]", 'status' => 1],
            ['uuid' =>Uuid::generate(),'area' => "Faq->[Home Page]", 'status' => 1],
            ['uuid' =>Uuid::generate(),'area' => "Banner Area->[Tours Page]", 'status' => 1],
            ['uuid' =>Uuid::generate(),'area' => "Banner Area->[About Page]", 'status' => 1],
        ];
        DB::table('section_images')->insert($array);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_images');
    }
};