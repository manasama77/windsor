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
        Schema::create('user_onlines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('user_type', ['teacher', 'student'])->nullable(false);
            $table->integer('user_id')->nullable(false);
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
        Schema::dropIfExists('user_onlines');
        Schema::enableForeignKeyConstraints();
    }
};
