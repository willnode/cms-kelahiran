@extends('layouts.form')

@section('form')
<div class="d-flex align-items-center">
    <h2>Edit Data</h2>
    <a class="btn btn-outline-primary ms-auto" href="{{ route('kelahiran.index') }}"> Kembali</a>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ $kelahiran->id ? route('kelahiran.update',$kelahiran->id) : route('kelahiran.store') }}" method="POST">
    @csrf
    @if ($kelahiran->id)
    @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="form-group">
                <strong>Nama Anak</strong>
                <input type="text" name="nama_anak" value="{{ $kelahiran->nama_anak }}" class="form-control" required>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <strong>Nama Ibu</strong>
                <input type="text" name="nama_ibu" value="{{ $kelahiran->nama_ibu }}" class="form-control" required>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <strong>Nama Ayah</strong>
                <input type="text" name="nama_ayah" value="{{ $kelahiran->nama_ayah }}" class="form-control" required>
            </div>
        </div>

        <div class="col-md-5 mb-3">
            <div class="form-group">
                <strong>Tempat Lahir</strong>
                <input type="text" name="tempat_lahir" value="{{ $kelahiran->tempat_lahir }}" class="form-control" required>
            </div>
        </div>
        <div class="col-md-5 mb-3">
            <div class="form-group">
                <strong>Tanggal Lahir</strong>
                <input type="date" name="tanggal_lahir" value="{{ $kelahiran->tanggal_lahir }}" class="form-control" required>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="form-group">
                <strong>Anak Ke</strong>
                <input type="number" min="1" name="anak_ke" value="{{ $kelahiran->anak_ke }}" class="form-control" required>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="form-group">
                <strong>RT</strong>
                <input type="number" name="rt" value="{{ $kelahiran->rt }}" class="form-control" required>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="form-group">
                <strong>RW</strong>
                <input type="number" name="rw" value="{{ $kelahiran->rw }}" class="form-control" required>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="form-group">
                <strong>Desa</strong>
                <select name="desa_id" class="form-select">
                    @foreach ($desas as $key => $value)
                    <option value="{{ $value->id }}" @if ($value->id==$kelahiran->desa_id)
                        selected="selected"
                        @endif
                        >{{ $value->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="form-group">
                <strong>Umur Ibu</strong>
                <input type="number" name="umur_ibu" value="{{ $kelahiran->umur_ibu }}" class="form-control" required>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="form-group">
                <strong>Jumlah Anak Hidup</strong>
                <input type="number" min="0" name="jumlah_anak_hidup" value="{{ $kelahiran->anak_ke }}" class="form-control" required>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
@endsection