<aside>
    <h2>Categorias</h2>
    <ul>
        @foreach ($categories as $c)
            <li>
                <form action="{{ route('productcatalog') }}" method="get">
                    <input type="hidden" name="search" value="{{ $c->categoria }}">
                    <button class="links" type="submit">{{ $c->categoria }}</button>
                </form>
            </li>
        @endforeach
    </ul>
</aside>
