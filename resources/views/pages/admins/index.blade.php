@extends('templates.admins.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
           {{ session('success') }}
        </div>
    @endif

   <div class="card">
       <div class="card-header">
           List Tim
       </div>
       <div class="card-body">
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Tim</th>
                <th scope="col">Universitas</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach($teams as $team)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $team->nama_tim }}</td>
                        <td>{{ $team->universitas }}</td>
                        @if($team->status == 0)
                            <td style="color: orange">Belum Aktif</td>
                            <td>
                                <form method="post" action="{{ route('activate') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $team->id }}">
                                    <button type="submit" class="btn btn-success btn-sm">Aktifkan</button>
                                </form>
                            </td>
                        @else
                            <td style="color: green">Sudah Aktif</td>
                            <td>
                                <form method="post" action="{{ route('deactivate') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $team->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">Nonaktifkan</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @php
                    $i++;
                @endphp
                @endforeach
            </tbody>
          </table>
       </div>
   </div>
@endsection
