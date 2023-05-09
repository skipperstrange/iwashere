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
        Schema::create('student_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->references('id')->on('courses');
            $table->unsignedBigInteger('student_id')->references('id')->on('student');
            $table->enum('status', array('incomplete','complete'))->nullable()->default('incomplete');
            $table->primary(['course_id', 'student_id']);
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
        Schema::dropIfExists('student_courses');
    }
};
