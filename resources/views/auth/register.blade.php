<h2>Register</h2>
<form action="{{ route('register.post') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

    <select name="role">
        <option value="volunteer">Volunteer</option>
        <option value="panitia">Panitia</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit">Register</button>
</form>

<p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
