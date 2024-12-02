<header>
    <link rel="stylesheet" href="../css/styles.css">
    <nav class="main-nav">
        <ul>
            <li><a href="{{ route('admin.species') }}">Species</a></li>
            <li><a href="{{ route('admin.friends') }}">Friends</a></li>
            <li><a href="{{ route('admin.trees') }}">Tree</a></li>
        </ul>

        <!-- Formulario de logout -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>
</header>
