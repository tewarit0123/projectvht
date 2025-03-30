<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผู้สูงอายุ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="{{ asset('js/checkfrom.js') }}"></script>
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

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-success {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(46, 204, 113, 0.2);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 204, 113, 0.3);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        /* .table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #2c3e50;
            font-weight: 600;
        } */
    </style>
</head>

<body>
@include('layouts.navg')

    <div class="container">
        <div class="form-container">
            <h2 class="header">ฟอร์มกรอกข้อมูลผู้สูงอายุ</h2>
            @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
            @endif
            <form action="{{ route('formelderly.store') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <div class="form-container">
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
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="fullname" name="fullname" value="" required>
                                <label for="fullname">ชื่อ-นามสกุล</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="gender" name="gender" value="" required readonly>
                                <label for="gender">เพศ</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="phone" name="phone" value="" required>
                                <label for="phone">เบอร์โทร</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="weight" name="weight" value="" required>
                                <label for="weight">น้ำหนัก</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="height" name="height" value="" required>
                                <label for="height">ส่วนสูง</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="birth_date" name="birth_date" value="" required onchange="updateAge()" min="1900-01-01" max="1964-12-31">
                                <label for="birth_date">วัน/เดือน/ปีเกิด</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="age" name="age" value="" readonly required disabled>
                                <label for="age">อายุ</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="id_card" name="id_card" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                <label for="id_card">เลขบัตรประชาชน</label>
                                <div id="id_card_error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="address" name="address" value="" required>
                                <label for="address">ที่อยู่</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-control" id="village" name="village" required>
                                    <option value="" disabled selected>เลือกหมู่บ้าน</option>
                                    @if(isset($villages) && count($villages) > 0)
                                    @foreach ($villages as $village)
                                            <option value="{{ $village->v_name }}">{{ $village->v_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>ไม่มีข้อมูลหมู่บ้าน</option>
                                    @endif
                                </select>
                                <label for="village">หมู่บ้าน</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="volunteer" name="volunteer" value="" required>
                                <label for="volunteer">อสม. ที่รับหน้าที่ดูแลผู้สูงอายุ</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="doctor" name="doctor" value="" required>
                                <label for="doctor">หมอ ที่รับหน้าที่ดูแลผู้สูงอายุ</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="phonevolunteer" name="phonevolunteer" value="" required>
                                <label for="phonevolunteer">เบอร์ติดต่อ อสม.</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="phonedoctor" name="phonedoctor" value="" required>
                                <label for="phonedoctor">เบอร์ติดต่อ หมอ</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <div class="row mt-3">
            <!-- ส่วนแสดงข้อมูลผู้สูงอายุ -->
            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>ข้อมูลผู้สูงอายุ</h2>
                    <div class="col-md-4">
                        <form action="{{ route('formelderly') }}" method="GET" id="searchForm">
                            <div class="form-floating">
                                <input type="text" id="search" name="search" class="form-control" 
                                       placeholder="ค้นหา..." value="{{ request('search') }}">
                                <label for="search">ค้นหาตาม: ชื่อ, เลขบัตร</label>
                            </div>
                        </form>
                    </div>
                </div>

                @if(request('search'))
                    <div class="alert alert-info">
                        ผลการค้นหาสำหรับ: "{{ request('search') }}"
                        @if($elders->total() > 0)
                            (พบ {{ $elders->total() }} รายการ)
                        @else
                            (ไม่พบข้อมูล)
                        @endif
                    </div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th style="width: 5%;">ที่</th>
                            <th style="width: 20%;">ชื่อ-นามสกุล</th>
                            <th style="width: 25%;">เลขบัตรประจำตัว</th>
                            <th style="width: 8%;">อายุ</th>
                            <th style="width: 8%;">เพศ</th>
                            <th style="width: 15%;">หมู่บ้าน</th> 
                            <th style="width: 10%;">แก้ไข</th>
                            <th style="width: 15%;">ลบ</th>
                        </tr>
                    </thead>
                    @foreach ($elders as $elder)
                    <tr class="text-center">
                        <td>{{ $loop->iteration + ($elders->currentPage() - 1) * $elders->perPage() }}</td>
                        <td class="text-start">{{ $elder->titlename }} {{ $elder->fullname }} </td>
                        <td>{{ $elder->id_card }}</td>
                        <td>{{ \Carbon\Carbon::parse($elder->birth_date)->age }} ปี</td>
                        <td>{{ ucfirst($elder->gender) }}</td>
                        <td class="text-start">{{ $elder->village }}</td> <!-- Displaying village -->
                        <td>
                            <button type="button" class="btn btn-sm btn-link p-0" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $elder->e_id }}">
                                <i class="fas fa-pencil-alt text-success"></i>
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('formelderly.destroy', $elder->e_id) }}" method="POST"
                                onsubmit="return confirm('คุณต้องการลบข้อมูลนี้?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i> ลบ
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $elder->e_id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $elder->e_id }}" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header header">
                                    <h5 class="modal-title" id="editModalLabel{{ $elder->e_id }}">แก้ไขข้อมูลผู้สูงอายุ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('formelderly.update', $elder->e_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-container">
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="titlename" name="titlename" required>
                                                            <option value="นาย" {{ $elder->titlename == 'นาย' ? 'selected' : '' }}>นาย</option>
                                                            <option value="นาง" {{ $elder->titlename == 'นาง' ? 'selected' : '' }}>นาง</option>
                                                            <option value="นางสาว" {{ $elder->titlename == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                                                        </select>
                                                        <label for="titlename">คำนำหน้าชื่อ</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $elder->fullname }}" required>
                                                        <label for="fullname">ชื่อ-นามสกุล</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="gender" name="gender" required disabled>
                                                            <option value="ชาย" {{ $elder->gender == 'ชาย' ? 'selected' : '' }}>ชาย</option>
                                                            <option value="หญิง" {{ $elder->gender == 'หญิง' ? 'selected' : '' }}>หญิง</option>
                                                        </select>
                                                        <label for="gender">เพศ</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $elder->phone }}" required>
                                                        <label for="phone">เบอร์โทร</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="weight" name="weight" value="{{ number_format($elder->weight, 0) }}" required>
                                                        <label for="weight">น้ำหนัก</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="height" name="height" value="{{ number_format($elder->height, 0) }}" required>
                                                        <label for="height">ส่วนสูง</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $elder->birth_date }}" required style="background-color: #e9ecef; pointer-events: none;">
                                                        <label for="birth_date">วัน/เดือน/ปีเกิด</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="number" class="form-control" id="age" name="age" value="{{ \Carbon\Carbon::parse($elder->birth_date)->age }}" readonly required style="background-color: #e9ecef; pointer-events: none;">
                                                        <label for="age">อายุ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="id_card" name="id_card" value="{{ $elder->id_card }}" readonly required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '')" style="background-color: #e9ecef; pointer-events: none;">
                                                        <label for="id_card">เลขบัตรประชาชน</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="address" name="address" value="{{ $elder->address }}" required>
                                                        <label for="address">ที่อยู่</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <select class="form-control" id="village" name="village" required>
                                                            <option value="" disabled selected>เลือกหมู่บ้าน</option>
                                                            @if(isset($villages) && count($villages) > 0)
                                                                @foreach ($villages as $village)
                                                                    <option value="{{ $village->v_name }}" {{ $village->v_name == $elder->village ? 'selected' : '' }}>{{ $village->v_name }}</option>
                                                                @endforeach
                                                            @else
                                                                <option value="" disabled>ไม่มีข้อมูลหมู่บ้าน</option>
                                                            @endif
                                                        </select>
                                                        <label for="village">หมู่บ้าน</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="volunteer" name="volunteer" value="{{ $elder->volunteer }}" required>
                                                        <label for="volunteer">อสม. ที่รับหน้าที่ดูแลผู้สูงอายุ</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="doctor" name="doctor" value="{{ $elder->doctor }}" required>
                                                        <label for="doctor">หมอ ที่รับหน้าที่ดูแลผู้สูงอายุ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="phonevolunteer" name="phonevolunteer" value="{{ $elder->phonevolunteer }}" required>
                                                        <label for="phonevolunteer">เบอร์ติดต่อ อสม.</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="phonedoctor" name="phonedoctor" value="{{ $elder->phonedoctor }}" required>
                                                        <label for="phonedoctor">เบอร์ติดต่อ หมอ</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-success">อัพเดท</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </table>
                <div class="text-center">   
                    แสดง {{ $elders->firstItem() }} ถึง {{ $elders->lastItem() }} จาก {{ $elders->total() }} รายการ
                </div>
                <div class="text-center">
                    <ul class="pagination justify-content-center">
                        <li class="page-item {{ $elders->currentPage() == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $elders->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @foreach ($elders->getUrlRange(1, $elders->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $elders->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach
                        <li class="page-item {{ $elders->currentPage() == $elders->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $elders->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        // Function to calculate age from birth date
        function dateAge(birthDate) {
            const today = new Date();
            const birth = new Date(birthDate);
            let age = today.getFullYear() - birth.getFullYear();
            const monthDiff = today.getMonth() - birth.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
                age--;
            }
            return age;
        }

        function updateAge() {
            const birthDate = document.getElementById('birth_date').value;
            const age = dateAge(birthDate);
            document.getElementById('age').value = age;
        }

        // New function to format date to dd/mm/yyyy
        function formatDate(dateString) {
            var dateParts = dateString.split('-');
            return dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0]; // Convert to dd/mm/yyyy
        }

        document.getElementById('birth_date').addEventListener('change', function() {
            var formattedDate = formatDate(this.value);
            console.log('Formatted Date:', formattedDate); // You can use this formatted date as needed
        });

        document.getElementById('search').addEventListener('input', function(e) {
            const searchForm = document.getElementById('searchForm');
            
            // ถ้าช่องค้นหาว่างเปล่า
            if (this.value === '') {
                // รีเซ็ตการค้นหาและโหลดข้อมูลทั้งหมดใหม่
                window.location.href = "{{ route('formelderly') }}";
            } 
            // ถ้ามีการพิมพ์ข้อความ
            else if (this.value.length >= 1) {
                searchForm.submit();
            }
        });

        // ทำงานเมื่อกด Enter
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            const searchInput = document.getElementById('search');
            if (searchInput.value.trim() === '') {
                e.preventDefault();
                window.location.href = "{{ route('formelderly') }}";
            }
        });

        // ทำงานเมื่อลบข้อความในช่องค้นหา
        document.getElementById('search').addEventListener('input', function(e) {
            if (this.value === '') {
                window.location.href = "{{ route('formelderly') }}";
            }
        });
    </script>
</body>

</html>