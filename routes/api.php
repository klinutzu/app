<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Initiatori
    Route::apiResource('initiatoris', 'InitiatoriApiController');

    // Servicii
    Route::apiResource('serviciis', 'ServiciiApiController');

    // Comenzi
    Route::post('comenzis/media', 'ComenziApiController@storeMedia')->name('comenzis.storeMedia');
    Route::apiResource('comenzis', 'ComenziApiController');

    // Instalari
    Route::post('instalaris/media', 'InstalariApiController@storeMedia')->name('instalaris.storeMedia');
    Route::apiResource('instalaris', 'InstalariApiController');

    // Detaliitehnice
    Route::apiResource('detaliitehnices', 'DetaliitehniceApiController');

    // Facturare
    Route::apiResource('facturares', 'FacturareApiController');

    // Surveyuri
    Route::post('surveyuris/media', 'SurveyuriApiController@storeMedia')->name('surveyuris.storeMedia');
    Route::apiResource('surveyuris', 'SurveyuriApiController');
});
