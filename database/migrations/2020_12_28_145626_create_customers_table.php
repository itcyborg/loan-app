<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->uuid('log_id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->enum('gender',['MALE','FEMALE']);
            $table->enum('identification_document',['MILITARY_ID','NATIONAL_ID','PASSPORT']);
            $table->string('identification_number')->unique();
            $table->unsignedBigInteger('primary_contact');
            $table->unsignedBigInteger('alternative_contact')->nullable();
            $table->text('address');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->timestamp('date_of_birth');
            $table->string('nationality');
            $table->enum('status',['ACTIVE','INACTIVE'])->default('INACTIVE');
            $table->unsignedBigInteger('agent_id');
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
        Schema::dropIfExists('customers');
    }
}
