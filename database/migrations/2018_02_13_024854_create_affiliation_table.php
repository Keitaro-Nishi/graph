<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliation', function (Blueprint $table) {
            $table->string('citycode', 5);
            $table->integer('aid')->unique();
            $table->string('organization');
            $table->char('restriction', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affiliation', function (Blueprint $table) {
            //
        });
    }
}
