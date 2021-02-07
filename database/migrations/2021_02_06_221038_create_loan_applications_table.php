<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['PENDING', 'APPROVED', 'DISBURSED', 'REJECTED', 'SETTLED', 'CANCELLED'])->default('PENDING');
            $table->double('rate')->unsigned();
            $table->double('amount_applied')->unsigned();
            $table->double('amount_approved')->unsigned()->nullable();
            $table->double('total_interest')->unsigned();
            $table->unsignedInteger('duration');
            $table->timestamp('due_date')->nullable();
            $table->timestamp('approval_date')->nullable();
            $table->timestamp('disbursement_date')->nullable();
            $table->longText('purpose')->nullable();
            $table->enum('repayment_frequency', ['DAILY', 'WEEKLY', 'MONTHLY', 'QUARTERLY']);
            $table->timestamps();
            $table->unsignedBigInteger('officer_id');
            $table->unsignedBigInteger('applied_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('disbursed_by')->nullable();
            $table->string('channel', 128)->nullable();
            $table->text('account')->nullable();
            $table->longText('product_config')->nullable();
            $table->longText('charges_config')->nullable();
            $table->unsignedBigInteger('disbursed_amount')->nullable()->default(0);
            $table->double('overpayment', 26, 0)->unsigned()->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_applications');
    }
}
