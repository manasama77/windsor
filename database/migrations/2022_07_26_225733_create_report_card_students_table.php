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
        Schema::create('report_card_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_card_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('kkm');
            $table->integer('pengetahuan_nilai');
            $table->integer('pengetahuan_predikat');
            $table->integer('keterampilan_nilai');
            $table->integer('keterampilan_predikat');
            $table->longText('keterangan');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('report_card_students');
        Schema::enableForeignKeyConstraints();
    }
};
