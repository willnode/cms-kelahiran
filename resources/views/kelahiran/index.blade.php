@extends('layouts.form')

@section('form')

<div class="d-flex align-items-center">
    <h2>Data Kelahiran</h2>
    <a class="btn btn-success ms-auto" href="{{ route('kelahiran.create') }}?desa={{ $desa }}">Tambah</a>
</div>

<div class="d-flex align-items-center">
    <form class="input-group my-3">
        <select name="desa" class="form-select" onchange="this.form.submit()">
            @foreach ($desas as $key => $value)
            <option value="{{ $value->id }}" @if ($value->id==$desa)
                selected="selected"
                @endif
                >{{ $value->nama }}</option>
            @endforeach
        </select>
        <input hidden name="page" value="{{ $_GET['page'] ?? 1 }}">
        <select name="bulan" class="form-select" onchange="this.form.submit()">
            @foreach ($bulans as $key => $value)
            <option value="{{ $key }}" @if ($key==$bulan)
                selected="selected"
                @endif
                >{{ $value }}</option>
            @endforeach
        </select>
        <input type="number" min="2000" name="tahun" value="{{ $tahun }}" class="form-control" onchange="this.form.submit()">
        <input type="text" name="cari" value="{{ $cari }}" placeholder="Cari..." class="form-control" style="flex-grow: 3"  onchange="this.form.submit()">
        <button class="btn btn-primary" type="submit">
            <i class="fas fa-sync"></i>
        </button>
    </form>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered align-middle">
    <tr>
        <th>No</th>
        <th>Nama Ibu / Ayah</th>
        <th>Nama Balita</th>
        <th>Tanggal Lahir</th>
        <th>Aksi</th>
    </tr>
    @foreach ($kelahirans as $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->nama_anak }}</td>
        <td>{{ $item->nama_ibu }} / {{ $item->nama_ayah }}</td>
        <td>{{ $item->tanggal_lahir }}</td>
        <td>
            <form action="{{ route('kelahiran.destroy',$item->id) }}" method="POST">

                <a class="btn btn-sm btn-primary" href="{{ route('kelahiran.edit',$item->id) }}">
                <i class="fas fa-edit"></i>
                    
                </a>

                @csrf
                @method('DELETE')

                <button type="submit" onclick="return confirm('Yakin mau dihapus?')" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $kelahirans->appends($_GET)->links() !!}

<style>
    .btn-danger:hover {
        filter: invert(1);
    }
</style>

@endsection