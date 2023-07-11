<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use App\Models\Task as DbTask;

Route::get('/', function () {
  return redirect('/tasks');
});

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks', function () {
    return view('index', [
      'tasks' => DbTask::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::get('/tasks/{task}', function (DbTask $task) {

  return(view('show', [
    'task' => $task
  ]));

})->name('tasks.show');

//if validation fails it goes back one page and sets an error variable in the $errors variable available to all views

Route::post('/tasks', function (TaskRequest $request) {
  $data = $request->validated();
  $task = DbTask::create($data);
  return redirect()
  ->route('tasks.show', ['task' => $task->id])
  ->with('success', 'Task created successfully');
})->name('tasks.store');

Route::get('/tasks/{task}/edit', function (DbTask $task) {

  return(view('edit', [
    'task' => $task
  ]));

})->name('tasks.edit');

Route::put('/tasks/{task}', function (DbTask $task, TaskRequest $request) {
  $data = $request->validated();
  $task->update($data);
  return redirect()
  ->route('tasks.show', ['task' => $task->id])
  ->with('success', 'Task edited');
})->name('tasks.update');

Route::put('/tasks/{task}/toggle-complete', function (DbTask $task) {

  $task->toggleComplete();

  return redirect()->back()->with('success', 'Status updated');
})->name('tasks.toggle-complete');

Route::delete('/tasks/{task}', function (DbTask $task) {
  $task->delete();
  return redirect()->route('tasks.index')->with('success', 'Task deleted');
})->name('tasks.destroy');

// Fallback route
Route::fallback(function () {
  return 'Close enough';
});