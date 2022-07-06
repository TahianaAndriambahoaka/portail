<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      {{-- <p style="font-weight: bold; font-size: large">Bienvenu!</p> --}}
      <p class="navbar-brand brand-logo">Profil GCR</p>
      <a class="navbar-brand brand-logo-mini"><img src="{{asset('images/ucp_logo.png')}}" alt="IMG"></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown">
          <a class="nav-link" href="{{asset('/utilisateur/deconnexion')}}">
            <button type="button" class="btn btn-inverse-primary btn-sm"><i class="mdi mdi-logout" style="font-weight: bold; font-size: large"></i>Se déconnecter</button>
            {{-- <span class="count"></span> --}}
          </a>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
      </button>
    </div>
  </nav>