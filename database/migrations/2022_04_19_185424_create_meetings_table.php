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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('class_room_student_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->boolean('is_task')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
};
