@extends('mahasiswas.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Form Data Mahasiswa</h2>
        </div>

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
    <?php
        $i=1;
    ?>
    @foreach ($mahasiswas as $mahasiswa)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $mahasiswa->name }}</td>
        <td>{{ $mahasiswa->nim }}</td>
        <td>{{ $mahasiswa->id_kelas }}</td>
        <td>{{ $mahasiswa->prodi }}</td>
        <td>{{ $mahasiswa->nohp }}</td>
        <td>{{ $mahasiswa->email }}</td>
        <td>{{ $mahasiswa->username }}</td>
        <td>{{ $mahasiswa->password }}</td>
        <td><img src="/image/{{ $mahasiswa->image }}" width="100px"></td>
        <td>
        </td>
    </tr>
    @endforeach
</table>

@endsection