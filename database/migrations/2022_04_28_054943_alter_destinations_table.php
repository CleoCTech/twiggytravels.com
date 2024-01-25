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
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn('validity_from');
            $table->dropColumn('validity_to');
            $table->string('validity')->nullable()->after('extra_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->date('validity_to')->nullable()->after('extra_info');
            $table->date('validity_from')->nullable()->after('extra_info');
            $table->dropColumn('validity');
        });
    }
};