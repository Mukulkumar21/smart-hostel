<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Hostel | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>
<body>

<div class="container h-100 d-flex justify-content-center align-items-center">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-body text-center p-5">

                <h2 class="fw-bold mb-3">Smart Hostel</h2>
                <p class="text-muted mb-4">Select your role to login</p>

                <div class="d-grid gap-3">
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg">
                        Admin Login
                    </a>

                    <a href="{{ route('warden.login') }}" class="btn btn-warning btn-lg">
                        Warden Login
                    </a>

                    <a href="{{ route('student.login') }}" class="btn btn-primary btn-lg">
                        Student Login
                    </a>
                </div>

                <hr class="my-4">

                <p class="text-muted mb-0">
                    Smart Hostel Management System
                </p>

            </div>
        </div>
    </div>
</div>

</body>
</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Hostel | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>
<body>

<div class="container h-100 d-flex justify-content-center align-items-center">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-body text-center p-5">

                <h2 class="fw-bold mb-3">Smart Hostel</h2>
                <p class="text-muted mb-4">Select your role to login</p>

                <div class="d-grid gap-3">
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg">
                        Admin Login
                    </a>

                    <a href="{{ route('warden.login') }}" class="btn btn-warning btn-lg">
                        Warden Login
                    </a>

                    <a href="{{ route('student.login') }}" class="btn btn-primary btn-lg">
                        Student Login
                    </a>
                </div>

                <hr class="my-4">

                <p class="text-muted mb-0">
                    Smart Hostel
                </p>

            </div>
        </div>
    </div>
</div>

</body>
</html>