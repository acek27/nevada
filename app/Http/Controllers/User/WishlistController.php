<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Model\wishlist;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wish = wishlist::all();
        return view('user.wishlist',compact('wish'));
    }

    public function wish ($id)
    {
        $user = Auth::user()->id;
        $cek = \DB::table('wishlist')->select('*')->where('id_produk', '=', $id)->where('id_user', '=', $user);
        if ($cek->exists()) {
            \Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Produk sudah ada di Wishlist."
            ]);
            return redirect('/user/dashboardUser');
        } else {
            $user = Auth::user()->id;
            $wish = new wishlist();
            $wish->wish = 1;
            $wish->id_produk = $id;
            $wish->id_user = $user;
            $wish->save();

            \Session::flash("flash_notification", [
                "level" => "succes",
                "message" => "Produk ditambahkan ke Wishlist."
            ]);

            return redirect('/user/dashboardUser');
        }
    }

    public function unwish ($id)
    {
        $wish = wishlist::findOrFail($id);
        $wish->delete();
        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Produk Berhasil Dihapus dari Wishlist"
        ]);

        return redirect('user/Wishlist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
