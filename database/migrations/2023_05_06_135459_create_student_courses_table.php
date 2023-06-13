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
            $table->unsignedBigInteger('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->enum('status', ['enrolled', 'complete', 'not enrolled'])->nullable()->default('enrolled');
            $table->timestamps();

            $table->primary(['course_id', 'student_id']);
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
