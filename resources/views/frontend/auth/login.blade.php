@extends('layouts.frontend.app')

@section('title', 'Login - Xuravex')

@section('content')
    <div class="login-bg"style="background-image:url({{asset('images/login-page-bg.png')}})">
        

        <div class="login-container">
            <h2>Welcome Back</h2>
            <p>Login to your account to continue</p>
            <div style="width: 100px; height: 2px; background: linear-gradient(90deg, #A36911 0%, #E59F36 100%); margin: 0 auto 30px;    margin-top: 15px;"></div>

            <form action="{{ route('login.post') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <label>Username or email address <span style="color: red;">*</span></label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-user"></i>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your username or email" required>
                    </div>
                    @error('email') <span style="color: #ff4d4d; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Password <span style="color: red;">*</span></label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Enter your password" required>
                        <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePass()"></i>
                    </div>
                    @error('password') <span style="color: #ff4d4d; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                </div>

                <div class="form-footer-links">
                    <label style="display: flex; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" style="color: var(--secondary-color);">Lost your password?</a>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px;">Log in</button>
            </form>

            {{-- 
            <div class="social-login">
                <p style="position: relative; font-size: 13px;">
                    <span style="background: rgba(20,20,20,1); padding: 0 15px; position: relative; z-index: 2;">or continue with</span>
                    <span style="position: absolute; left: 0; top: 50%; width: 100%; height: 1px; background: rgba(255,255,255,0.1); z-index: 1;"></span>
                </p>
                
                <div class="social-btn google">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" width="20" alt="Google">
                    Continue with Google
                </div>
                <div class="social-btn microsoft">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" width="20" alt="Microsoft">
                    Continue with Microsoft
                </div>
            </div>
            --}}

            <div class="login-signup-link">
                Don't have an account? <a href="{{ route('register') }}">Sign up</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function togglePass() {
        const passInput = document.getElementById('password');
        const icon = document.querySelector('.toggle-password');
        if (passInput.type === 'password') {
            passInput.type = 'text';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        } else {
            passInput.type = 'password';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        }
    }
</script>
@endpush
