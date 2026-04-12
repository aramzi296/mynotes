<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NoteController::class, 'index'])->name('home');
Route::get('/search', [NoteController::class, 'search'])->name('notes.search');
Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');
Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
