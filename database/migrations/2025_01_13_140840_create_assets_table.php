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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('cash_out_id')->nullable(true);
            $table->unsignedBigInteger('cash_in_id')->nullable(true);
            $table->unsignedBigInteger('category_id')->nullable(true);
            $table->date('date');
            $table->integer('amount');
            $table->decimal('value', 15, 2);
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();
            
            $table->foreign('cash_out_id')->references('id')->on('cash_outs')->onDelete('set null');
            $table->foreign('cash_in_id')->references('id')->on('cashs')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
