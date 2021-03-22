<header>
    <h1>Header</h1>
    <nav>
        <ul>
            <li><a href="{{route('home')}}" class="{{request()->routeIs('home') ? 'active' : ''}}">Home</a></li>
            <li><a href="{{route('products.index')}}" class="{{request()->routeIs('products.*') ? 'active' : ''}}">Products</a></li>
            <li><a href="{{route('register.index')}}" class="{{request()->routeIs('register.*') ? 'active' : ''}}">Registrar</a></li>
            <li><a href="{{route('login.index')}}" class="{{request()->routeIs('login.*') ? 'active' : ''}}">Login</a></li>
            <li><a href="{{route('logout')}}" class="{{request()->routeIs('logout') ? 'active' : ''}}">Logout</a></li>
            <li><a href="{{route('information')}}" class="{{request()->routeIs('information') ? 'active' : ''}}">Information</a></li>
            <li><a href="{{route('sobreNosotros')}}" class="{{request()->routeIs('sobreNosotros') ? 'active' : ''}}">Sobre nosotros</a></li>
            <li><a href="{{route('contact.index')}}" class="{{request()->routeIs('contact.index') ? 'active' : ''}}">Contactanos</a></li>
        </ul>
    </nav>
</header>