@extends('layout.v_template')
@section('title', 'Halaman Siswa')

@section('content')
<h1>DAFTAR SISWA</h1><br>


<div class="col-md-6"> <br>
    <form action="guru/search" method="GET">
        <input type="text" name="search" placeholder="Search Nama Siswa . . ." value="{{ old('search') }}">
        <input type="submit" value="SEARCH">
    </form>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; ?>
        @foreach ($siswa as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->nis }}</td>
            <td>{{ $data->nama_siswa }}</td>
            <td>{{ $data->jenis_kelamin_siswa }}</td>
            <td>{{ $data->agama_siswa }}</td>
            <td>{{ $data->kelas }}</td>
            <td>{{ $data->jurusan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection