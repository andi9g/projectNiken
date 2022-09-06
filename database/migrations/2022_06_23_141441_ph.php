<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ph extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perangkat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String("perangkat")->unique();
            $table->String("akses")->unique();
            $table->String("key_post");
            $table->timestamps();
        });

        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String("username")->unique();
            $table->String("nama");
            $table->String("password");
            $table->String("akses")->nullable();
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
        Schema::drop('perangkat');
        Schema::drop('admin');
    }
}
