<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Smart Hostel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            height: 100vh;
        }
        .login-card {
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center h-100">
    <div class="col-md-4">
        <div class="card shadow login-card">
            <div class="card-body p-4">

                <h3 class="text-center mb-4 fw-bold">Admin Login</h3>

                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        Invalid email or password
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="admin@gmail.com"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="••••••••"
                               required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </div>
                </form>

                <hr>

                <p class="text-center text-muted mb-0">
                    Smart Hostel Management System
                </p>

            </div>
        </div>
    </div>
</div>

</body>
</html>