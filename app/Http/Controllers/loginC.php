<?php

namespace App\Http\Controllers;

use App\Models\adminM;
use Illuminate\Http\Request;
use Hash;

class loginC extends Controller
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

    public function proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try{
            $username = $request->username;            
            $password = $request->password;
            
            $cek = adminM::where('username', $username);
            
            if($cek->count() === 1) {
                if (Hash::check($password, $cek->first()->password)) {
                    $data = $cek->first();
                    $request->session()->put('login', true);
                    $request->session()->put('posisi', "admin");
                    $request->session()->put('nama', $data->nama);

                    session_start();
                    $_SESSION['login'] = true;

                    return redirect('welcome')->with('success', 'Welcome');

                }else {
                    return redirect('/')->with('toast_error', 'username atau password salah');
                }
            }else {
                return redirect('/')->with('toast_error', 'username atau password salah');
            }

        }catch(\Throwable $th){
            return redirect('/')->with('toast_error', 'username atau password salah');
        }
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
    public function update(Request $request, adminM $adminM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function destroy(adminM $adminM)
    {
        //
    }
}
