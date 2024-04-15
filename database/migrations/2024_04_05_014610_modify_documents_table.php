<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDocumentsTable extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            // Remove the 'document_path' column
            $table->dropColumn('document_path');
            // Add the 'file_name' column to store the original filename
            $table->string('file_name')->after('personnel');
        });
    }

    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            // Reverse the changes made in 'up' method
            $table->string('document_path')->after('personnel');
            $table->dropColumn('file_name');
        });
    }
}

