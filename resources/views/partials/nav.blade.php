<nav style="margin-bottom:20px;">
    <ul style="list-style:none; display:flex; gap:15px;">
        {{-- Categories --}}
        <li>
            <a href="{{ route('categories.index') }}">Categories</a>
        </li>
        <li>
            <a href="{{ route('categories.create') }}">Crear categoria</a>
        </li>

        {{-- Llistes --}}
        <li>
            <a href="{{ route('llistas.index') }}">Llistes</a>
        </li>
        <li>
            <a href="{{ route('llistas.create') }}">Crear llista</a>
        </li>
        <li><a href="{{ route('llistas.compartidas') }}">Compartit amb mi</a></li>
    </ul>
</nav>
