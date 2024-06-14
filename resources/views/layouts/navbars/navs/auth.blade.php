<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">


    <div class="navbar-wrapper">
        <div class="pull-left image">
         <img src="{{ asset('img/upel.png') }}" width="90%" img align="rigth">
        </div> 
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
  
      <ul class="navbar-nav">
      
    
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i>
           {{ __('Cerrar') }}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
           
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Cerrar sesión') }}</a>
          </div>
        </li>
      </ul>
    </div>

    
  </div>
</nav>



