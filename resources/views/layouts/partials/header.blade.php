<header>
    <h1>Header</h1>
    <nav>
        <ul>
            <li><a href="{{route('home')}}" class="{{request()->routeIs('home') ? 'active' : ''}}">Home</a></li>
            <li><a href="{{route('products.index')}}" class="{{request()->routeIs('products.*') ? 'active' : ''}}">Products</a></li>
            <li><a href="{{route('sobreNosotros')}}" class="{{request()->routeIs('sobreNosotros') ? 'active' : ''}}">Sobre nosotros</a></li>
            <li><a href="{{route('contact.index')}}" class="{{request()->routeIs('contact.index') ? 'active' : ''}}">Contactanos</a></li>
        </ul>
    </nav>
</header>