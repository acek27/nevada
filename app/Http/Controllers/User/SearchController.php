<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\produk;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('cari');
        $data = produk::select('*')
            ->join('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')
            ->where('nama_produk', 'LIKE', '%' . $search . '%')->orwhere('kategori.nama_kategori', 'LIKE', '%' . $search . '%')->paginate(10);
        return view('user.search', compact('search', 'data'));
    }
}
