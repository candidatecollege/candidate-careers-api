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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('full_name');
            $table->string('university');
            $table->string('major');
            $table->string('instagram');
            $table->string('whatsapp');
            $table->unsignedBigInteger('divisionID');
            $table->unsignedBigInteger('departmentID');
            $table->text('reason');
            $table->text('leadership_experience');
            $table->text('skill_experience');
            $table->text('busyness');
            $table->integer('commitment_value');
            $table->text('reason_commitment_value');
            $table->string('cv');
            $table->string('portfolio');
            $table->boolean('is_available_for_unpaid');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('divisionID')->references('id')->on('divisions');
            $table->foreign('departmentID')->references('id')->on('departments');
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
};
