@extends('templates.users.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container" style="margin-top: 15%; width: 400px">
        <div class="card p-4">
            <h4 class="my-4" style="text-align: center">Masuk</h4>
            <form action="{{ route('loginUser') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control">
                </div>
                <div class="container" style="text-align: right; margin: 15px">
                    <button type="submit" class="btn btn-primary">Masuk</button>
                </div>
            </form>
        </div>
    </div>
@endsection
