<aside>
    <h2>Categorias</h2>
    <ul>
        @foreach ($categories as $c)
            <li><a href="{{ route('productcatalog.category', $c->id) }}">{{ $c->categoria }}</a></li>
        @endforeach
    </ul>
</aside>
