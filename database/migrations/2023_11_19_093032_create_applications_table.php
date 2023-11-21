<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('destination');
            $table->string('currency')->default('USD');
            $table->float('amount');
            $table->enum('frequency', ['monthly', 'quarterly'])->default('monthly');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address')->nullable();
            $table->string('country');
            $table->string('email');
            $table->text('message')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
