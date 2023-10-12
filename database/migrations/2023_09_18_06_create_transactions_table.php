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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('us_id');
            $table->foreign('us_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('transaction_type_id');
            $table->foreign('transaction_type_id')
                  ->references('id')
                  ->on('transaction_types')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->text('transaction_description')->nullable();
            $table->decimal('transaction_amount',10,2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::table('transactions', function (Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
};
