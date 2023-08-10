<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('divisionID');
            $table->unsignedBigInteger('departmentID');
            $table->unsignedBigInteger('positionID');
            $table->string('name');
            $table->enum('type', ['Remote', 'Onsite', 'Hybrid']);
            $table->boolean('is_urgently_needed')->nullable()->default(false);
            $table->text('responsibilities');
            $table->text('skill_qualifications');
            $table->text('benefits');
            $table->text('descriptions');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('divisionID')->references('id')->on('divisions');
            $table->foreign('departmentID')->references('id')->on('departments');
            $table->foreign('positionID')->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('careers');
    }
};
