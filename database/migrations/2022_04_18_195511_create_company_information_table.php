<?php

use App\Traits\Admin\UuidTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
        Schema::create('company_information', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string("company_name");
            $table->string("short_name")->nullable();
            $table->date("establishment_date")->nullable();
            $table->string("history",3000)->nullable();
            $table->string("vision",3000)->nullable();
            $table->string("mission",3000)->nullable();
            $table->string("location");
            $table->string("about_short")->nullable();
            $table->integer("total_people_helped")->default(0);
            $table->string("about",3000)->nullable();
            $table->string("about_newsletter")->nullable();
            $table->string("emails");
            $table->string("phone_numbers");
            $table->string("address")->nullable();
            $table->string("logo")->nullable();
            $table->integer("status")->default(2);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
        DB::table('company_information')->insert(
            [
                [
                    'uuid' => Uuid::generate(),
                    'company_name' => 'Wenla Systems & Solutions Ltd.',
                    'history' => 'Our journey started....',
                    'vision' => 'Default Vision Statement',
                    'mission' => 'Default Mission Statement',
                    'location' => 'Nairobi,Kenya',
                    'emails' => 'info@wenlasystems.com',
                    'phone_numbers' => "0727057310 or 0751019142",
                    'address' => "661-00300 Nairobi",
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_information');
    }
};