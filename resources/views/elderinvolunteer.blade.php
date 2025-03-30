<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อผู้สูงอายุและการจัดการ อสม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        .bg-purple {
            background-color: #8e44ad;
            color: white;
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

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        /* .table thead th {
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
            color: white;
            border: none;
        } */

        .btn {
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-success {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(46, 204, 113, 0.2);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.2);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .form-select {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #ddd;
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

        .pagination {
            margin-top: 20px;
        }

        .page-link {
            color: #8e44ad;
            border-radius: 5px;
            margin: 0 2px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
            border: none;
        }
    </style>
</head>

<body>
    @include('layouts.navg')
    <div class="container">
        <div class="form-container">
            <h2 class="header">
                <i class="fas fa-users me-2"></i>
                รายชื่อผู้สูงอายุในหมู่บ้าน
            </h2>

            <form method="GET" action="{{ route('elderinvolunteer') }}" class="mb-4">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="villageInput" name="villageInput" required onchange="this.form.submit()">
                                <option value="" selected>เลือกหมู่บ้าน</option>
                                @foreach ($villages as $village)
                                <option value="{{ $village->v_name }}" {{ request('villageInput') == $village->v_name ? 'selected' : '' }}>
                                    {{ $village->v_name }}
                                </option>
                                @endforeach
                            </select>
                            <label for="villageInput">
                                <i class="fas fa-home me-2"></i>ชื่อหมู่บ้าน
                            </label>
                        </div>
                    </div>
                </div>
            </form>

        @if(request('villageInput'))
            <h3 class="text-center mb-4">หมู่บ้าน: {{ request('villageInput') }}</h3>
        @endif
        
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>รหัสผู้สูงอายุ</th>
                    <th>ชื่อผู้สูงอายุ</th>
                    <th>อายุ</th>
                    <th>หมู่บ้าน</th>
                    <th>ชื่ออสม.ที่ดูแล</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                @if($elders->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">ไม่มีข้อมูลผู้สูงอายุในหมู่บ้านนี้</td>
                </tr>
                @else
                    @foreach ($elders as $elder)
                    <tr class="text-center">
                        <td>{{ ($elders->currentPage() - 1) * $elders->perPage() + $loop->iteration }}</td>
                        <td class="text-start">{{ $elder->titlename }} {{ $elder->fullname }}</td>
                        <td>{{ \Carbon\Carbon::parse($elder->birth_date)->age }} ปี</td>
                        <td class="text-start">{{ $elder->v_name }}</td>
                        <td class="text-start">{{ $elder->chvtitlename }} {{ $elder->chvfullname }}</td>
                        <td>
                            <button class="btn {{ $elder->chvfullname ? 'btn-warning' : 'btn-success' }} btn-add-chv" 
                                data-village-id="{{ $elder->v_id }}" 
                                data-elder-id="{{ $elder->e_id }}"
                                data-idchv="{{ $elder->idchv }}"
                                data-action="{{ $elder->chvfullname ? 'edit' : 'add' }}">
                                {{ $elder->chvfullname ? 'แก้ไข' : 'เพิ่ม อสม' }}
                            </button>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
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

    <!-- Modal -->
    <div class="modal fade" id="addChvModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-plus me-2"></i>
                        เพิ่ม อสม. ให้ผู้สูงอายุ
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="addChvForm">
                        <input type="hidden" id="villageSelect" name="village">
                        <input type="hidden" id="elderId" name="elder_id">
                        <div class="mb-4">
                            <label for="chv" class="form-label">
                                <i class="fas fa-user-nurse me-2"></i>ชื่อ อสม.
                            </label>
                            <select id="chv" name="chv" class="form-select" required></select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-2"></i>บันทึก
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.btn-add-chv').forEach(button => {
            button.addEventListener('click', event => {
                const v_id = button.getAttribute('data-village-id');
                const e_id = button.getAttribute('data-elder-id');
                const action = button.getAttribute('data-action');
                const idchv = button.getAttribute('data-idchv');
                document.getElementById('villageSelect').value = v_id;
                document.getElementById('elderId').value = e_id;

                fetch(`/api/chvin_v/${v_id}`)
                    .then(response => response.json())
                    .then(data => {
                        const chvSelect = document.getElementById('chv');
                        chvSelect.innerHTML = '<option value="" disabled selected>กรุณาเลือก อสม.</option> ';
                        data.forEach(chv => {
                            const option = document.createElement('option');
                            option.value = chv.idchv;
                            option.textContent = `${chv.titlename} ${chv.fullname}`;
                            chvSelect.appendChild(option);
                        });
                        if (idchv) {
                            chvSelect.value = idchv;
                        }
                    }).catch(error => console.error('Error loading CHV:', error));

                new bootstrap.Modal(document.getElementById('addChvModal')).show();
            });
        });

        document.getElementById('addChvForm').addEventListener('submit', event => {
            event.preventDefault();
            const e_id = document.getElementById('elderId').value;
            const selectedChv = document.getElementById('chv').value;
            
            if (!selectedChv) {
                alert('กรุณาเลือก อสม.');
                return;
            }

            fetch('/store-chv-elder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ chv: selectedChv, elder_id: e_id })
            }).then(response => response.json())
              .then(data => {
                if (data.success) {
                    alert(data.success);
                    bootstrap.Modal.getInstance(document.getElementById('addChvModal')).hide();
                    location.reload();
                } else {
                    alert('เกิดข้อผิดพลาด: ' + data.error);
                }
            }).catch(error => console.error('Error submitting CHV:', error));
        });
    </script>
</body>
</html>