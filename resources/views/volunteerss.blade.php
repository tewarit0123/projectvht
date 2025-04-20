<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบสำรวจ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
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

        .header h4 {
            color: white;
            font-weight: 600;
            margin: 0;
        }

        .tab-header {
            display: flex;
            justify-content: space-between;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        .tab {
            flex: 1;
            text-align: center;
            padding: 15px;
            cursor: pointer;
            background-color: white;
            transition: all 0.3s ease;
            border-right: 1px solid #dee2e6;
            font-weight: 500;
        }

        .tab:last-child {
            border-right: none;
        }

        .tab.active {
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
            color: white;
        }

        .tab:hover:not(.active) {
            background-color: #f8f9fa;
            transform: translateY(-2px);
        }

        .tab-content {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .form-floating {
            margin-bottom: 15px;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #8e44ad;
            box-shadow: 0 0 0 0.2rem rgba(142, 68, 173, 0.25);
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-record {
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(142, 68, 173, 0.2);
        }

        .btn-record:hover {
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(142, 68, 173, 0.3);
            color: white;
        }

        h5 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-label {
            color: #34495e;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .alert {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
                margin-top: 15px;
            }

            .header {
                padding: 10px 15px;
            }

            .tab-header {
                flex-direction: column;
                border-radius: 10px;
            }

            .tab {
                border-right: none;
                border-bottom: 1px solid #dee2e6;
                padding: 10px;
            }

            .tab:last-child {
                border-bottom: none;
            }

            .form-floating {
                margin-bottom: 10px;
            }

            .row {
                margin-right: -5px;
                margin-left: -5px;
            }

            .col, .col-md-2, .col-md-4, .col-md-6 {
                padding-right: 5px;
                padding-left: 5px;
            }

            h2 {
                font-size: 1.5rem;
            }

            h4 {
                font-size: 1.2rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 10px;
            }

            .form-control, .form-select {
                font-size: 14px;
            }

            .tab {
                font-size: 14px;
            }

            .form-label {
                font-size: 14px;
            }

            .row > [class*='col-'] {
                margin-bottom: 10px;
            }
        }

        /* Fix for form controls on mobile */
        @media (max-width: 768px) {
            .form-floating > .form-control,
            .form-floating > .form-select {
                height: calc(3.5rem + 2px);
                line-height: 1.25;
            }

            .form-floating > label {
                padding: 1rem 0.75rem;
            }
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
            <h2 class="text-white">แบบสำรวจประเมินภาวะการถดถอยของร่างกาย</h2>
        </div>
        <form method="POST" action="{{ route('monthly-survey.store') }}">
            @csrf
            <input type="hidden" id="e_id" name="e_id">
            <div class="form-floating mb-4">
            <div class="text-center">
                    <h4>แบบข้อมูลผู้สูงอายุ</h4>
                </div>
                <div class="">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="id_card" name="id_card" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '')" disabled>
                        <label for="id_card">เลขบัตรประชาชน</label>
                        <div id="id_card_error" class="text-danger"></div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-floating">
                        <select class="form-select" id="titlename" name="titlename" required onchange="setGender()" disabled>
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
                        <select class="form-select" id="fullname" name="fullname" required onchange="getElderDetails()" >
                            <option value="" disabled selected>กรุณาเลือกชื่อ-นามสกุล</option>
                            @foreach($elders as $elder)
                                <option value="{{ $elder->fullname }}">{{ $elder->fullname }}</option>
                            @endforeach
                        </select>
                        <label for="fullname">ชื่อ-นามสกุล</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="gender" name="gender" required readonly disabled>
                        <label for="gender">เพศ</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="address" name="address" required disabled>
                        <label for="address">ที่อยู่</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="village" name="village" required disabled>
                        <label for="village">หมู่บ้าน</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="phone" name="phone" required disabled>
                        <label for="phone">เบอร์โทรศัพท์</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="birth_date" name="birth_date" required disabled>
                        <label for="birth_date">วัน เดือน ปีเกิด</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="age" name="age" required disabled>
                        <label for="age">อายุ</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="height" name="height" 
                        required disabled>
                        <label for="height">ส่วนสูง (เซนติเมตร)</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="weight" name="weight" required disabled>
                        <label for="weight">น้ำหนัก (กิโลกรัม)</label>
                    </div>
                </div>
            </div>



            <div class="container mt-4">
                <div class="text-center">
                    <h4>แบบประเมินภาวะถดถอยของร่างกาย</h4>
                </div>
                <div class="tab-header mt-4">
                    <div class="tab active" data-target="movement">ด้านการเคลื่อนไหวร่างกาย</div>
                    <div class="tab" data-target="nutrition">ด้านการขาดสารอาหาร</div>
                    <div class="tab" data-target="vision">ด้านการมองเห็น</div>
                    <div class="tab" data-target="hearing">ด้านการได้ยิน</div>
                    <div class="tab" data-target="depression">ด้านภาวะซึมเศร้า</div>
                    <div class="tab" data-target="daily">ด้านการปฏิบัติกิจวัตรประจำวัน</div>
                    <div class="tab" data-target="oral">ช่องปาก</div>
                </div>

                <div class="tab-content active" id="movement">
                    <h5>ด้านการเคลื่อนไหวร่างกาย</h5>
                    <label class="form-label">ให้ผู้สูงอายุเดินไปและกลับด้วยตนเอง 6 เมตร ภายในระยะเวลา 12 วินาที ทำได้หรือไม่</label>
                    <select class="form-select" name="walk_6m">
                        <option selected>เลือกคำตอบ</option>
                        <option value="1">ทำได้</option>
                        <option value="2">ทำไม่ได้</option>
                    </select>
                    <br>
                    <label class="form-label">มีประวัติหกล้มภายใน 6 เดือน อย่างน้อย 1 ครั้งไหม</label>
                    <select class="form-select" name="fall_6mo">
                        <option selected>เลือกคำตอบ</option>
                        <option value="1">มี</option>
                        <option value="2">ไม่มี</option>
                    </select>
                </div>
                <div class="tab-content" id="nutrition">
                    <h5>ด้านการขาดสารอาหาร</h5>
                    <label class="form-label">น้ำหนักลดมากกว่า 3 กิโลกรัมภายในช่วงเวลา 3 เดือนที่ผ่านมารวมวันนี้ (โดยไม่ได้ตั้งใจ ลดน้ำหนัก)</label>
                    <select class="form-select" name="weight_loss">
                        <option selected>เลือกคำตอบ</option>
                        <option value="1">มี</option>
                        <option value="2">ไม่มี</option>
                    </select>
                    <br>
                    <label class="form-label">มีความอยากอาหารลดลงหรือไม่</label>
                    <select class="form-select" name="appetite_loss">
                        <option selected>เลือกคำตอบ</option>
                        <option value="1">มี</option>
                        <option value="2">ไม่มี</option>
                    </select>
                </div>
                <div class="tab-content" id="vision">
                    <h5>ด้านการมองเห็น</h5>
                    <p><label class="form-label">คุณมีปัญหาใดๆเกี่ยวกับดวงตาของคุณ เช่น การมองระยะไกลการอ่านหนังสือ </label>
                        <select class="form-select" name="vision_problem">
                            <option selected>เลือกคำตอบ</option>
                            <option value="1">มี</option>
                            <option value="2">ไม่มี</option>
                        </select>
                    </p>
                </div>
                <div class="tab-content" id="hearing">
                    <h5>ด้านการได้ยิน</h5>
                    <p><label class="form-label">ให้ถูนิ้วโป้งกับนิ้วชี้ห่างจากหูของผู้สูงอายุประมาณ 1 นิ้ว ทีละข้าง ทั้งหูขวาและ หูซ้าย </label>
                        <select class="form-select" name="hearing_status">
                            <option selected>เลือกคำตอบ</option>
                            <option value="1">ได้ยินปกติ</option>
                            <option value="2">ไม่ได้ยินทั้ง2ข้าง</option>
                            <option value="3">ได้ยินข้างขวาข้างเดียว</option>
                            <option value="4">ได้ยินข้างซ้ายข้างเดียว</option>
                        </select>
                    </p>
                </div>
                <div class="tab-content" id="depression">
                    <h5>ด้านภาวะซึมเศร้า</h5>
                    <p><label class="form-label">ใน 2 สัปดาห์ที่ผ่านมารวมวันนี้ ท่านรู้สึกหดหู เศร้า หรือท้อแท้ สิ้นหวัง หรือไม่</label>
                        <select class="form-select" name="sadness">
                            <option selected>เลือกคำตอบ</option>
                            <option value="1">มี</option>
                            <option value="2">ไม่มี</option>
                        </select>
                    </p>
                    <label class="form-label">ใน 2 สัปดาห์ที่ผ่านมารวมวันนี้ ท่านรู้สึก เบื่อ ทำอะไรก็ไม่เพลิดเพลิน หรือไม่</label>
                    <select class="form-select" name="no_pleasure">
                        <option selected>เลือกคำตอบ</option>
                        <option value="1">มี</option>
                        <option value="2">ไม่มี</option>
                    </select>
                </div>
                <div class="tab-content" id="daily">
                    <h5>ด้านการปฏิบัติกิจวัตรประจำวัน</h5>
                    <p><label class="form-label">ความสามารถในการช่วยเหลือตนเองของท่านในการทำกิจวัตรประจำวันโดยไม่ต้องพึ่ง คนอื่น ลดลงหรือไม่ เช่น กินอาหาร ล้างหน้าแปรงฟันหวีผม ลุกนั่งจากที่ นอนหรือเตียง เข้าห้องน้ำ เคลื่อนที่ไปมาในบ้าน สวมใส่เสื้อผ้า</label>
                        <select class="form-select" name="daily_living">
                            <option selected>เลือกคำตอบ</option>
                            <option value="1">ปกติ</option>
                            <option value="2">ลดลง</option>
                        </select>
                    </p>
                </div>
                <div class="tab-content" id="oral">
                    <h5>ช่องปาก</h5>
                    <p><label class="form-label">ท่านมีความยากลำบากในการเคี้ยวอาหารแข็ง หรือไม่ </label>
                        <select class="form-select" name="chewing_problem">
                            <option selected>เลือกคำตอบ</option>
                            <option value="1">มี</option>
                            <option value="2">ไม่มี</option>
                        </select>
                    </p>
                    <label class="form-label">ท่านมีอาการเจ็บปวดในช่องปาก หรือไม่</label>
                    <select class="form-select" name="oral_pain">
                        <option selected>เลือกคำตอบ</option>
                        <option value="1">มี</option>
                        <option value="2">ไม่มี</option>
                    </select>
                </div>
                <p>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="details" name="details" >
                        <label for="details">รายละเอียดเพิ่มเติม</label>
                    </div>
                </div>
                </p>
                <div class="text-end">
                    <button type="submit" class="btn btn-record">บันทึก</button>
                </div>
        </form>
        <br>
    </div>


    </div>
    </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs and contents
                    tabs.forEach(t => t.classList.remove('active'));
                    contents.forEach(c => c.classList.remove('active'));

                    // Add active class to the clicked tab and the corresponding content
                    tab.classList.add('active');
                    document.getElementById(tab.getAttribute('data-target')).classList.add('active');
                });
            });
        });

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

        function getElderDetails() {
            const fullname = document.getElementById('fullname').value;
            fetch(`/get-elder-details?fullname=${fullname}`)
                .then(response => response.json())
                .then(data => {
                    console.log('API Response:', data);
                    document.getElementById('e_id').value = data.e_id;
                    document.getElementById('id_card').value = data.id_card;
                    document.getElementById('titlename').value = data.titlename;
                    document.getElementById('gender').value = data.gender;
                    document.getElementById('address').value = data.address;
                    document.getElementById('village').value = data.village;
                    document.getElementById('phone').value = data.phone;
                    document.getElementById('birth_date').value = data.birth_date;
                    document.getElementById('height').value = Math.round(data.height);
                    document.getElementById('weight').value = Math.round(data.weight);
                    
                    // คำนวณอายุอัตโนมัติ
                    calculateAge();
                });
        }
    </script>
</body>

</html>