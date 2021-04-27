@extends('layout.v_template')
@section('title', 'Detail Guru')
@section('content')

<table class="table">
    <tr>
        <th width="120px">NIP</th>
        <th width="60px">:</th>
        <th>{{ $guru->nip_guru }}</th>
    </tr>
    <tr>
        <th width="120px">Nama Guru</th>
        <th width="60px">:</th>
        <th>{{ $guru->nama_guru }}</th>
    </tr>
    <tr>
        <th width="120px">Mata Pelajaran</th>
        <th width="60px">:</th>
        <th>{{ $guru->mapel }}</th>
    </tr>
    <tr>
        <th width="120px">Foto</th>
        <th width="60px">:</th>
        <th><img src="{{ url('foto_guru/'.$guru->foto_guru) }}" width="400px"></th>
    </tr>
    <tr>
        <th><a href="/guru" class="btn btn-success tbn-sm">Kembali</a></th>
    </tr>
</table>





@endsection