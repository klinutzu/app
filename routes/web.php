<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Initiatori
    Route::delete('initiatoris/destroy', 'InitiatoriController@massDestroy')->name('initiatoris.massDestroy');
    Route::resource('initiatoris', 'InitiatoriController');

    // Servicii
    Route::delete('serviciis/destroy', 'ServiciiController@massDestroy')->name('serviciis.massDestroy');
    Route::resource('serviciis', 'ServiciiController');

    // Comenzi
    Route::delete('comenzis/destroy', 'ComenziController@massDestroy')->name('comenzis.massDestroy');
    Route::post('comenzis/media', 'ComenziController@storeMedia')->name('comenzis.storeMedia');
    Route::post('comenzis/ckmedia', 'ComenziController@storeCKEditorImages')->name('comenzis.storeCKEditorImages');
    Route::resource('comenzis', 'ComenziController');

    // Instalari
    Route::delete('instalaris/destroy', 'InstalariController@massDestroy')->name('instalaris.massDestroy');
    Route::post('instalaris/media', 'InstalariController@storeMedia')->name('instalaris.storeMedia');
    Route::post('instalaris/ckmedia', 'InstalariController@storeCKEditorImages')->name('instalaris.storeCKEditorImages');
    Route::resource('instalaris', 'InstalariController');

    // Detaliitehnice
    Route::delete('detaliitehnices/destroy', 'DetaliitehniceController@massDestroy')->name('detaliitehnices.massDestroy');
    Route::resource('detaliitehnices', 'DetaliitehniceController');

    // Facturare
    Route::delete('facturares/destroy', 'FacturareController@massDestroy')->name('facturares.massDestroy');
    Route::resource('facturares', 'FacturareController');

    // Surveyuri
    Route::delete('surveyuris/destroy', 'SurveyuriController@massDestroy')->name('surveyuris.massDestroy');
    Route::post('surveyuris/media', 'SurveyuriController@storeMedia')->name('surveyuris.storeMedia');
    Route::post('surveyuris/ckmedia', 'SurveyuriController@storeCKEditorImages')->name('surveyuris.storeCKEditorImages');
    Route::resource('surveyuris', 'SurveyuriController');

    // Presales
    Route::delete('presales/destroy', 'PresalesController@massDestroy')->name('presales.massDestroy');
    Route::resource('presales', 'PresalesController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
