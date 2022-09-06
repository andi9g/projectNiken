<?php

namespace App\Http\Controllers;

use App\Models\adminM;
use Illuminate\Http\Request;
use Hash;

class adminC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        try{
            $nama = $request->nama;
            $username = $request->username;
            $password = Hash::make($request->password);

            $tambah = new adminM;
            $tambah->nama = $nama;
            $tambah->username = $username;
            $tambah->password = $password;
            $tambah->save();

            if($tambah) {
                return redirect('admin')->with('toast_success', 'Admin berhasil ditambahkan');
            }

        }catch(\Throwable $th){
            return redirect('admin')->with('toast_error', 'Terjadi kesalahan');
        }
    }


    public function akses(Request $request, $id)
    {
        $request->validate([
            'akses' => 'required',
        ]);
        
        
        try{
            $akses = $request->akses;
        
            $update = adminM::where('id', $id)->update([
                'akses' => $akses,
            ]);
            if($update) {
                return redirect('admin')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('admin')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function show(adminM $adminM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function edit(adminM $adminM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, adminM $adminM, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        try{
            $nama = $request->nama;

            $ubah = adminM::where('id', $id)->update([
                'nama' => $nama,
            ]);

            if($ubah) {
                return redirect('admin')->with('toast_success', 'Admin berhasil diubah');
            }

        }catch(\Throwable $th){
            return redirect('admin')->with('toast_error', 'Terjadi kesalahan');
        }   
    }

    public function reset(Request $request, $id)
    {
        try{
            $password = Hash::make('admin'.date('Y'));
        
            $update = adminM::where('id', $id)->update([
                'password' => $password,
            ]);
            if($update) {
                return redirect('admin')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('admin')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function destroy(adminM $adminM, $id)
    {
       try{
           $destroy = adminM::where('id', $id)->delete();
           if($destroy) {
               return redirect('admin')->with('toast_success', 'success');
           }
       }catch(\Throwable $th){
           return redirect('admin')->with('toast_error', 'Terjadi kesalahan');
       }
    }
}
