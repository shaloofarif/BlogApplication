<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admin</b>Panel</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                        <span id="emailError" style="color: red; font-size: 0.6em;"></span>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        <span id="passwordError" style="color: red; font-size: 0.6em;"></span>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/adminlte.min.js') }}"></script>
    <script>
    document.getElementById('email').addEventListener('input', function () {
    const emailError = document.getElementById('emailError');
    const email = this.value;

    if (!email.includes('@') || !email.includes('.')) {
        emailError.textContent = 'Please enter a valid email address.';
    } else {
        emailError.textContent = ''; // Clear the error message
    }
});

document.getElementById('password').addEventListener('input', function () {
    const passwordError = document.getElementById('passwordError');
    const password = this.value;

    if (password.length < 8) {
        passwordError.textContent = 'Password must be at least 8 characters long.';
    } else {
        passwordError.textContent = ''; // Clear the error message
    }
});
</script>
</body>
</html>
