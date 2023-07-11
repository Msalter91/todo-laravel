@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('styles') 

@section('content')
<form class="mx-auto p-4 flex flex-col justify-center items-center" method="POST"  action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
  @csrf

  @isset($task)
  @method('PUT')
  @endisset

  <div class="flex flex-col justify-center items-center">
    <label for="title" class="block">
      Title
    </label>
    <input class="border-2 border-teal-500" type="text" name="title" id="title" value="{{ $task->title ?? old('title')}}"/>
    @error('title')
    <p class="text-red-700">{{$message}}</p>
    @enderror
  </div>
  <div class="flex flex-col justify-center items-center">
    <label for="description" class="block">
      Description
    </label>
    <textarea class="border-2 border-teal-500" name="description" id="description" rows="5">{{ $task->title ?? old('description')}}</textarea>
    @error('description')
    <p class="text-red-700">{{$message}}</p>
    @enderror
  </div>
  <div class="flex flex-col justify-center items-center">
    <label for="long_description">
      Longer Description
    </label>
    <textarea class="border-2 border-teal-500" name="long_description" id="long_description" rows="10">{{$task->title ?? old('long_description')}}</textarea>
    @error('long_description')
    <p class="text-red-700">{{$message}}</p>
    @enderror
  </div>
  <div>
    <button class="bg-green-300 p-1 m-2" type="submit">@isset($task)
      Update Task
      @else
      Add Task
    @endisset</button> 
  </div>
</form>
  <div class="flex flex-col justify-center items-center">
<button class="bg-yellow-300 p-1 m-2"><a href="{{route('tasks.index')}}">Back to main menu</a></button> 
  </div>
@endsection