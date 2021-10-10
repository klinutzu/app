<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToComenzisTable extends Migration
{
    public function up()
    {
        Schema::table('comenzis', function (Blueprint $table) {
            $table->unsignedBigInteger('initiator_id');
            $table->foreign('initiator_id', 'initiator_fk_3926860')->references('id')->on('initiatoris');
            $table->unsignedBigInteger('presales_id');
            $table->foreign('presales_id', 'presales_fk_5075731')->references('id')->on('presales');
        });
    }
}
