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
    Schema::create('courses_lecturers', function (Blueprint $table) {
        $table->unsignedBigInteger('course_id')->references('id')->on('courses');
        $table->unsignedBigInteger('lecturer_id')->references('id')->on('lecturers');
        $table->primary(['course_id', 'lecturer_id']);
        $table->timestamps();
        $table->softDeletes(); // Add soft deletes
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses_lecturers');
    }
};
