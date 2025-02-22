<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressBookApiController;
use App\Http\Controllers\UsersApiController;
use App\Http\Controllers\ContactsApiController;
use App\Http\Controllers\NotesApiController;

Route::get('/users', [UsersApiController::class, 'index']);
Route::get('/users/address-book/{id}', [UsersApiController::class, 'addressBook']);
Route::post('/user', [UsersApiController::class, 'store']);
Route::post('/user/{id}/note', [UsersApiController::class, 'storeNote']);
Route::delete('/user/{id}', [UsersApiController::class, 'destroy']);
Route::delete('/user/{id}/note', [UsersApiController::class, 'destroyNote']);

Route::get('/contacts', [ContactsApiController::class, 'index']);
Route::post('/contact', [ContactsApiController::class, 'store']);
Route::post('/user/{id}/add-note', [ContactsApiController::class, 'storeNote']);
Route::delete('/contact/{id}', [ContactsApiController::class, 'delete']);
Route::delete('/user/{id}/delete-note', [ContactsApiController::class, 'destroyNote']);

Route::get('/notes', [NotesApiController::class, 'index']);
Route::post('/note', [NotesApiController::class, 'store']);
Route::delete('/note/{id}', [NotesApiController::class, 'delete']);

Route::get('/address-book', [AddressBookApiController::class, 'index']);
Route::post('/address-book-record', [AddressBookApiController::class, 'store']);
Route::delete('/address-book-record/{id}', [AddressBookApiController::class, 'delete']);

