<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repayments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('loan_application_id');
            $table->date('due_date');
            $table->double('amount')->unsigned();
            $table->double('amount_paid')->default(0);
            $table->double('amount_default')->default(0);
            $table->double('penalty')->unsigned()->default(0);
            $table->double('interest')->unsigned()->nullable()->default(0);
            $table->timestamps();
            $table->double('total_to_pay')->nullable()->default(0);
            $table->integer('status')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repayments');
    }
}
