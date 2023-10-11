@extends('mahasiswas.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Form Data Mahasiswa</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('mahasiswas.create') }}"> Create New Mahasiswa</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Nim</th>
        <th>Kelas</th>
        <th>Prodi</th>
        <th>No Hp</th>
        <th>Email</th>
        <th>Username</th>
        <th>Password</th>
        <th>Image</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($mahasiswas as $mahasiswa)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $mahasiswa->name }}</td>
        <td>{{ $mahasiswa->nim }}</td>
        <td>{{ $mahasiswa->kelas }}</td>
        <td>{{ $mahasiswa->prodi }}</td>
        <td>{{ $mahasiswa->nohp }}</td>
        <td>{{ $mahasiswa->email }}</td>
        <td>{{ $mahasiswa->username }}</td>
        <td>{{ $mahasiswa->password }}</td>
        <td><img src="/image/{{ $mahasiswa->image }}" width="100px"></td>
        <td>
            <form action="{{ route('mahasiswas.destroy',$mahasiswa->id) }}" method="POST">

                <a class="btn btn-info" href="{{route('mahasiswas.show',$mahasiswa->id) }}">Show</a>

                <a class="btn btn-primary" href="{{route('mahasiswas.edit',$mahasiswa->id) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $mahasiswas->links() !!}

@endsection
