<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInstalarisTable extends Migration
{
    public function up()
    {
        Schema::table('instalaris', function (Blueprint $table) {
            $table->unsignedBigInteger('numar_comanda_id');
            $table->foreign('numar_comanda_id', 'numar_comanda_fk_3926877')->references('id')->on('comenzis');
            $table->unsignedBigInteger('survey_id');
            $table->foreign('survey_id', 'survey_fk_3927350')->references('id')->on('surveyuris');
        });
    }
}
