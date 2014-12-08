<ul class="nav navbar-nav navbar-right">
    <li><a href="{{ URL::to('logout') }}" onclick="return confirm('Voulez vous vraiment vous déconnecter?');">Se déconnecter</a></li>
</ul>
<div class="nav navbar-nav navbar-right">
    <p class="navbar-text">Bienvenue <a href="{{URL::to('users/'.Auth::user()->id)}}">{{{Auth::user()->login}}}</a>.</p>
</div>