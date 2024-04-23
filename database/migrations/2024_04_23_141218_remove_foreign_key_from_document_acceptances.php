<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeyFromDocumentAcceptances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_acceptances', function (Blueprint $table) {
            // Remove the foreign key constraint
            $table->dropForeign(['document_id']);
            // Make the column nullable
            $table->unsignedBigInteger('document_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // If you want to revert the changes, you can add code to the down() method
        // This could involve adding back the foreign key constraint and making the column non-nullable
    }
}