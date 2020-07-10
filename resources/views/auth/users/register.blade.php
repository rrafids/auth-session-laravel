@extends('templates.users.app')

@section('content')
    <div class="container" style="margin-top: 15%; width: 400px">
        <div class="card p-4">
            <h4 class="my-4" style="text-align: center">Daftar</h4>
            <form action="{{ route('registerUser') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input name="name" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control">
                </div>
                <div class="container" style="text-align: right; margin: 15px">
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
