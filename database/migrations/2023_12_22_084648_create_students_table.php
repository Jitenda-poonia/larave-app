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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("first_name",30);
            $table->string("last_name",30)->nulable;
            $table->date("dob");
            $table->string("email",100)->unique;
            $table->string("phone",10);
            $table->string("gender",10)->comment('[m:Male,f:female]');
            $table->text("address");
            $table->string("city",30);
            $table->string("state",30);
            $table->string("country",30);
            $table->integer("pncode");
            $table->string("hobbies");
            $table->string("course");

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
        Schema::dropIfExists('students');
    }
};
