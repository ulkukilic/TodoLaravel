@extends('layouts.app')
@section('content')

<!--  bu sayfa tek gorevin detaylarini gosteriyor-->
  <h1 class="mb-2">{{ $task->title }}</h1>

<p class="mb-4 text-gray-700">{{ $task->description ?: 'Açıklama yok.' }}</p>

<ul class="mb-6 text-sm text-gray-600">
    <li><strong>Görev No:</strong> {{ $task->task_id }}</li>
    @if(session('role') === 'admin')
        <li><strong>Kullanıcı ID:</strong> {{ $task->user_uni_id }}</li>
    @endif
    <li><strong>Oluşturuldu:</strong> {{ $task->created_at }}</li>
    <li><strong>Güncellendi:</strong> {{ $task->updated_at }}</li>
</ul>

<a href="{{ route('tasks.edit', $task->task_id) }}"
   class="px-3 py-2 bg-green-600 text-white rounded">
    Düzenle
</a>

<a href="{{ route('tasks.index') }}" class="ml-4 text-gray-500 underline">Listeye dön</a>
@endsection