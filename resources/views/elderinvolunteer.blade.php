<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อผู้สูงอายุและการจัดการ อสม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('layouts.navg')
    <div class="container mt-5">
        <h2 class="text-center mb-4">รายชื่อผู้สูงอายุในหมู่บ้าน</h2>
        <form method="GET" action="{{ route('elderinvolunteer') }}">
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="villageInput" name="villageInput" required onchange="this.form.submit()">
                            <option value="" selected>เลือกหมู่บ้าน</option>
                            @foreach ($villages as $village)
                            <option value="{{ $village->v_name }}" {{ request('villageInput') == $village->v_name ? 'selected' : '' }}>{{ $village->v_name }}</option>
                            @endforeach
                        </select>
                        <label for="villageInput">ชื่อหมู่บ้าน</label>
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
                        <td>{{ $loop->iteration }}</td>
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

    <div class="modal fade" id="addChvModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่ม อสม. ให้ผู้สูงอายุ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addChvForm">
                        <input type="hidden" id="villageSelect" name="village">
                        <input type="hidden" id="elderId" name="elder_id">
                        <div class="mb-3">
                            <label for="chv">ชื่อ อสม.</label>
                            <select id="chv" name="chv" class="form-control" required></select>
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
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