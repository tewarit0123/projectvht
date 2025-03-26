<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบสำรวจ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .bg-purple {
            background-color: #e6b3e6;
        }

        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header h4 {
            color: #333;
            font-weight: bold;
            margin-top: 20px;
        }

        .btn-record {
            background-color: #90EE90;
            border: none;
            padding: 8px 20px;
            font-weight: 500;
        }

        .btn-record:hover {
            background-color: #7ac97a;
        }

        .card-header {
            padding: 0.5rem 1rem;
        }

        h6 {
            color: #666;
            font-weight: 600;
        }

        .form-floating textarea.form-control {
            height: 100px !important;
        }

        .form-control {
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
@include('layouts.navgd')

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mt-4">
        <div class="bg-purple p-3 rounded mb-3">
        <h2 class="text-black">บันทึกแบบสำรวจผู้สูงอายุ</h2>
        </div>
        <form method="POST" action="#">
            @csrf
            <div class="form-floating mb-3">
                <div class="">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="id_card" name="id_card" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <label for="id_card">เลขบัตรประชาชน</label>
                        <div id="id_card_error" class="text-danger"></div>
                    </div>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-floating">
                        <select class="form-select" id="titlename" name="titlename" required onchange="setGender()">
                            <option value="" disabled selected>กรุณาเลือกคำนำหน้าชื่อ</option>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>
                        <label for="titlename">คำนำหน้าชื่อ</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                        <label for="fullname">ชื่อ-นามสกุล</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="address" name="address" required>
                        <label for="address">ที่อยู่</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="village" name="village">
                        <label for="village">หมู่บ้าน</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="phone" name="phone" required>
                        <label for="phone">เบอร์โทรศัพท์</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                        <label for="birth_date">วัน เดือน ปีเกิด</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="age" name="age" required>
                        <label for="age">อายุ</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="height" name="height" required>
                        <label for="height">ส่วนสูง (เซนติเมตร)</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="weight" name="weight" required>
                        <label for="weight">น้ำหนัก (กิโลกรัม)</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">เพศ</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="ชาย" required>
                        <label class="form-check-label" for="male">ชาย</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="หญิง" required>
                        <label class="form-check-label" for="female">หญิง</label>
                    </div>
                </div>
            </div>

            <!-- ข้อมูลวิเคราะห์การติดเชื้อ -->
            <h2 class="text-center mb-4">ข้อมูลวิเคราะห์อาการเบื้องต้น</h2>
            <div class="mb-3">
                <h6 class="mb-2">ข้อมูลโรค</h6>
                <div class="form-floating">
                    <textarea class="form-control" id="disease_info" name="disease_info" style="height: 100px"></textarea>
                    <label for="disease_info">ข้อมูลโรค</label>
                </div>
            </div>

            <!-- สาเหตุการเกิดโรค/อาการ -->
            <div class="mb-3">
                <h6 class="mb-2">สาเหตุการเกิดโรค/อาการ</h6>
                <div class="form-floating">
                    <textarea class="form-control" id="cause_info" name="cause_info" style="height: 100px"></textarea>
                    <label for="cause_info">สาเหตุการเกิดโรค/อาการ</label>
                </div>
            </div>

            <!-- การดูแลรักษา -->
            <div class="mb-3">
                <h6 class="mb-2">การดูแลรักษา</h6>
                <div class="form-floating">
                    <textarea class="form-control" id="treatment_info" name="treatment_info" style="height: 100px"></textarea>
                    <label for="treatment_info">การดูแลรักษา</label>
                </div>
            </div>

            <!-- วิธีการป้องกัน -->
            <div class="mb-3">
                <h6 class="mb-2">วิธีการป้องกัน</h6>
                <div class="form-floating">
                    <textarea class="form-control" id="prevention_info" name="prevention_info" style="height: 100px"></textarea>
                    <label for="prevention_info">วิธีการป้องกัน</label>
                </div>
            </div>

            <!-- วิธีการฟื้นฟู -->
            <div class="mb-3">
                <h6 class="mb-2">วิธีการออกกำลังกาย/ฟื้นฟู</h6>
                <div class="form-floating">
                    <textarea class="form-control" id="recovery_info" name="recovery_info" style="height: 100px"></textarea>
                    <label for="recovery_info">วิธีการฟื้นฟู</label>
                </div>
            </div>

            <!-- การกินอาหาร -->
            <div class="mb-3">
                <h6 class="mb-2">การกินอาหาร</h6>
                <div class="form-floating">
                    <textarea class="form-control" id="food_info" name="food_info" style="height: 100px"></textarea>
                    <label for="food_info">การกินอาหาร</label>
                </div>
            </div>

            <div class="text-end mb-4">
                <button type="submit" class="btn btn-record">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>