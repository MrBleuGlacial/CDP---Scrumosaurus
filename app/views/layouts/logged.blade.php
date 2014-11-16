<ul class="nav navbar-nav navbar-right">
    <li><a href="/logout" onclick="return confirm('Voulez vous vraiment vous déconnecter?');">Se déconnecter</a></li>
</ul>
<div class="nav navbar-nav navbar-right">
    <p class="navbar-text">Bienvenue <a href="#">{{{Auth::user()->login}}}</a>.</p>
</div>