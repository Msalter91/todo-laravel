@extends('layouts.app')
@section('title', $task->title)

@section('content')
@if ($task->long_description)
  <p class="mb-4 text-slate-700">{{$task->long_description}}
  @else
  <p class="mb-4 text-slate-700">{{$task->description}}</p>
@endif

<div class="mb-4">
  <a href="{{route('tasks.index')}}"><- Back to the task list</a>
</div>

<p class="mb-4 text-sm text-slate-500">{{  'created ' . $task->created_at->diffForHumans()  }} · {{  'updated ' . $task->updated_at->diffForHumans()  }}</p>

<div 
@class([$task->completed ? "bg-green-500" : "bg-red-500", "max-w-fit", "mb-4"])
>
<p class="p-3">{{$task->completed ? 'Task Complete' : 'Task outstanding'}}</p>
</div>

<form action="{{route('tasks.toggle-complete', ['task' => $task])}}" method="POST" class="mb-4">
@csrf
@method('PUT')
<button type="submit">
  @if($task->completed)
  Mark not-complete
  @else
  Mark complete
  @endif
</button>
</form>

<div class="mb-4">
  <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">Edit</a>
</div>

<form action="{{route('tasks.destroy', ['task' => $task->id])}}" method="POST">
  @csrf
  @method('DELETE')
  <button type="submit" class="text-red-500">
    Delete this task
  </button>

</form>
@endsection
