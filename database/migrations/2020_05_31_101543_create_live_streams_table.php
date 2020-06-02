<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_streams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->string('name');
            $table->string('detail');
            $table->datetime('start');
            $table->datetime('end');
            $table->text('document');
            $table->enum('status', [0,1])->default(1);
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');    
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');    
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
        Schema::dropIfExists('live_streams');
    }
}
