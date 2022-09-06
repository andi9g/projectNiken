@extends('layout.layoutAdmin')

@section('judul')
    MONITORING
@endsection

@section('activePerangkat')
    activeku
@endsection

@section('content')
    <div class="card-body">
        <h2 class="card-title text-center">Data perangkat</h2>
        
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahperangkat">
            Tambah perangkat
        </button>
        <!-- Modal -->
        <div class="modal fade" id="tambahperangkat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data perangkat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('tambah.perangkat') }}" method="post">
                    @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="">Nama Perangkat</label>
                            <input type="text" name="perangkat" id="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah perangkat</button>
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
                        <th>Nama perangkat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($perangkat as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->perangkat }}</td>
                            <td>
                                <button type="button" class="badge border-0 badge-info" data-toggle="modal" data-target="#detail{{$item->id}}">
                                    Detail
                                </button>

                                <form action="{{ route('hapus.perangkat', [$item->id]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="badge badge-danger border-0">Hapus</button>
                                </form>
                            </td>

                        </tr>


                        <div class="modal fade" id="detail{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Data perangkat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="{{ route('tambah.perangkat') }}" method="post">
                                    @csrf
                                <div class="modal-body">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="">Key_Post</label>
                                                <textarea name="" class="form-control" readonly id="" rows="4">{{ $item->key_post }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Kode Akses</label>
                                                <textarea name="" class="form-control" readonly id="" rows="4">{{ $item->akses }}</textarea>
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambah perangkat</button>
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