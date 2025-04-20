<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลผู้สูงอายุ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        .bg-purple {
            background-color: #e6b3e6;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Kanit', sans-serif;
        }

        .form-container {
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

        .info-card {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs {
            border-bottom: 2px solid #e6b3e6;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #666;
            padding: 10px 20px;
            margin-right: 5px;
            border-radius: 5px 5px 0 0;
        }

        .nav-tabs .nav-link.active {
            background-color: #e6b3e6;
            color: black;
        }

        .nav-tabs .nav-link:hover {
            color: black; /* Change text color to black on hover */
            background-color: #e6b3e6;
        }

        .content-section {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
@include('layouts.navigation')
    
    <div class="container">
        <div class="form-container">
            <h2 class="header">ข้อมูลผู้สูงอายุ</h2>

            <!-- ข้อมูลส่วนตัว -->
            <div class="info-card">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ชื่อ-นามสกุล:</strong> {{ $elder->titlename }} {{ $elder->fullname }}</p>
                        <p><strong>อายุ:</strong> {{ \Carbon\Carbon::parse($elder->birth_date)->age }} ปี</p>
                        <p><strong>ที่อยู่:</strong> {{ $elder->address }}</p>
                        <p><strong>หมู่บ้าน:</strong> {{ $elder->village }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>เลขประจำตัวประชาชน:</strong> {{ $elder->id_card }}</p>
                        <p><strong>เพศ:</strong> {{ $elder->gender }}</p>
                        <p><strong>น้ำหนัก:</strong> {{ rtrim(rtrim($elder->weight, '0'), '.') }} กก.</p>
                        <p><strong>ส่วนสูง:</strong> {{ rtrim(rtrim($elder->height, '0'), '.') }} ซม.</p>
                    </div>
                </div>
            </div>

            <!-- แท็บเมนู -->
            <ul class="nav nav-tabs" id="elderTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="disease-tab" data-bs-toggle="tab" href="#disease" role="tab">ข้อมูลโรค</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cause-tab" data-bs-toggle="tab" href="#cause" role="tab">สาเหตุการเกิดโรค/อาการ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="treatment-tab" data-bs-toggle="tab" href="#treatment" role="tab">การดูแลรักษา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="prevention-tab" data-bs-toggle="tab" href="#prevention" role="tab">วิธีการป้องกัน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="exercise-tab" data-bs-toggle="tab" href="#exercise" role="tab">วิธีการออกกำลังกาย/ฟื้นฟู</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="food-tab" data-bs-toggle="tab" href="#food" role="tab">การกินอาหาร</a>
                </li>
            </ul>

            <!-- เนื้อหาแท็บ -->
            <div class="tab-content" id="elderTabsContent">
                <div class="tab-pane fade show active content-section" id="disease" role="tabpanel">
                    <h4 class="mb-4">ข้อมูลโรค</h4>

                </div>
                <div class="tab-pane fade content-section" id="cause" role="tabpanel">
                    <h4 class="mb-4">สาเหตุการเกิดโรค/อาการ</h4>
                    <!-- เพิ่มเนื้อหาตามต้องการ -->
                </div>
                <!-- เพิ่ม tab-pane อื่นๆ ตามต้องการ -->
                <div class="tab-pane fade content-section" id="treatment" role="tabpanel">
                    <h4 class="mb-4">การดูแลรักษา</h4>
                    <!-- เพิ่มเนื้อหาตามต้องการ -->
                </div>
                <div class="tab-pane fade content-section" id="prevention" role="tabpanel">
                    <h4 class="mb-4">วิธีการป้องกัน</h4>
                    <!-- เพิ่มเนื้อหาตามต้องการ -->
                </div>
                <div class="tab-pane fade content-section" id="exercise" role="tabpanel">
                    <h4 class="mb-4">วิธีการออกกำลังกาย/ฟื้นฟู</h4>
                    <!-- เพิ่มเนื้อหาตามต้องการ -->
                </div>
                <div class="tab-pane fade content-section" id="food" role="tabpanel">
                    <h4 class="mb-4">การกินอาหาร</h4>
                    <!-- เพิ่มเนื้อหาตามต้องการ -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>