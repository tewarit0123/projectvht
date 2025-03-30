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

        .tab-header {
            display: flex;
            justify-content: space-between;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .tab {
            flex: 1;
            text-align: center;
            padding: 15px;
            cursor: pointer;
            background-color: #ffffff;
            transition: background-color 0.3s, color 0.3s;
            border-right: 1px solid #dee2e6;
        }

        .tab:last-child {
            border-right: none;
        }

        .tab.active {
            background-color: #c99cca;
            color: rgb(0, 0, 0);
            font-weight: bold;
        }

        .tab:hover {
            background-color: #e2e6ea;
        }

        .tab-content {
            margin-top: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: none;
            /* Initially hide all content */
        }

        .tab-content.active {
            display: block;
            /* Show the content when its tab is active */
        }

        .btn-record {
            background-color: #90EE90;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
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
            <h2 class="text-black">แบบสำรวจประเมินภาวะการถดถอยของร่างกาย</h2>
        </div>
        <form method="POST" action="{{ route('store.volunteer') }}">
            @csrf
            <div class="form-floating mb-3">
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
                <div class="header text-center">
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
                    <select class="form-select">
                        <option selected>เลือกคำตอบ</option>
                        <option value="1">ทำได้</option>
                        <option value="2">ทำไม่ได้</option>
                    </select>
                    <br>
                    <label class="form-label">มีประวัติหกล้มภายใน 6 เดือน อย่างน้อย 1 ครั้งไหม</label>
                    <select class="form-select">
                        <option selected>เลือกคำตอบ</option>
                        <option value="1">มี</option>
                        <option value="2">ไม่มี</option>
                    </select>
                </div>
                <div class="tab-content" id="nutrition">
                    <h5>ด้านการขาดสารอาหาร</h5>
                    <label class="form-label">น้ำหนักลดมากกว่า 3 กิโลกรัมภายในช่วงเวลา 3 เดือนที่ผ่านมารวมวันนี้ (โดยไม่ได้ตั้งใจ ลดน้ำหนัก)</label>
                    <select class="form-select">
                        <option selected>เลือกคำตอบ</option>
                        <option value="1">มี</option>
                        <option value="2">ไม่มี</option>
                    </select>
                    <br>
                    <label class="form-label">มีความอยากอาหารลดลงหรือไม่</label>
                    <select class="form-select">
                        <option selected>เลือกคำตอบ</option>
                        <option value="1">มี</option>
                        <option value="2">ไม่มี</option>
                    </select>
                </div>
                <div class="tab-content" id="vision">
                    <h5>ด้านการมองเห็น</h5>
                    <p><label class="form-label">คุณมีปัญหาใดๆเกี่ยวกับดวงตาของคุณ เช่น การมองระยะไกลการอ่านหนังสือ </label>
                        <select class="form-select">
                            <option selected>เลือกคำตอบ</option>
                            <option value="1">มี</option>
                            <option value="2">ไม่มี</option>
                        </select>
                    </p>
                </div>
                <div class="tab-content" id="hearing">
                    <h5>ด้านการได้ยิน</h5>
                    <p><label class="form-label">ให้ถูนิ้วโป้งกับนิ้วชี้ห่างจากหูของผู้สูงอายุประมาณ 1 นิ้ว ทีละข้าง ทั้งหูขวาและ หูซ้าย </label>
                        <select class="form-select">
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
                        <select class="form-select">
                            <option selected>เลือกคำตอบ</option>
                            <option value="1">มี</option>
                            <option value="2">ไม่มี</option>
                        </select>
                    </p>
                    <label class="form-label">ใน 2 สัปดาห์ที่ผ่านมารวมวันนี้ ท่านรู้สึก เบื่อ ทำอะไรก็ไม่เพลิดเพลิน หรือไม่</label>
                    <select class="form-select">
                        <option selected>เลือกคำตอบ</option>
                        <option value="1">มี</option>
                        <option value="2">ไม่มี</option>
                    </select>
                </div>
                <div class="tab-content" id="daily">
                    <h5>ด้านการปฏิบัติกิจวัตรประจำวัน</h5>
                    <p><label class="form-label">ความสามารถในการช่วยเหลือตนเองของท่านในการทำกิจวัตรประจำวันโดยไม่ต้องพึ่ง คนอื่น ลดลงหรือไม่ เช่น กินอาหาร ล้างหน้าแปรงฟันหวีผม ลุกนั่งจากที่ นอนหรือเตียง เข้าห้องน้ำ เคลื่อนที่ไปมาในบ้าน สวมใส่เสื้อผ้า</label>
                        <select class="form-select">
                            <option selected>เลือกคำตอบ</option>
                            <option value="1">ปกติ</option>
                            <option value="2">ลดลง</option>
                        </select>
                    </p>
                </div>
                <div class="tab-content" id="oral">
                    <h5>ช่องปาก</h5>
                    <p><label class="form-label">ท่านมีความยากลำบากในการเคี้ยวอาหารแข็ง หรือไม่ </label>
                        <select class="form-select">
                            <option selected>เลือกคำตอบ</option>
                            <option value="1">มี</option>
                            <option value="2">ไม่มี</option>
                        </select>
                    </p>
                    <label class="form-label">ท่านมีอาการเจ็บปวดในช่องปาก หรือไม่</label>
                    <select class="form-select">
                        <option selected>เลือกคำตอบ</option>
                        <option value="1">มี</option>
                        <option value="2">ไม่มี</option>
                    </select>
                </div>
                <p>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="text" name="text" >
                        <label for="text">รายละเอียดเพิ่มเติม</label>
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