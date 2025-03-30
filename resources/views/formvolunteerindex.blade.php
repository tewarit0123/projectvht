<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูล อสม.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="{{ asset('js/checkfrom.js') }}"></script>
    <style>
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

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background: white;
            margin-bottom: 25px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
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
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 204, 113, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.2);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }
/* 
        .table thead th {
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 500;
        } */

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }

        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 20px 25px;
        }

        .form-floating > .form-control,
        .form-floating > .form-select {
            height: calc(3.5rem + 2px);
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-floating > .form-control:focus,
        .form-floating > .form-select:focus {
            border-color: #8e44ad;
            box-shadow: 0 0 0 0.2rem rgba(142, 68, 173, 0.25);
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination .page-link {
            border-radius: 8px;
            margin: 0 3px;
            color: black;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
            border: none;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
        }
    </style>
</head>

<body>
    @include('layouts.navg')

    <div class="container mt-5">
        <div class="row">
            <!-- ส่วนฟอร์มกรอกข้อมูล -->
            <div class="col-md">
                <div class="form-container">
                    <h2 class="header">ฟอร์มกรอกข้อมูล อสม.</h2>

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('formvolunteer.store') }}" method="POST" onsubmit="return validateForm()">
                        @csrf
                        <div class="form-container">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select class="form-select" id="titlename" name="titlename" required
                                            onchange="setGender()">
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
                                        <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                            id="fullname" name="fullname" value="" required>
                                        <label for="fullname">ชื่อ-นามสกุล</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="date"
                                            class="form-control @error('birth_date') is-invalid @enderror"
                                            id="birth_date" name="birth_date" value="" required
                                            onchange="calculateAge()">
                                        <label for="birth_date">วัน เดือน ปีเกิด</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="age" name="age" value="" readonly
                                            style="background-color: #e9ecef; pointer-events: none;">
                                        <label for="age">อายุ</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="" required>
                                        <label for="phone">เบอร์โทร</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="id_card" name="id_card" required
                                            maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        <label for="id_card">เลขบัตรประชาชน</label>
                                        <div id="id_card_error" class="text-danger"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address" value="" required>
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
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('gender') is-invalid @enderror"
                                            id="gender" name="gender" value="" readonly required>
                                        <label for="gender">เพศ</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" name="username" value="" required>
                                        <label for="username">ชื่อผู้ใช้</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password"  required
                                            title="กรุณากรอกรหัสผ่าน">
                                        <label for="password">รหัสผ่าน</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">บันทึก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <!-- ส่วนแสดงข้อมูล อสม. -->
            <div class="col-md-15">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>ข้อมูล อสม.</h2>
                    <div class="form-floating">
                        <input type="text" id="search" class="form-control" placeholder="ค้นหา...">
                        <label for="search">ค้นหาตาม: ชื่อ, เลขบัตร</label>
                    </div>
                </div>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th style="width: 5%;">ที่</th>
                            <th style="width: 18%;">ชื่อ-นามสกุล</th>
                            <th style="width: 18%;">เลขบัตรประจำตัว</th>
                            <th style="width: 5%;">อายุ</th>
                            <th style="width: 5%;">เพศ</th>
                            <th style="width: 13%;">หมู่บ้านที่ทำงานอยู่</th>
                            <th style="width: 13%;">จำนวนผู้สูงอายุที่ดูแล</th>
                            <th style="width: 5%;">แก้ไข</th>
                            <th style="width: 10%;">ลบ</th>
                            <th style="width: 15%;">รายชื่อผู้สูงอายุ</th>
                        </tr>
                    </thead>
                    <tbody id="volunteerTable">
                        @foreach ($volunteers as $volunteer)
                        <tr class="text-center">
                            <td>{{ $loop->iteration + ($volunteers->currentPage() - 1) * $volunteers->perPage() }}</td>
                            <td class="text-start">{{ $volunteer->titlename }} {{ $volunteer->fullname }}</td>
                            <td>{{ $volunteer->id_card }}</td>
                            <td>{{ \Carbon\Carbon::parse($volunteer->birth_date)->age }} ปี</td>
                            <td>{{ ucfirst($volunteer->gender) }}</td>
                            <td class="text-start">{!! $volunteer->village_name ?? '' !!}</td>
                            <td>{{ $volunteer->elder_count }}</td>

                            <td>
                                <button class="btn btn-sm btn-link p-0" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $volunteer->idchv }}">
                                    <i class="fas fa-pencil-alt text-success"></i>
                                </button>
                            </td>
                            <td>
                                <form action="{{ route('formvolunteer.destroy', $volunteer->idchv) }}" method="POST"
                                    onsubmit="return confirm('คุณต้องการลบข้อมูลนี้?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> ลบ
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('elder.report', ['volunteer_id' => $volunteer->idchv]) }}"
                                    class="btn btn-sm btn-link p-0" title="ดูรายงานผู้สูงอายุ">
                                    <i class="fas fa-eye text-primary"></i>
                                </a>
                            </td>
                        </tr>


                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $volunteer->idchv }}" tabindex="-1"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header  header">
                                        <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูล อสม.</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('formvolunteer.update', $volunteer->idchv) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-container">
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="titlename" name="titlename"
                                                                required>
                                                                <option value="นาย"
                                                                    {{ $volunteer->titlename == 'นาย' ? 'selected' : '' }}>
                                                                    นาย</option>
                                                                <option value="นาง"
                                                                    {{ $volunteer->titlename == 'นาง' ? 'selected' : '' }}>
                                                                    นาง</option>
                                                                <option value="นางสาว"
                                                                    {{ $volunteer->titlename == 'นางสาว' ? 'selected' : '' }}>
                                                                    นางสาว</option>
                                                            </select>
                                                            <label for="titlename">คำนำหน้าชื่อ</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="fullname"
                                                                name="fullname" value="{{ $volunteer->fullname }}"
                                                                required>
                                                            <label for="fullname">ชื่อ-นามสกุล</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="date" class="form-control" id="birth_date"
                                                                name="birth_date" value="{{ $volunteer->birth_date }}"
                                                                required disabled>
                                                            <label for="birth_date">วัน เดือน ปีเกิด</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="age" name="age"
                                                                value="{{ \Carbon\Carbon::parse($volunteer->birth_date)->age }}"
                                                                readonly
                                                                style="background-color: #e9ecef; pointer-events: none;">
                                                            <label for="age">อายุ</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="phone"
                                                                name="phone" value="{{ $volunteer->phone }}" required>
                                                            <label for="phone">เบอร์โทร</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="id_card"
                                                                name="id_card" value="{{ $volunteer->id_card }}"
                                                                required disabled maxlength="13"
                                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                            <label for="id_card">เลขบัตรประชาชน</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="address"
                                                                name="address" value="{{ $volunteer->address }}"
                                                                required>
                                                            <label for="address">ที่อยู่</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <select class="form-control" id="village" name="village"
                                                                required>
                                                                <option value="" disabled selected>เลือกหมู่บ้าน
                                                                </option>
                                                                @if(isset($villages) && count($villages) > 0)
                                                                @foreach ($villages as $village)
                                                                <option value="{{ $village->v_name }}"
                                                                    {{ $village->v_name == $volunteer->village ? 'selected' : '' }}>
                                                                    {{ $village->v_name }}</option>
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
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text"
                                                                class="form-control @error('gender') is-invalid @enderror"
                                                                id="gender" name="gender" value="{{$volunteer->gender}}"
                                                                readonly required>
                                                            <label for="gender">เพศ</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="username"
                                                                name="username" value="{{ $volunteer->username }}"
                                                                required>
                                                            <label for="username">ชื่อผู้ใช้</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="password"
                                                                name="password" 
                                                                title="กรุณากรอกรหัสผ่าน">
                                                            <label for="password">รหัสผ่าน</label>
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
                    </tbody>
                </table>

                <div class="text-center" id="up">
                    แสดง {{ $volunteers->firstItem() }} ถึง {{ $volunteers->lastItem() }} จาก {{ $volunteers->total() }}
                    รายการ
                </div>
                <div class="text-center">
                    <ul class="pagination justify-content-center">
                        <li class="page-item {{ $volunteers->currentPage() == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $volunteers->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @foreach ($volunteers->getUrlRange(1, $volunteers->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $volunteers->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach
                        <li
                            class="page-item {{ $volunteers->currentPage() == $volunteers->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $volunteers->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    let volunteers = @json($volunteers);
    console.log(volunteers);

    document.getElementById('search').addEventListener('input', function() {
        let searchValue = this.value.toLowerCase();

        // ส่ง AJAX request
        fetch(`{{ url('formvolunteerindex') }}?search=${searchValue}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                const volunteers = data.volunteers.data;
                const tbody = document.getElementById('volunteerTable');
                tbody.innerHTML = '';

                volunteers.forEach((volunteer, index) => {
                    const row = `
                        <tr class="text-center">
                            <td>${index + 1 + ((data.pagination.current_page - 1) * data.pagination.per_page)}</td>
                            <td>${volunteer.titlename} ${volunteer.fullname}</td>
                            <td>${volunteer.id_card}</td>
                            <td>${calculateAge(volunteer.birth_date)} ปี</td>
                            <td>${volunteer.gender}</td>
                            <td>${volunteer.village_name || ''}</td>
                            <td>${volunteer.elder_count}</td>
                            <td>
                                <button class="btn btn-sm btn-link p-0" data-bs-toggle="modal" data-bs-target="#editModal${volunteer.idchv}">
                                    <i class="fas fa-pencil-alt text-success"></i>
                                </button>
                            </td>
                            <td>
                                <form action="/formvolunteer/${volunteer.idchv}" method="POST" onsubmit="return confirm('คุณต้องการลบข้อมูลนี้?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> ลบ
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('elder.report', ['volunteer_id' => $volunteer->idchv]) }}" class="btn btn-sm btn-link p-0" title="ดูรายงานผู้สูงอายุ">
                                    <i class="fas fa-eye text-primary"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });

                // อัพเดท pagination
                updatePaginationInfo(data.pagination);
            })
            .catch(error => console.error('Error:', error));
    });


    // เพิ่มฟังก์ชันอัพเดทข้อมูล pagination
    function updatePaginationInfo(pagination) {
        const paginationInfo = document.getElementById('up');
        paginationInfo.innerHTML = `แสดง ${(pagination.current_page - 1) * pagination.per_page + 1} 
                ถึง ${Math.min(pagination.current_page * pagination.per_page, pagination.total)} 
                จาก ${pagination.total} รายการ`;

        // อัพเดท pagination links
        updatePaginationLinks(pagination);
    }

    // เพิ่มฟังก์ชันอัพเดทข้อมูล pagination
    function updatePaginationLinks(pagination) {
        const paginationLinks = document.querySelector('.pagination');
        paginationLinks.innerHTML = '';

        for (let i = 1; i <= pagination.last_page; i++) {
            let pageItem = document.createElement('li');
            pageItem.className = 'page-item';
            if (i === pagination.current_page) {
                pageItem.classList.add('active');
            }
            let pageLink = document.createElement('a');
            pageLink.className = 'page-link';
            pageLink.href = `#`;
            pageLink.textContent = i;
            pageLink.addEventListener('click', function(event) {
                event.preventDefault();
                handlePagination(i);
            });
            pageItem.appendChild(pageLink);
            paginationLinks.appendChild(pageItem);
        }
    }

    // Function to handle pagination dynamically
    function handlePagination(page) {
        let searchValue = document.getElementById('search').value.toLowerCase();
        fetch(`{{ url('formvolunteerindex') }}?page=${page}&search=${searchValue}`)
            .then(response => response.text())
            .then(html => {
                // สร้าง temporary div เพื่อแยกเนื้อหา
                let tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;

                // อัพเดทเฉพาะส่วนของตารางและการแบ่งหน้า
                let tableContainer = document.querySelector('#volunteerTable');
                let paginationInfo = document.querySelector('.text-center');
                let pagination = document.querySelector('.pagination');

                tableContainer.innerHTML = tempDiv.querySelector('#volunteerTable').innerHTML;
                paginationInfo.innerHTML = tempDiv.querySelector('.text-center').innerHTML;
                pagination.innerHTML = tempDiv.querySelector('.pagination').innerHTML;

                // เพิ่ม event listeners ใหม่สำหรับปุ่มแบ่งหน้า
                document.querySelectorAll('.pagination a').forEach(link => {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        let page = this.getAttribute('href').split('page=')[1];
                        handlePagination(page);
                    });
                });
            })
            .catch(error => console.error('Error:', error));
    }
    </script>
</body>

</html>