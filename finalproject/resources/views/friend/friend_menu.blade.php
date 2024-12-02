<header>
    <link rel="stylesheet" href="../css/styles.css">
    <nav class="main-nav">
        <ul>
            <li><a href="{{ route('friend.list_trees') }}">List tree</a></li>
        </ul>

        <!-- Formulario de logout -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>
</header>
