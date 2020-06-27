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
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status',['PENDING','APPROVED','DISBURSED','REJECTED','SETTLED'])->default('PENDING');
            $table->unsignedDouble('rate');
            $table->unsignedDouble('amount_applied');
            $table->unsignedDouble('amount_approved');
            $table->unsignedDouble('total_interest');
            $table->unsignedInteger('duration');
            $table->timestamp('due_date')->nullable();
            $table->timestamp('approval_date')->nullable();
            $table->timestamp('disbursement_date')->nullable();
            $table->longText('purpose')->nullable();
            $table->enum('repayment_frequency',['DAILY','WEEKLY','MONTHLY','QUARTERLY']);
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
        Schema::dropIfExists('loan_applications');
    }
}
