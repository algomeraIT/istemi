<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Projects\ProjectDetail;
use App\Livewire\Projects\Projects as ProjectIndex;

Route::middleware(['auth'])->name('projects.')->group(function () {
    Route::get('/projects/{id}', ProjectDetail::class)->name('project-detail');
    Route::get('/project', ProjectIndex::class)->name('project');
});
