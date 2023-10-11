@extends('dosens.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Form Data Dosen</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('dosens.create') }}"> Create New Dosen</a>
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
        <th>Nip</th>
        <th>Prodi</th>
        <th>No Hp</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Image</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($dosens as $dosen)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $dosen->name }}</td>
        <td>{{ $dosen->nip }}</td>
        <td>{{ $dosen->prodi }}</td>
        <td>{{ $dosen->nohp }}</td>
        <td>{{ $dosen->email }}</td>
        <td>{{ $dosen->alamat }}</td>
        <td><img src="/image/{{ $dosen->image }}" width="100px"></td>
        <td>
            <form action="{{ route('dosens.destroy',$dosen->id) }}" method="POST" enctype="multipart/form-data">

                <a class="btn btn-info" href="{{route('dosens.show',$dosen->id) }}">Show</a>

                <a class="btn btn-primary" href="{{route('dosens.edit',$dosen->id) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $dosens->links() !!}

@endsection
