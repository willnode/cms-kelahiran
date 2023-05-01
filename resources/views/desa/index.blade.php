@extends('layouts.form')

@section('form')
<div class="d-flex align-items-center">
    <h2>Daftar Desa</h2>
    <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#createModal">Tambah</button>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    Ada kesalahan dalam input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <div>{{ $message }}</div>
</div>
@endif

<table class="table table-bordered align-middle">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kecamatan</th>
        <th>Kabupaten</th>
        <th width="280px">Aksi</th>
    </tr>
    @foreach ($desas as $desa)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $desa->nama }}</td>
        <td>{{ $desa->kecamatan }}</td>
        <td>{{ $desa->kabupaten }}</td>
        <td>
            <form action="{{ route('desa.destroy',$desa->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $desas->links() !!}


<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('desa.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Input desa baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <strong>Nama Desa</strong>
                        <input type="text" name="nama" class="form-control" required placeholder="">
                    </div>
                    <div class="form-group">
                        <strong>Kecamatan</strong>
                        <input type="text" name="kecamatan" class="form-control" required value="{{ env('APP_KECAMATAN', '') }}">
                    </div>
                    <div class="form-group">
                        <strong>Kabupaten</strong>
                        <input type="text" name="kabupaten" class="form-control" required value="{{ env('APP_KABUPATEN', '') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection