@extends('layout.layoutAdmin')


@section('judul')
    MONITORING
@endsection

@section('activeWelcome')
    activeku
@endsection

@section('content')
    <div class="card-body">
        @foreach ($perangkat as $p1)
        <div class="row mb-4">
            <div class="col-md-12 ">
                <div class="card border-bottom-0 rounded-0">
                    <h3 class="card-header rounded-0 text-center" style="background: rgb(207, 212, 221)">{{strtoupper($p1->perangkat)}}</h3>
                </div>
            </div>
            <div class="col-md-6 text-center mb-2">
                <div class="card rounded-0 border-top-0">
                    <div class="card-header rounded-0">PH AIR</div>
                    <div class="card-body">
                        <div class="px-md-5 py-2">
                        <div class="px-md-5 text-left">
                            <textarea name="" id="getUIDPH{{$p1->id}}" class="form-control disabled mb-1" cols="100" rows="1" style="resize: none" readonly></textarea>

                            <h4 class="text-dark mb-0" id="ketPH{{$p1->id}}">.....</h4>
                        </div>
                        </div>
                            
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center mb-2">
                <div class="card rounded-0 border-top-0">
                    <div class="card-header">SUHU AIR</div>
                    <div class="card-body">
                        <div class="px-md-5 py-2">
                        <div class="px-md-5 text-left">
                            <textarea name="" id="getUIDSUHU{{$p1->id}}" class="form-control mb-1" style="resize: none" cols="100" rows="1" readonly></textarea>

                            <h4 class="text-dark mb-0" id="ketSUHU{{$p1->id}}">.....</h4>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection


@section('myScript')
@foreach ($perangkat as $p2)
    

<script>

    $(document).ready(function(){
        let i = 2000;
        $("#getUIDPH{{$p2->id}}").load("{{ url('/scanData/'.$p2->akses.'PH.php') }}");
        $("#getUIDSUHU{{$p2->id}}").load("{{ url('/scanData/'.$p2->akses.'SUHU.php') }}");
        setInterval(function() {
            $("#getUIDPH{{$p2->id}}").load("{{ url('/scanData/'.$p2->akses.'PH.php') }}");
            $("#getUIDSUHU{{$p2->id}}").load("{{ url('/scanData/'.$p2->akses.'SUHU.php') }}");

            var isiPH = parseFloat(document.getElementById("getUIDPH{{$p2->id}}").value);
            var isiSUHU = parseFloat(document.getElementById("getUIDSUHU{{$p2->id}}").value);
            
            


            if(isiPH || isiPH.length > 0 && isiPH != NULL){
                if(isiPH > 6.65) {
                    document.getElementById("ketPH{{$p2->id}}").removeAttribute("class");
                    document.getElementById("ketPH{{$p2->id}}").className="text-success mb-0";
                    document.getElementById("ketPH{{$p2->id}}").innerHTML = "Baik";
                }else if(isiPH > 6.45) {
                    document.getElementById("ketPH{{$p2->id}}").removeAttribute("class");
                    document.getElementById("ketPH{{$p2->id}}").className="text-warning mb-0";
                    document.getElementById("ketPH{{$p2->id}}").innerHTML = "Kurang Baik";

                }else if(isiPH < 6.45) {
                    document.getElementById("ketPH{{$p2->id}}").removeAttribute("class");
                    document.getElementById("ketPH{{$p2->id}}").className="text-danger mb-0";
                    document.getElementById("ketPH{{$p2->id}}").innerHTML = "Tidak baik";
                }



                if(isiSUHU > 20.0 && isiSUHU < 29.0) {
                    document.getElementById("ketSUHU{{$p2->id}}").removeAttribute("class");
                    document.getElementById("ketSUHU{{$p2->id}}").className="text-success mb-0";

                    document.getElementById("ketSUHU{{$p2->id}}").innerHTML = "Baik";
                }else if(isiSUHU > 18.0 && isiSUHU < 20.0) {
                    document.getElementById("ketSUHU{{$p2->id}}").removeAttribute("class");
                    document.getElementById("ketSUHU{{$p2->id}}").className="text-warning mb-0";

                    document.getElementById("ketSUHU{{$p2->id}}").innerHTML = "Kurang Baik";

                }else if(isiSUHU < 18.0 || isiSUHU >= 29 ) {
                    document.getElementById("ketSUHU{{$p2->id}}").removeAttribute("class");
                    document.getElementById("ketSUHU{{$p2->id}}").className="text-danger mb-0";
                    document.getElementById("ketSUHU{{$p2->id}}").innerHTML = "Tidak baik";
                }


            }
            if(isNaN(isiPH) && isNaN(isiSUHU) == NaN) {
                document.getElementById("ketPH{{$p2->id}}").removeAttribute("class");
                document.getElementById("ketPH{{$p2->id}}").className="text-dark mb-0";

                document.getElementById('ketPH{{$p2->id}}').innerHTML = "Belum Terdaftar";
                document.getElementById('ketSUHU{{$p2->id}}').innerHTML = "Belum Terdaftar";
            }
            
        }, i);
    });



</script>
@endforeach
@endsection