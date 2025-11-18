<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Campaign</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>
<body class="bg-gray-100">
    
@include('components.header')

<div class="max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow-md mt-6">
    <h1 class="text-3xl font-bold text-purple-700 mb-4">{{ $campaign->judul_campaign }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 mb-6">
        <p><strong>Status:</strong> {{ $campaign->status_campaign }}</p>
        <p><strong>Kategori:</strong> {{ $campaign->kategori->nama_kategori ?? '-' }}</p>
        <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($campaign->tanggal_mulai)->translatedFormat('d F Y') }}</p>
        <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($campaign->tanggal_selesai)->translatedFormat('d F Y') }}</p>
        <p><strong>Tanggal Kegiatan:</strong> {{ \Carbon\Carbon::parse($campaign->tanggal_kegiatan)->translatedFormat('d F Y') }}</p>
        <p><strong>Target Donasi:</strong> Rp{{ number_format($campaign->target_donasi, 0, ',', '.') }}</p>
    </div>

    @if($campaign->gambar_campaign)
        <div class="mb-6">
            <img src="{{ asset('storage/' . $campaign->gambar_campaign) }}" 
                 alt="{{ $campaign->judul_campaign }}" 
                 class="w-full rounded-lg shadow">
        </div>
    @endif

    <h2 class="text-xl font-semibold text-gray-800 mb-2">Deskripsi</h2>
    <p class="text-gray-700 leading-relaxed">{{ $campaign->deskripsi }}</p>

    <a href="{{ url()->previous() }}" 
       class="inline-block mt-6 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
        ← Kembali
    </a>
</div>
