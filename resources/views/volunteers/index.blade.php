<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลผู้สูงอายุ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .btn-add {
            background-color: #8080ff;
            color: white;
        }

        .btn-add:hover {
            background-color: #6666ff;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e6b3e6;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('formvolunteerindex')}}">ข้อมูล อสม.</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('formvillageindex')}}">ข้อมูลหมู่บ้าน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('formelderlyindex')}}">กรอกข้อมูลผู้สูงอายุ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="path_to_profile_image.jpg" alt="Profile" class="rounded-circle" width="32" height="32">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">โปรไฟล์</a></li>
                            <li><a class="dropdown-item" href="#">ตั้งค่า</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">ออกจากระบบ</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3 ">
            <h2>ข้อมูลผู้สูงอายุ</h2>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th style="width: 5%;">ที่</th>
                    <th style="width: 25%;">ชื่อ-นามสกุล</th>
                    <th style="width: 30%;">เลขบัตรประจำตัว</th>
                    <th style="width: 8%;">อายุ</th>
                    <th style="width: 8%;">เพศ</th>
                    <th style="width: 10%;">แก้ไข</th>
                    <th style="width: 15%;">สถานะ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($volunteers as $index => $volunteer)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $volunteer->fullname }}</td>
                    <td>{{ $volunteer->national_id }}</td>
                    <td>{{ $volunteer->calculated_age }}</td>
                    <td>{{ $volunteer->gender }}</td>
                    <td class="text-center">
                        <a href="{{ route('volunteers.edit', $volunteer->id) }}" class="btn btn-sm btn-link p-0">
                            <i class="fas fa-pencil-alt text-success"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="status-checkbox" data-id="{{ $volunteer->id }}" {{ $volunteer->status ? 'checked' : '' }}>
                        <label for="status">เสียชีวิต</label>
                    </td>
                </tr>
                <!-- <td class="text-center">
                            <form action="{{ route('volunteers.destroy', $volunteer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-link p-0" onclick="return confirm('Are you sure you want to delete this item?');">
                                    <i class="fas fa-trash-alt text-danger"></i>
                                </button>
                            </form>
                        </td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.querySelectorAll('.status-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var id = this.getAttribute('data-id');
            var status = this.checked ? 1 : 0;
            var row = this.closest('tr'); // ค้นหาแถวที่ checkbox อยู่

            // แสดงป๊อปอัปยืนยัน
            var confirmation = confirm('คุณต้องการอัปเดตสถานะหรือไม่?');
            
            if (confirmation) {
                // ถ้าผู้ใช้กดยืนยัน ส่งค่า status ไปยังเซิร์ฟเวอร์
                fetch(`/volunteers/${id}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status: status })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('สถานะถูกอัปเดตเรียบร้อยแล้ว');
                        
                        if (status === 1) {
                            // ลบแถวออกจากตารางถ้าสถานะถูกเปลี่ยนเป็น 1
                            row.remove();
                        }
                    } else {
                        alert('เกิดข้อผิดพลาดในการอัปเดตสถานะ');
                    }
                });
            } else {
                // ถ้าผู้ใช้ยกเลิกการเปลี่ยนแปลง ให้ทำการคืนค่า checkbox กลับไปเป็นสถานะเดิม
                this.checked = !status;
            }
        });
    });
    </script>
</body>

</html>