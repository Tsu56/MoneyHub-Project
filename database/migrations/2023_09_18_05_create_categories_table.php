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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->unsignedBigInteger('transaction_type_id');
            $table->foreign('transaction_type_id')
            ->references('id')
            ->on('transaction_types')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedBigInteger('us_id')->nullable();
            $table->foreign('us_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::table('categories', function (Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
};
