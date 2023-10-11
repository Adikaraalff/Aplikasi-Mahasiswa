@extends('layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Data Dosen</h2>
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
<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nip</th>
            <th>Prodi</th>
            <th>No Hp</th>
            <th>Email</th>
            <th>Alamat</th>
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
            ajax: "{{ route('dosens.index') }}",
            columnDefs: [{
                "targets": 7,
                "data": 'image',
                "render": function(data, type, row, meta) {
                    console.log(data);
                    return '<img src="' + '<?php echo url('/'); ?>/image/' + data + '" alt="' + data + '"height="150 " width="150 "/>';
                }
            }],
            columns: [
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
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'prodi',
                    name: 'prodi'
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
                    data: 'alamat',
                    name: 'alamat'
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
