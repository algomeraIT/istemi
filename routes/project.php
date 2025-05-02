<?php
use App\Http\Controllers\ProjectController;
use App\Livewire\Projects\ProjectDetail;

Route::middleware(['auth'])->group(function () {
    Route::get('/projects/{id}', ProjectDetail::class)->name('projects.project-detail');

    Route::get('/project', [ProjectController::class, 'index'])->name('projects.project');
    Route::get('/project/{id}', [ProjectController::class, 'goToDetail'])->name('project.project-detail');

});
