<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $data = produk::all()->where('stok', '>', '0')->where('nama_produk', 'like', '%' . $search . '%');
        return $search;
    }
}
