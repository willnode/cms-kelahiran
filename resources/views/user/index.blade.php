@extends('layouts.form')

@section('form')
<div class="d-flex align-items-center">
    <h2>Daftar Akun</h2>
    <a class="btn btn-success ms-auto" href="{{ route('user.create') }}">Tambah</a>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered align-middle">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <form action="{{ route('user.destroy',$user->id) }}" method="POST">

                <a class="btn btn-sm btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $users->links() !!}

@endsection