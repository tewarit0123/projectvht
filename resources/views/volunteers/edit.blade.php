<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลผู้สูงอายุ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .btn-save {
            background-color: #8080ff;
            color: white;
        }

        .btn-save:hover {
            background-color: #6666ff;
            color: white;
        }
        
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

    </style>
    <script>
        function chkDigitPid(p_iPID) {
            var total = 0;
            var iPID;
            var chk;
            var Validchk;
            iPID = p_iPID.replace(/-/g, "");
            Validchk = iPID.substr(12, 1);
            var j = 0;
            var pidcut;
            for (var n = 0; n < 12; n++) {
                pidcut = parseInt(iPID.substr(j, 1));
                total = (total + ((pidcut) * (13 - n)));
                j++;
            }

            chk = 11 - (total % 11);

            if (chk == 10) {
                chk = 0;
            } else if (chk == 11) {
                chk = 1;
            }
            if (chk == Validchk) {
                alert("ระบุหมายเลขประจำตัวประชาชนถูกต้อง");
                return true;
            } else {
                alert("ระบุหมายเลขประจำตัวประชาชนไม่ถูกต้อง");
                return false;
            }

        }
    </script>
</head>

<body>
    <div class="container mt-5">
    <div class="form-container"></div>
    <div class="bg-purple p-3 rounded">
            <h2 class="text-black">แก้ไขข้อมูลผู้สูงอายุ</h2>
        </div>
        <p></p>
        <form method="POST" action="{{ route('volunteers.update', $volunteer->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="national_id" class="form-label">เลขบัตรประจำตัวประชาชน *( x-xxxx-xxxxx-xx-x )</label>
                <input type="text" class="form-control" id="national_id" name="national_id" value="{{ $volunteer->national_id }}" placeholder="x-xxxx-xxxxx-xx-x" onblur="chkDigitPid(this.value)" required>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="first_name" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $volunteer->first_name }}" required>
                </div>
                <div class="col">
                    <label for="last_name" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $volunteer->last_name }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="address" class="form-label">ที่อยู่</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $volunteer->address }}" required>
                </div>
                <div class="col">
                    <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $volunteer->phone }}" required maxlength="10" pattern="\d{10}" title="กรุณาใส่เบอร์โทรศัพท์ 10 หลัก">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="birth_date" class="form-label">วัน เดือน ปีเกิด</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $volunteer->birth_date }}" required>
                </div>
                <p></p>
                <div class="row mb-3">
                    <div class="col">
                        <label for="age" class="form-label">อายุ</label>
                        <input type="number" class="form-control" id="age" placeholder="ปี" name="age" value="{{ $volunteer->age }}" disabled>
                    </div>
                    <div class="col">
                        <label for="height" class="form-label">ส่วนสูง</label>
                        <input type="number" class="form-control" id="height" placeholder="เซนติเมตร" name="height" value="{{ $volunteer->height }}" required>
                    </div>
                    <div class="col">
                        <label for="weight" class="form-label">น้ำหนัก</label>
                        <input type="number" class="form-control" id="weight" placeholder="กิโลกรัม" name="weight" value="{{ $volunteer->weight }}" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">เพศ</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="ชาย" {{ $volunteer->gender == 'ชาย' ? 'checked' : '' }}>
                        <label class="form-check-label" for="male">ชาย</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="หญิง" {{ $volunteer->gender == 'หญิง' ? 'checked' : '' }}>
                        <label class="form-check-label" for="female">หญิง</label>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-save">บันทึก</button>
                <a href="{{ route('volunteers.index') }}" class="btn btn-secondary">ยกเลิก</a>
            </div>
        </form>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        function calculateAge() {
            var birthDate = new Date(document.getElementById('birth_date').value);
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            document.getElementById('age').value = age;
        }

        function setDateRestrictions() {
            var today = new Date();
            var sixtyYearsAgo = new Date(today.getFullYear() - 60, today.getMonth(), today.getDate());
            var maxDate = sixtyYearsAgo.toISOString().split('T')[0]; // Convert to yyyy-mm-dd format
            document.getElementById('birth_date').setAttribute('max', maxDate);
        }

        document.addEventListener('DOMContentLoaded', function() {
            setDateRestrictions(); // Set date restrictions when the page loads
            document.getElementById('birth_date').addEventListener('change', calculateAge);
        });

        //เบอร์โทร 10 หลัก
        document.getElementById('phone').addEventListener('input', function() {
            if (this.value.length > 10) {
                this.value = this.value.slice(0, 10);
            }
        });
    </script>

</body>

</html>