<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Contact;


$isInstall = Schema::hasTable('contacts');
if (!$isInstall) {
    Artisan::call('migrate');
    Artisan::call('db:seed');
}

Route::get('/', function () {
    $contacts = Contact::all();

    return view('contacts')
        ->with('contacts', $contacts);
});

Route::post('/', function () {
    Contact::create(Input::all());

    return back();
});

Route::get('/{id}/delete', function ($id) {
    $contact = Contact::find($id);

    $contact->delete();

    return back();
});