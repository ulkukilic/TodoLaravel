@extends('layouts.app')
@section('content')
<h1 class="mb-6 text-2xl font-bold">Yönetici Kontrol Paneli</h1>
<div class="grid gap-6 md:grid-cols-3">
    <!-- Toplam kullanıcı sayısı (Controller’dan $userCount olarak gönderilecek) -->
    <div class="p-5 rounded shadow bg-blue-100">
        <h2 class="text-sm font-semibold text-blue-800">Kullanıcılar</h2>
        <p class="text-3xl font-bold text-blue-900">{{ $userCount ?? '—' }}</p>
    </div>

    <!-- Toplam gorev sayisini gostericek -->
    <div class="p-5 rounded shadow bg-green-100">
        <h2 class="text-sm font-semibold text-green-800">Görevler</h2>
        <p class="text-3xl font-bold text-green-900">{{ $taskCount ?? '—' }}</p>
    </div>

    <h2 class="text-xl font-semibold mb-4">Hızlı Erişim</h2>
    <ul class="space-y-2">
        <li>
            <a href="{{ route('tasks.index') }}"
            class="inline-block px-4 py-2 bg-indigo-600 text-white rounded">
                Tüm Görevleri Yönet
            </a>
        </li>

        <li>
            <a href="{{ route('register.form') }}"
            class="inline-block px-4 py-2 bg-teal-600 text-white rounded">
                Yeni Kullanıcı Oluştur
            </a>
        </li>
    </ul>