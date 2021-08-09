<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('talent_id');
            $table->unsignedBigInteger('guru_id');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('notes')->nullable();
            $table->tinyInteger('is_approved')->nullable()->comment('1 => Waiting, 2 => Approved, 3 => Not Approved')->default(1);
            $table->text('approved_reason')->nullable();
            $table->tinyInteger('is_saved')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('talent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
