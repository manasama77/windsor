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
        Schema::create('class_room_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('homeroom_teacher_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('class_room_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_room_students');
    }
};
