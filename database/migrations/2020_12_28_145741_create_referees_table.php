<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefereesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referees', function (Blueprint $table) {
            $table->id();
            $table->uuid('log_id');
            $table->unsignedBigInteger('loan_id');
            $table->string('name');
            $table->enum('gender',['MALE','FEMALE']);
            $table->enum('identification_document',['MILITARY_ID','NATIONAL_ID','PASSPORT']);
            $table->string('identification_number')->unique();
            $table->unsignedBigInteger('primary_contact');
            $table->unsignedBigInteger('alternative_contact')->nullable();
            $table->string('nationality');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referees');
    }
}
