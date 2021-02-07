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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->string('name', 255);
            $table->string('email', 255)->nullable()->unique();
            $table->enum('gender', ['MALE', 'FEMALE']);
            $table->enum('identification_document', ['MILITARY_ID', 'NATIONAL_ID', 'PASSPORT']);
            $table->string('identification_number', 255);
            $table->unsignedBigInteger('primary_contact');
            $table->unsignedBigInteger('alternative_contact')->nullable();
            $table->text('address');
            $table->string('relation', 255);
            $table->timestamp('date_of_birth')->useCurrent();
            $table->string('nationality', 255);
            $table->timestamps();
            $table->unsignedBigInteger('loan_applications_id');
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
