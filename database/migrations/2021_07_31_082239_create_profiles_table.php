<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('gender')->nullable();
            $table->string('mobile_number')->unique();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->integer('education')->nullable()->comment('1 => SD, 2 => SMP, 3 => SMA, 4 => DIPLOMA, 5 => SARJANA');
            $table->string('profile_picture')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
