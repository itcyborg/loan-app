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
            $table->unsignedBigInteger('product_id');
            $table->unsignedDouble('rate');
            $table->unsignedDouble('amount_applied');
            $table->longText('purpose')->nullable();
            $table->unsignedDouble('amount_approved')->nullable();
            $table->unsignedDouble('total_interest')->default(0);
            $table->unsignedInteger('duration');
            $table->timestamp('due_date')->nullable();
            $table->timestamp('approval_date')->nullable();
            $table->timestamp('disbursement_date')->nullable();
            $table->enum('repayment_frequency',['DAILY','WEEKLY','MONTHLY','QUARTERLY']);
            $table->unsignedDouble('total_amount_repaid')->default(0);
            $table->enum('status',['PENDING','APPROVED','DISBURSED','REJECTED','SETTLED'])->default('PENDING');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id');
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
