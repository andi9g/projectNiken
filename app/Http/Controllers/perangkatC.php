<?php

namespace App\Http\Controllers;

use App\Models\perangkatM;
use Illuminate\Http\Request;
use Hash;

class perangkatC extends Controller
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
            'perangkat' => 'required',
        ]);
        
        
        try{
            $perangkat = $request->perangkat;
            $akses = uniqid();
            $key_post = Hash::make($akses);
            $key_post = str_replace("/", "", $key_post);
            $key_post = str_replace(".", "", $key_post);
            $key_post = str_replace("(", "", $key_post);
            $key_post = str_replace(")", "", $key_post);
            $key_post = str_replace(",", "", $key_post);
            $key_post = str_replace("/", "", $key_post);
            $key_post = str_replace(";", "", $key_post);
            $key_post = str_replace("$", "", $key_post);

            $store = new perangkatM;
            $store->perangkat = $perangkat;
            $store->akses = $akses;
            $store->key_post = $key_post;
            $store->save();

            if($store) {
                $location = public_path().'/scanData/'.$akses;

                if(file_exists($location."PH.php")){
                    unlink($location."PH.php");
                }

                if(file_exists($location."SUHU.php")){
                    unlink($location."SUHU.php");
                }

                //file PH
                $myfilePH = fopen($location."PH.php", "w+") or die("Unable to open file!");
                $PH_= "<?php
                        session_start();
                        if($"."_SESSION['login'] === true){
                                $"."UIDresult= NULL;
                                echo $"."UIDresult; 
                            }
                        ?>
                    ";
                fwrite($myfilePH, $PH_);
                fclose($myfilePH);
                chmod($location."PH.php", 0777);

                //fileSUHU
                $myfileSUHU = fopen($location."SUHU.php", "w+") or die("Unable to open file!");
                $SUHU_= "<?php
                        session_start();
                        if($"."_SESSION['login'] === true){
                                $"."UIDresult= NULL;
                                echo $"."UIDresult; 
                            }
                        ?>
                    ";
                fwrite($myfileSUHU, $SUHU_);
                fclose($myfileSUHU);
                chmod($location."SUHU.php", 0777);

                return redirect('perangkat')->with('toast_success', 'Perangkat berhasil ditambahkan');
            }
        }catch(\Throwable $th){
            return redirect('perangkat')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\perangkatM  $perangkatM
     * @return \Illuminate\Http\Response
     */
    public function show(perangkatM $perangkatM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\perangkatM  $perangkatM
     * @return \Illuminate\Http\Response
     */
    public function edit(perangkatM $perangkatM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\perangkatM  $perangkatM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, perangkatM $perangkatM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\perangkatM  $perangkatM
     * @return \Illuminate\Http\Response
     */
    public function destroy(perangkatM $perangkatM, $id)
    {
        try{
            $ambil = perangkatM::where('id', $id)->first();

            $location = public_path().'/scanData/'.$ambil->akses;

            if(file_exists($location."PH.php")){
                unlink($location."PH.php");
            }
            if(file_exists($location."SUHU.php")){
                unlink($location."SUHU.php");
            }

            $destroy = perangkatM::where('id', $id)->delete();
            if($destroy) {
                return redirect('perangkat')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('perangkat')->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
