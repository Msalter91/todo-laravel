@extends('layouts.app')
@section('title')
Task List
@endsection
@section('content')
<nav class="mb-2">
<a class="font-medium text-pink-700 underline mt-2" href="{{route('tasks.create')}}">Add a new task</a>
</nav>
  @forelse ($tasks as $task )
  <div>
    <a href="{{route('tasks.show', ['task' => $task->id])}}"
      @class(['line-through' => $task->completed])> {{$task->title}} 
    </a>
  <div>
  @empty
  <div>There are no todos</div>
  @endforelse
  <div>
  @if($tasks->count())
  {{$tasks->links()}}
  @endif
  </div>
@endsection