<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Assuming you have a user_id foreign key
            $table->string('department');
            $table->string('personnel');
            $table->string('file_name');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Assuming 'users' is the name of your users table. Change it if your table name is different.
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}