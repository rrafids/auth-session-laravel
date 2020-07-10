@extends('templates.users.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
           {{ session('success') }}
        </div>
    @endif

    <h2>Ayo Ikuti <b>Lomba Makan</b> Nasional, <b>se-Indonesia !</b></h2>
    <img src="icon.png" alt="" style="width: 650px; height: 350px">

    @if(!empty($user))
        @if($user->status == 1)
            <button class="btn btn-lg btn-primary my-5 ml-auto justify-content-center " data-toggle="modal" data-target="#tim" style="width: 650px">Lihat Tim</button>
        @else
            <button class="btn btn-lg btn-primary my-5 ml-auto justify-content-center " data-toggle="modal" data-target="#daftar" style="width: 650px">Daftar Sekarang</button>
        @endif
    @else
        <a type="button" href="{{ route('loginPageUser') }}" class="btn btn-lg btn-primary my-5 ml-auto justify-content-center " style="width: 650px; color: white">Masuk untuk Mendaftar</a>
    @endif

    <div class="modal fade" id="daftar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pendaftaran Lomba</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{ route('daftarTim') }}">
                @csrf
                <div class="form-group">
                  <label for="nama_tim" class="col-form-label">Nama Tim</label>
                  <input type="text" name="nama_tim" class="form-control" id="nama_tim">
                </div>
                <div class="form-group">
                  <label for="universitas" class="col-form-label">Universitas</label>
                  <input type="text" name="universitas" class="form-control" id="universitas">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
@if(!empty($team))
      <div class="modal fade" id="tim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detail Tim</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{ route('daftarTim') }}">
                @csrf
                <div class="form-group">
                  <label for="nama_tim" class="col-form-label">Nama Tim: <b>{{ $team->nama_tim }}</b></label>
                </div>
                <div class="form-group">
                  <label for="universitas" class="col-form-label">Universitas: <b>{{ $team->universitas }}</b></label>
                </div>
                <div class="form-group">
                    @if($team->status == 0)
                        <label for="universitas" class="col-form-label" >Status: <b style="color: orange">Belum Dikonfirmasi</b></label>
                    @else
                        <label for="universitas" class="col-form-label" >Status: <b style="color: green">Akun Telah Aktif</b></label>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </form>
          </div>
        </div>
      </div>
@endif
      <script>
          $('#daftar').on('show.bs.modal');
      </script>
@endsection
