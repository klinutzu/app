<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSurveyurisTable extends Migration
{
    public function up()
    {
        Schema::table('surveyuris', function (Blueprint $table) {
            $table->unsignedBigInteger('numar_comanda_id');
            $table->foreign('numar_comanda_id', 'numar_comanda_fk_3927233')->references('id')->on('comenzis');
        });
    }
}
