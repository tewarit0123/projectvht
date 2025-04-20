<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กำหนด User ให้กับคุณหมอ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="{{ asset('js/checkfrom.js') }}"></script>
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

    <div class="container">
        <div class="form-container">
            <h2 class="header">ฟอร์มกำหนด User ให้กับคุณหมอ</h2>
            @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
            @endif
            <form action="#" method="POST" onsubmit="return validateForm()">
                @csrf
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                        <label for="fullname">ชื่อ-นามสกุล</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="id_card" name="id_card" required maxlength="13"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <label for="id_card">เลขบัตรประชาชน</label>
                        <div id="id_card_error" class="text-danger"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="phone" name="phone" required maxlength="10">
                        <label for="phone">เบอร์โทรศัพท์</label>
                        <div id="phone_error" class="text-danger"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="username" name="username" required>
                        <label for="username">ชื่อผู้ใช้</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control " id="password" name="password" pattern="\d{6}"
                            maxlength="6" required title="กรุณากรอกรหัสผ่าน 6 หลัก">
                        <label for="password">รหัสผ่าน</label>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
            </form>
        </div>

        <!-- ตารางแสดงข้อมูล -->
        <div class="row mt-5">
            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>ข้อมูลคุณหมอ</h2>
                    <div class="form-floating">
                        <input type="text" id="search" class="form-control" placeholder="ค้นหา...">
                        <label for="search">ค้นหาตาม: ชื่อ, เลขบัตร</label>
                    </div>
                </div>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th style="width: 5%;">ที่</th>
                            <th style="width: 25%;">ชื่อ-นามสกุล</th>
                            <th style="width: 20%;">เลขบัตรประชาชน</th>
                            <th style="width: 20%;">ชื่อผู้ใช้</th>
                            <th style="width: 10%;">แก้ไข</th>
                            <th style="width: 10%;">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>