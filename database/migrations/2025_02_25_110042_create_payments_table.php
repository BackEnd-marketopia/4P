<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('trnx_id')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->double('amount');
            $table->string('txn_response_code')->nullable();
            $table->string('message')->nullable();
            $table->boolean('pending')->nullable();
            $table->boolean('success')->nullable();
            $table->string('type')->nullable();
            $table->string('source_data_sub_type')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
