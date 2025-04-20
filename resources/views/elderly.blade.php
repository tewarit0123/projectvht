<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผู้สูงอายุ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<style>
    .bg-purple {
        background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
        color: white;
    }

    body {
        background-color: #f0f2f5;
        font-family: 'Kanit', sans-serif;
    }

    .container {
        background-color: white;
        border-radius: 15px;
        padding: 30px;
        margin-top: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .header {
        background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
        color: white;
        padding: 15px 25px;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(142, 68, 173, 0.2);
    }

    .form-select, .form-control {
        max-width: 300px;
    }

    .table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        margin-top: 20px;
    }

    .table thead th {
        background: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        color: #2c3e50;
        font-weight: 600;
    }

    .user-info {
        background: white;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .user-info:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .user-info h5 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .user-info p {
        margin-bottom: 5px;
        color: #34495e;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(142, 68, 173, 0.2);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg,rgb(203, 226, 75) 0%, #8e44ad 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(142, 68, 173, 0.3);
    }

    .btn-sm {
        padding: 5px 10px;
    }
</style>

<body>
@include('layouts.navgd')
    <div class="container">
        <div class="header">
            <h2><i class="fas fa-user-friends"></i> รายชื่อผู้สูงอายุที่ อสม. ดูแล</h2>
        </div>

        <!-- ข้อมูล อสม. -->
        <div class="user-info">
            <h5><i class="fas fa-user-md"></i> ข้อมูล อสม.</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong><i class="fas fa-user"></i> ชื่อ-นามสกุล:</strong> {{ Auth::guard('chv')->user()->fullname }} </p>
                    <p><strong><i class="fas fa-id-card"></i> รหัสประจำตัวประชาชน อสม.:</strong> {{ Auth::guard('chv')->user()->id_card }} </p>
                </div>
                <div class="col-md-6">
                    <p><strong><i class="fas fa-home"></i> หมู่บ้านที่ทำงานอยู่:</strong> {{ Auth::guard('chv')->user()->village_name }}</p>
                </div>
            </div>
        </div>

        <h4 class="mt-4"><i class="fas fa-list"></i> รายชื่อผู้สูงอายุในความดูแล</h4>
        <table class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th>ลำดับ</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>อายุ</th>
                    <th>ที่อยู่</th>
                    <th>จัดการแบบวิเคราะห์</th>
                    <th>แบบสำรวจ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elders as $elder)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-start">{{ isset($elder->titlename) ? $elder->titlename . ' ' : '' }}{{ $elder->fullname }}</td>
                    <td>{{ \Carbon\Carbon::parse($elder->birth_date)->age }} ปี</td>
                    <td class="text-center">{{ $elder->address }}</td>
                    <td>
                        <a href="{{ route('formanalysis', ['e_id' => $elder->e_id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> ดูข้อมูล</a>
                    </td>
                    <td>
                        <a href="{{ route('volunteerss') }}" class="btn btn-primary btn-sm"><i class="fas fa-clipboard-list"></i> แบบสำรวจ</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>