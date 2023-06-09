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
        Schema::create('programmes_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('programme_id')->references('id')->on('programmes')->onDelete('cascade');
            $table->primary(['course_id', 'programme_id']);
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
        Schema::dropIfExists('programme_courses');
    }
};
