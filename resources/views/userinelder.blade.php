<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กำหนด User สำหรับผู้ดูแลผู้สูงอายุ</title>
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
            <h2 class="header">ฟอร์มกำหนด User สำหรับผู้ดูแลผู้สูงอายุ</h2>
            @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
            @endif
            <form action="{{ route('userinelder.store') }}" method="POST" onsubmit="return validateForm()">
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

        <!-- New section for displaying user data -->
        <div class="row mt-5">
            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>ข้อมูลผู้ดูแลผู้สูงอายุ</h2>
                    <div class="form-floating">
                        <input type="text" id="search" class="form-control" placeholder="ค้นหา...">
                        <label for="search">ค้นหาตาม: ชื่อ, เลขบัตร</label>
                    </div>
                </div>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr class="text-center" >
                            <th style="width: 5%;">ที่</th>
                            <th style="width: 25%;">ชื่อ-นามสกุล</th>
                            <th style="width: 20%;">เลขบัตรประชาชน</th>
                            <th style="width: 20%;">ชื่อผู้ใช้</th>
                            <th style="width: 10%;">แก้ไข</th>
                            <th style="width: 10%;">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <!-- <td>{{ $user->u_id }}</td> -->
                            <td class="text-start">{{ $user->fullname }}</td>
                            <td>{{ $user->id_card }}</td>
                            <td class="text-start">{{ $user->username }}</td>
                            <td>
                                <button class="btn btn-sm btn-link p-0" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $user->u_id }}">
                                    <i class="fas fa-pencil-alt text-success"></i>
                                </button>
                            </td>
                            <td>
                                <form action="{{ route('userinelder.destroy', $user->u_id) }}" method="POST"
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
                        <div class="modal fade" id="editModal{{ $user->u_id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->u_id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header header">
                                        <h5 class="modal-title" id="editModalLabel{{ $user->u_id }}">แก้ไขข้อมูลผู้ดูแล</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('userinelder.update', $user->u_id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="fullname{{ $user->u_id }}" name="fullname" value="{{ $user->fullname }}" required>
                                                <label for="fullname{{ $user->u_id }}">ชื่อ-นามสกุล</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="id_card{{ $user->u_id }}" name="id_card" value="{{ $user->id_card }}" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                <label for="id_card{{ $user->u_id }}">เลขบัตรประชาชน</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="username{{ $user->u_id }}" name="username" value="{{ $user->username }}" required>
                                                <label for="username{{ $user->u_id }}">ชื่อผู้ใช้</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="password{{ $user->u_id }}" name="password" pattern="\d{6}" maxlength="6"  title="กรุณากรอกรหัสผ่าน 6 หลัก">
                                                <label for="password{{ $user->u_id }}">รหัสผ่าน</label>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-success">อัพเดท</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Edit Modal -->
                        
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    แสดง {{ $users->firstItem() }} ถึง {{ $users->lastItem() }} จาก {{ $users->total() }} รายการ
                </div>
                <div class="text-center">
                    <ul class="pagination justify-content-center">
                        <li class="page-item {{ $users->currentPage() == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach
                        <li class="page-item {{ $users->currentPage() == $users->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- แก้ไขส่วน scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>