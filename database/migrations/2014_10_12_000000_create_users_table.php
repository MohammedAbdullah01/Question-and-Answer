<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            // $table->unsignedBigInteger('question_id')->deflate_init(0);
            // $table->foreign('question_id')->deflate_init(0)->references('id')->on('questions')->onDelete('Cascade')->onUpdate('Cascade');
            // $table->bigInteger('question_id')->constrained('questions')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->default('avatar.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
