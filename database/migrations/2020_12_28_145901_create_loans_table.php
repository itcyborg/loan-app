<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->uuid('log_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedDouble('rate');
            $table->longText('purpose')->nullable();
            $table->unsignedDouble('amount_applied');
            $table->unsignedDouble('amount_approved')->nullable();
            $table->unsignedDouble('total_interest')->default(0);
            $table->unsignedInteger('duration');
            $table->timestamp('due_date')->nullable();
            $table->timestamp('approval_date')->nullable();
            $table->timestamp('disbursement_date')->nullable();
            $table->enum('repayment_frequency',['DAILY','WEEKLY','MONTHLY','QUARTERLY']);
            $table->unsignedDouble('total_amount_repaid')->default(0);
            $table->enum('status',['PENDING','APPROVED','DISBURSED','REJECTED','SETTLED'])->default('PENDING');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('loan_officer')->nullable();
            $table->unsignedBigInteger('applied_by')->nullable();
            $table->unsignedBigInteger('disbursed_by')->nullable();
            $table->json('product_config');
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
        Schema::dropIfExists('loans');
    }
}
