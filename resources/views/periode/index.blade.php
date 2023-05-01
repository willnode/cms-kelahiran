@extends('layouts.form')

@section('form')
<div class="d-flex align-items-center">
    <h2>Daftar Periode</h2>
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
        <th>Bulan</th>
        <th>Tahun</th>
        <th width="280px">Aksi</th>
    </tr>
    @foreach ($periodes as $periode)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $periode->bulan }}</td>
        <td>{{ $periode->tahun }}</td>
        <td>
            <form action="{{ route('periode.destroy',$periode->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $periodes->links() !!}


<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('periode.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Buat periode baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <strong>Bulan</strong>
                        <input type="number" name="bulan" class="form-control" min="1" max="12" required placeholder="1 s/d 12">
                    </div>
                    <div class="form-group">
                        <strong>Tahun</strong>
                        <input type="number" name="tahun" class="form-control" min="2000" required placeholder="202x...">
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