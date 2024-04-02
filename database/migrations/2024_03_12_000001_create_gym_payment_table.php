<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGymPaymentTable extends Migration
{
    public function up()
    {
        Schema::create('gym_payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gym_members_id');
            $table->decimal('amount', 8, 2);
            $table->enum('type',['cash','gcash'])->default('cash');
            $table->string('transaction_code')->nullable();
            $table->enum('payment_for',['monthly', 'session', 'bi_monthly','6_months', 'annual', '1_year'])-> default('annual');
            $table->timestamps();

            $table->foreign('gym_members_id')->references('id')->on('gym_members')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('gym_payment');
    }
}

