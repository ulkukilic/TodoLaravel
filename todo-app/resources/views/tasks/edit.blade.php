@extends('layouts.app')
@section('content')
<h1 class="mb-4">Görev Düzenle</h1>
<form action="{{ route('tasks.update', $task->task_id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label for="title" class="block font-semibold">Başlık *</label>
        <input type="text"
               id="title"
               name="title"
               value="{{ old('title', $task->title) }}"
               required
               class="w-full border p-2 rounded">
    </div>

    <div>
        <label for="description" class="block font-semibold">Açıklama</label>
        <textarea id="description"
                  name="description"
                  rows="4"
                  class="w-full border p-2 rounded">{{ old('description', $task->description) }}</textarea>
    </div>

    <button type="submit"
            class="px-4 py-2 bg-green-600 text-white rounded">
        Güncelle
    </button>

    <a href="{{ route('tasks.index') }}" class="ml-4 text-gray-500 underline">Listeye dön</a>
</form>
@endsection