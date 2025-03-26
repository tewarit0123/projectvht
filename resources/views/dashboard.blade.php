<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>แดชบอร์ด</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .bg-purple {
            background-color: #e6b3e6;
        }

        body {
            background-color: #f8f9fa;
        }

        .form-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .header {
            background-color: #e6b3e6;
            color: black;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
@include('layouts.navg')
    <div class="container mt-4">
        <div class="bg-purple p-3 rounded mb-3">
            <h2 class="text-black">ยินดีต้อนรับสู่แดชบอร์ด</h2>
        </div>
        {{ Auth::guard('chv')->user()->fullname }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>