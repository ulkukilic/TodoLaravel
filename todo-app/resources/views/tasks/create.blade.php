@extends('layouts.app')
@section('content')
<h1 class="mb-4">Yeni Görev Ekle</h1>
<form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
    @csrf
  <div>
        <label for="title" class="block font-semibold">Başlık *</label>
        <input type="text"
               id="title"
               name="title"
               value="{{ old('title') }}"
               required
               class="w-full border p-2 rounded">
    </div>   

    <div>
        <label for="description" class="block font-semibold">Açıklama</label>
        <textarea id="description"
                  name="description"
                  rows="4"
                  class="w-full border p-2 rounded">{{ old('description') }}</textarea>
    </div>
   
    <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded">
        Kaydet
    </button>
</form>
@endsection