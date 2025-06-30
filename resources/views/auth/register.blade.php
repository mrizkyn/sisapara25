@extends('layouts.user.main')

@section('main-content')
    <div class="auth Patterns">

        <div class="auth-container" style="margin-bottom: 200px; margin-top: 100px;">
            <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
            <div class="auth-form">
                <p class="auth-title">Create Account</p>
                <form class="auth-input-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="text" name="name" class="auth-input" placeholder="Username" required>
                    <input type="email" name="email" class="auth-input" placeholder="Email" required>
                    <div class="password-container">
                        <input type="password" name="password" class="auth-input password-input" placeholder="Password"
                            required>
                        <i class="bx bx-show password-toggle" onclick="togglePassword(this)"></i>
                    </div>
                    <button type="submit" class="auth-submit-btn">Create Account</button>
                </form>
                <p class="auth-sign-up-label">
                    Already have an account? <a href="{{ route('login') }}"><span class="auth-sign-up-link">Log
                            in</span></a>
                </p>
            </div>
        </div>
    </div>
    <script>
        function togglePassword(icon) {
            const passwordInput = icon.previousElementSibling;
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.replace('bx-show', 'bx-hide');
            } else {
                passwordInput.type = "password";
                icon.classList.replace('bx-hide', 'bx-show');
            }
        }
    </script>
@endsection
