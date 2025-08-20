<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UMKM Jaya Berkah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .login-card {
            max-width: 400px;
            margin: 100px auto;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="text-center mb-4">Login</h4>
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
