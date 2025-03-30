<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลหมู่บ้าน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
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

        .btn-danger {
            background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.2);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            transform: translateY(-2px);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        /* .table thead th {
            background: #9b59b6 100%;
            color: white;
            font-weight: 500;
            border: none;
            padding: 15px;
        } */

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .form-floating .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 15px;
            height: calc(3.5rem + 2px);
            line-height: 1.25;
        }

        .form-floating label {
            padding: 1rem;
        }

        .search-container {
            position: relative;
            margin-bottom: 20px;
        }

        .search-container .form-control {
            padding-right: 40px;
            border-radius: 25px;
            border: 1px solid #ced4da;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
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

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
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

        .btn-link {
            color: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
            text-decoration: none;
        }

        .btn-link:hover {
            color: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
        }
    </style>
</head>

<body>
    @include('layouts.navg')

    <div class="container mt-5">
        <div class="row">
            <!-- ส่วนฟอร์มกรอกข้อมูล -->
            <div class="col-md-4">
                <div class="form-container">
                    <h2 class="header">ฟอร์มกรอกข้อมูลหมู่บ้าน</h2>
                    @if(session('success'))
                    <div style="color: green;">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form
                        action="{{ isset($editVillage) ? route('formvillage.update', ['v_id' => $editVillage->v_id]) : route('formvillageindex.store') }}"
                        method="POST">
                        @csrf
                        @if(isset($editVillage))
                        @method('PUT')
                        @endif
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ isset($editVillage) ? $editVillage->v_name : '' }}" required>
                            <label for="name">ชื่อหมู่บ้าน</label>
                        </div>
                        <button type="submit"
                            class="btn btn-success">{{ isset($editVillage) ? 'อัพเดท' : 'บันทึก' }}</button>
                        @if(isset($editVillage))
                        <a href="{{ route('formvillageindex') }}" class="btn btn-secondary">ยกเลิก</a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- ส่วนแสดงข้อมูล -->
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>ข้อมูลหมู่บ้าน</h2>
                    <form action="{{ route('formvillageindex') }}" method="GET" class="form-floating">
                        <input type="text" id="search" class="form-control" placeholder="ค้นหา..." name="search" value="{{ request('search') }}" oninput="this.form.submit()">
                        <label for="search">ค้นหาตาม: หมู่บ้าน</label>
                    </form>
                </div>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th style="width: 5%;">ที่</th>
                            <th style="width: 10%;">ชื่อ</th>
                            <th style="width: 10%;">แก้ไข</th>
                            <th style="width: 15%;">ลบ</th>
                        </tr>
                    </thead>
                    @foreach ($villages as $village)
                    <tr class="text-center">
                        <td>{{ $loop->iteration + ($villages->currentPage() - 1) * $villages->perPage() }}</td>
                        <td class="text-start">{{ $village->v_name }}</td>
                        <td>
                            <button class="btn btn-sm btn-link p-0" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $village->v_id }}">
                                <i class="fas fa-pencil-alt text-success"></i>
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('formvillageindex.destroy', ['v_id' => $village->v_id]) }}"
                                method="POST" onsubmit="return confirm('คุณต้องการลบข้อมูลนี้?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> ลบ
                                </button>
                            </form>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $village->v_id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $village->v_id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header header">
                                            <h5 class="modal-title" id="editModalLabel{{ $village->v_id }}">แก้ไขข้อมูลหมู่บ้าน
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('formvillage.update', ['v_id' => $village->v_id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $village->v_name }}" required>
                                                    <label for="name">ชื่อหมู่บ้าน</label>
                                                </div>
                                                <button type="submit" class="btn btn-success">อัพเดท</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <div class="text-center" style="position: absolute; bottom: 20px; left: 62%; transform: translateX(-50%);">
                    <div>
                        แสดง {{ $villages->firstItem() }} ถึง {{ $villages->lastItem() }} จาก {{ $villages->total() }} รายการ
                    </div>
                    <ul class="pagination justify-content-center">
                        <li class="page-item {{ $villages->currentPage() == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $villages->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @foreach ($villages->getUrlRange(1, $villages->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $villages->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach
                        <li class="page-item {{ $villages->currentPage() == $villages->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $villages->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>