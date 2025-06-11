@extends('layouts.app')
@section('content')
<h1 class="mb-4">Görev Listesi</h1>

<a href="{{ route('tasks.create') }}"
   class="inline-block mb-4 px-3 py-2 bg-blue-600 text-white rounded">
    + Yeni Görev
</a>

@include('partials.flash')

@if($tasks->isEmpty())
    <p>Henüz görev eklenmedi.</p>
@else
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Başlık</th>
                <th class="p-2 text-left">Açıklama</th>
                @if(session('role') === 'admin')
                    <th class="p-2 text-left">Kullanıcı</th>
                @endif
                <th class="p-2">İşlemler</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr class="border-t">
                <td class="p-2">{{ $task->title }}</td>
                <td class="p-2">{{ Str::limit($task->description, 60) }}</td>
                @if(session('role') === 'admin')
                    <td class="p-2">{{ $task->user_uni_id }}</td>
                @endif
                <td class="p-2">
                    <a href="{{ route('tasks.show', $task->task_id) }}" class="text-indigo-600 underline">Göster</a>
                    |
                    <a href="{{ route('tasks.edit', $task->task_id) }}" class="text-green-600 underline">Düzenle</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
@endsection