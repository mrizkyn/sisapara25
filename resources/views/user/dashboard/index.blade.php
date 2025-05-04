<h1>INI DASHBOARD USER</h1>
<form action="{{ route('logout') }}" method="POST" class="m-0">
    @csrf
    <button class="dropdown-item" type="submit">Logout</button>
</form>
