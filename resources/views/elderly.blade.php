<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผู้สูงอายุ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .bg-purple {
        background-color: #e6b3e6;
    }

    body {
        background-color: #f8f9fa;
    }
    .container {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
    }
    .form-select, .form-control {
        max-width: 300px;
    }
    table {
        margin-top: 20px;
    }
    .user-info {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .user-info h5 {
        color: #333;
        margin-bottom: 10px;
    }
    .user-info p {
        margin-bottom: 5px;
        color: #666;
    }
</style>

<body>
@include('layouts.navgd')
    <div class="container mt-4">
        <div class="bg-purple p-3 rounded mb-4">
            <h2 class="text-black">รายชื่อผู้สูงอายุที่ อสม. ดูแล</h2>
        </div>

        <!-- ข้อมูล อสม. -->
        <div class="user-info">
            <h5>ข้อมูล อสม.</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ชื่อ-นามสกุล:</strong> {{ Auth::guard('chv')->user()->fullname }} </p>
                    <p><strong>รหัสประจำตัวประชาชน อสม.:</strong> {{ Auth::guard('chv')->user()->id_card }} </p>
                </div>
                <div class="col-md-6">
                    <p><strong>หมู่บ้านที่ทำงานอยู่:</strong> {{ Auth::guard('chv')->user()->village_name }}</p>
                </div>
            </div>
        </div>

        <h4 class="mt-4">รายชื่อผู้สูงอายุในความดูแล</h4>
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>อายุ</th>
                    <th>ที่อยู่</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elders as $elder)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ isset($elder->titlename) ? $elder->titlename . ' ' : '' }}{{ $elder->fullname }}</td>
                    <td>{{ \Carbon\Carbon::parse($elder->birth_date)->age }} ปี</td>
                    <td>{{ $elder->address }}</td>
                    <td>
                        <a href="{{ route('formanalysis', ['e_id' => $elder->e_id]) }}" class="btn btn-primary btn-sm">ดูข้อมูล</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>