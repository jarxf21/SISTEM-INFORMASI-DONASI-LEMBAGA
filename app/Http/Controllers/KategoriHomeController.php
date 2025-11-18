<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatan;
class KategoriHomeController extends Controller
{
    public function index()
    {
        $kategoriKegiatan = KategoriKegiatan::select(
            'nama_kategori',
            'deskripsi_kategori',
            'gambar_kategori',
            'slug'
        )->get();

        $programs = $kategoriKegiatan->map(function ($item) {
            return [
                'title'       => $item->nama_kategori,
                'description' => $item->deskripsi_kategori ?? '',
                'image'       => $item->gambar_kategori
                    ? asset('storage/' . $item->gambar_kategori)
                    : asset('images/default-kategori.jpg'),
                'thumbnail'   => $item->gambar_kategori
                    ? asset('storage/' . $item->gambar_kategori)
                    : asset('images/default-kategori.jpg'),
            ];
        })->values()->toArray();

        return view('homepage', compact('programs'));
    }
}
