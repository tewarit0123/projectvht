<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        
        <style>
            body {
                background-color: #f8f0fc;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .login-container {
                background-color: #ffffff;
                border-radius: 15px;
                padding: 2rem;
                box-shadow: 0 8px 16px rgba(145, 103, 189, 0.15);
                width: 100%;
                max-width: 500px;
            }
            .login-title {
                color: #6741d9;
                font-size: 2.5rem;
                text-align: center;
                margin-bottom: 2rem;
            }
            .form-control {
                border-radius: 25px;
                padding: 0.75rem 1.25rem;
                border: 1px solid #e5dbff;
            }
            .form-control:focus {
                border-color: #845ef7;
                box-shadow: 0 0 0 0.2rem rgba(132, 94, 247, 0.25);
            }
            .btn-login {
                background-color: #7950f2;
                color: white;
                border-radius: 25px;
                padding: 0.75rem 2.5rem;
                font-weight: bold;
                border: none;
                transition: all 0.3s ease;
            }
            .btn-login:hover {
                background-color: #6741d9;
                transform: translateY(-2px);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    {{ $slot }}
                </div>
                <div class="col-md-6 d-none d-md-flex justify-content-center align-items-center">
                    <img src="/img/chvbg.png" alt="Login illustration" class="img-fluid">
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
