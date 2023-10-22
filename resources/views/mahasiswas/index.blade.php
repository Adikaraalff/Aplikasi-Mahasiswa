@extends('layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Data Mahasiswa</h2>
        </div>
        <div class="pull-right">
            @can ('mahasiswa-create')
            <a class="btn btn-success" href="{{ route('mahasiswas.create') }}"> Create New Mahasiswa</a>
            @endcan
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nim</th>
            <th>Kelas</th>
            <th>Prodi</th>
            <th>No Hp</th>
            <th>Email</th>
            <th>Username</th>
            <th>Foto</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<script type="text/javascript">
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('mahasiswas.index') }}",
            columnDefs: [{
                "targets": 8,
                "data": 'image',
                "render": function(data, type, row, meta) {
                    console.log(data);
                    return '<img src="' + '<?php echo url('/'); ?>/image/' + data + '" alt="' +
                        data + '"height="150 " width="150 "/>';
                }
            }],
            columns: [
                // {
                //     data: 'id',
                //     name: 'id'
                // },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'nim',
                    name: 'nim'
                },
                {
                    data: 'id_kelas',
                    name: 'id_kelas'
                },
                {
                    data: 'id_prodi',
                    name: 'id_prodi'
                },
                {
                    data: 'nohp',
                    name: 'nohp'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>
@endsection