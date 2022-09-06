@extends('layout.layoutAdmin')

@section('judul')
    MONITORING
@endsection

@section('activeAdmin')
    activeku
@endsection

@section('content')
    <div class="card-body">
        <h2 class="card-title text-center">Data Admin</h2>
        
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahAdmin">
            Tambah Admin
        </button>
        <!-- Modal -->
        <div class="modal fade" id="tambahAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('tambah.admin') }}" method="post">
                    @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="">Nama</label>
                            <input type="text" name="nama" id="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" id="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Admin</button>
                </div>
                </form>
            </div>
            </div>
        </div>


        <div class="table-responsive mt-3">
            <table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Admin</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Akses</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($admin as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ strtoupper($item->nama) }}</td>
                            <td>{{ $item->username }}</td>
                            <td>
                                @if (Hash::check('admin'.date('Y'), $item->password))
                                    Default
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if (empty($item->akses))
                                    belum memiliki akses
                                @else
                                    {{$item->akses}}
                                @endif
                            </td>
                            <td>
                                <button type="button" class="border-0 badge badge-primary" data-toggle="modal" data-target="#ubahadmin{{$item->username}}">
                                    Ubah
                                </button>

                                <button type="button" class="border-0 badge badge-warning text-white" data-toggle="modal" data-target="#akses{{$item->username}}">
                                    Akses
                                </button>

                                <form action="{{ route('hapus.admin', [$item->id]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="badge badge-danger border-0">Hapus</button>
                                </form>

                                <form action="{{ route('reset.admin', [$item->id]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method("post")
                                    <button type="submit" class="badge badge-secondary border-0">reset pass</button>
                                </form>
                            </td>

                        </tr>
                        
                        {{-- modal --}}
                        <div class="modal fade" id="ubahadmin{{$item->username}}" tabindex="-1" aria-labelledby="akses{{$item->usernam}}Label" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="akses{{$item->usernam}}Label">Data Admin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="{{ route('ubah.admin', $item->id) }}" method="post">
                                    @csrf
                                    @method("PUT")
                                <div class="modal-body">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="">Nama</label>
                                            <input type="text" name="nama" value="{{ $item->nama }}" id="" class="form-control">
                                        </div>
                
                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Ubah Admin</button>
                                </div>
                                </form>
                            </div>
                            </div>
                        </div>

                        <div class="modal fade" id="akses{{$item->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Data Admin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="{{ route('akses.admin', $item->id) }}" method="post">
                                    @csrf
                                    @method("post")
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <select name="akses" class="form-control" id="">
                                                <option value="">Pilih Perangkat</option>
                                                @foreach ($perangkat as $per)
                                                    <option value="{{$per->akses}}">{{$per->perangkat}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambah Akses</button>
                                </div>
                                </form>
                            </div>
                            </div>
                        </div>


                    @endforeach
                </tbody>

            </table>
        </div>


    </div>
@endsection


@section('myScript')
    
@endsection