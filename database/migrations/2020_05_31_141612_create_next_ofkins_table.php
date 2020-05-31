<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNextOfkinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('next_ofkins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->enum('gender',['MALE','FEMALE']);
            $table->enum('identification_document',['MILITARY_ID','NATIONAL_ID','PASSPORT']);
            $table->string('identification_number')->unique();
            $table->unsignedBigInteger('primary_contact');
            $table->unsignedBigInteger('alternative_contact')->nullable();
            $table->text('address');
            $table->string('relation');
            $table->timestamp('date_of_birth');
            $table->string('nationality');
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
        Schema::dropIfExists('next_ofkins');
    }
}
