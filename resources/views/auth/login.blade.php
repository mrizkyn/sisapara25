@extends('layouts.user.main')

@section('main-content')
    <div class="auth Patterns">

        <div class="auth-container" style="margin-bottom: 200px; margin-top: 100px;">
            <div class="auth-form">
                <h1 class="auth-title">Log in</h1>
                <form class="auth-input-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <input type="email" name="email" class="auth-input" placeholder="Email" required>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="password-container">
                        <input type="password" name="password" class="auth-input password-input" placeholder="Password"
                            required>
                        <i class="bx bx-show password-toggle" onclick="togglePassword(this)"></i>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="auth-submit-btn">Log in</button>
                </form>

                <p class="auth-sign-up-label">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="auth-sign-up-link">Create an account</a>
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
