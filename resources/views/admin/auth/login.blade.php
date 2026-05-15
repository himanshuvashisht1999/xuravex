<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Xuravex</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css'])
</head>
<body>
    <div class="admin-login-wrapper">
        <!-- Left Side: Branding & Visuals -->
        <div class="login-left">
            <div class="login-left-content">
                <img src="https://via.placeholder.com/200x60?text=XURAVEX+LOGO" alt="Xuravex Logo" style="width: 250px;">
                <h1>Welcome Back!</h1>
                <p>Sign in to your XURAVEX admin account to manage your store.</p>
            </div>
            
            <div class="login-vials">
                <img src="https://via.placeholder.com/150x250?text=BAC+Water" alt="Vial">
                <img src="https://via.placeholder.com/150x250?text=BAC+Water" alt="Vial">
                <img src="https://via.placeholder.com/150x250?text=BAC+Water" alt="Vial">
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="login-right">
            <div class="admin-login-card">
                <h2>Admin Login</h2>
                <p>Enter your credentials to access the dashboard</p>
                <div style="width: 100px; height: 3px; background: #C18B39; margin: 0 auto 40px;"></div>

                <form action="{{ route('admin.login.post') }}" method="POST" class="admin-login-form">
                    @csrf
                    
                    @if ($errors->any())
                        <div style="color: #dc3545; font-size: 13px; margin-bottom: 20px; text-align: center;">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Username or email address *</label>
                        <div class="input-group">
                            <i class="fa-solid fa-user"></i>
                            <input type="email" name="email" placeholder="Enter your username or email" required value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password *</label>
                        <div class="input-group">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" placeholder="Enter your password" required>
                        </div>
                    </div>

                    <div class="admin-login-footer">
                        <label style="display: flex; gap: 8px; cursor: pointer; align-items: center;">
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                        <a href="#" style="color: #C18B39; text-decoration: none; font-weight: 600;">Lost your password?</a>
                    </div>

                    <button type="submit" class="btn-admin-login">Log in</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
