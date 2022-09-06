<?php

namespace App\Http\Controllers;

use App\Models\adminM;
use App\Models\perangkatM;
use Illuminate\Http\Request;
use Hash;

class welcomeC extends Controller
{

    public function login()
    {
        return view('pages.pagesLogin');
    }


    

    public function scan(Request $request, $value)
    {
        $ex = explode("___", $value);
        $exPH = explode("---", $ex[0]);
        $suhu = $exPH[0];
        $ph = $exPH[1];
        $key_post = $ex[1];
        $akses = $ex[2];

        try{
                $ambil = perangkatM::where('key_post', $key_post)->where('akses', $akses);

                if($ambil->count() == 1) {
                    $akses = $ambil->first()->akses;

                    $PH_= "<?php
                        session_start();
                        if($"."_SESSION['login'] === true){
                                $"."UIDresult= '$ph';
                                echo $"."UIDresult; 
                            }
                        ?>
                    ";

                    $SUHU_= "<?php
                        session_start();
                        if($"."_SESSION['login'] === true){
                                $"."UIDresult= '$suhu';
                                echo $"."UIDresult; 
                            }
                        ?>
                    ";
                    $urlPH = public_path().'/scanData/'.$akses.'PH.php';
                    $urlSUHU = public_path().'/scanData/'.$akses.'SUHU.php';
                    file_put_contents($urlPH,$PH_);
                    file_put_contents($urlSUHU,$SUHU_);
                }
        }catch(\Throwable $th){
            
        }
    }

    public function logout(Request $request)
    {
        session_start();
        $request->session()->flush();
        session_destroy();
        return redirect('/');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perangkat = perangkatM::select('akses', 'perangkat', 'id')->get();


        return view("pages.pagesWelcome", [
            'perangkat' => $perangkat,
        ]);
    }

    public function admin()
    {
        $admin = adminM::get();
        $perangkat = perangkatM::select('perangkat','akses')->get();
        return view('pages.pagesAdmin', [
            'admin' => $admin,
            'perangkat' => $perangkat,
        ]);
    }

    public function perangkat()
    {
        
        $perangkat = perangkatM::get();
        return view('pages.pagesPerangkat', [
            'perangkat' => $perangkat,
        ]);
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
