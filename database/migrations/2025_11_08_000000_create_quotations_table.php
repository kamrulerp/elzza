<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->enum('product_type', ['Window frame', 'Door frame', 'Sliding door'])->default('Window frame');

            $table->enum('execution_timeframe', ['ASAP', 'Within 3 months', '3-6 months','To be determined'])->default('Within 3 months');
            $table->string('upload_file')->nullable();
            $table->text('description');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quotations');
    }
};