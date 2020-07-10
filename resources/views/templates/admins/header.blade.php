<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        @if(session('emailAdmin'))
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto"></ul>
            <div class="navbar-text">
                <p>Admin</p>
              <a href="{{ route('logoutAdmin') }}"><button class="btn btn-outline-danger">Keluar</button></a>
            </div>
        </div>

        @else
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto"></ul>
            <div class="navbar-text">
              <a href="{{ route('loginPageAdmin') }}"><button class="btn btn-primary">Masuk</button></a>
              <a href="{{ route('registerPageAdmin') }}"><button class="btn btn-outline-primary">Daftar</button></a>
            </div>
          </div>
        @endif


      </nav>
</div>
