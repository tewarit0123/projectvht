<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กำหนด อสม. ให้แต่ละหมู่บ้าน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
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

.card {
    margin-bottom: 20px;
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.card:hover {
    transform: scale(1.05);
}

.card-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

.card-text {
    font-size: 1rem;
    color: #666;
}

.btn-primary {
    background-color: #007bff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-secondary {
    background-color: #6c757d;
    border: none;
}

.btn-secondary:hover {
    background-color: #5a6268;
}
</style>

<body>
    @include('layouts.navg')

    <div class="container">
        <div class="form-container">
            <h2 class="header">รายการหมู่บ้าน</h2>
            <div id="village-list" class="row">
                <!-- Card View ของหมู่บ้าน -->
                @foreach ($villages as $village)
                <div class="col-md-4">
                    <div class="card" data-village="{{ $village->v_name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $village->v_name }}</h5>
                            <p class="card-text">จำนวน อสม. : {{ $village->volunteer}} คน</p>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#manageVolunteersModal" data-village="{{ $village->v_name }}"
                                data-village-id="{{ $village->v_id }}">จัดการ อสม.</button>
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addVolunteerModal"
                                data-village="{{ $village->v_name }}" data-village-id="{{ $village->v_id }}">เพิ่ม
                                อสม.</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal for adding volunteers -->

    <div class="modal fade" id="addVolunteerModal" tabindex="-1" aria-labelledby="addVolunteerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVolunteerModalLabel">เพิ่ม อสม.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>เลือก อสม. สำหรับหมู่บ้าน: <span id="add-village-name"></span></p>
                    <div class="mb-3">
                        <label for="volunteer-select" class="form-label">เลือก อสม.</label>
                        <select id="volunteer-select" class="form-control" style="width: 100%; z-index: 9999;">
                            <option value="" disabled selected>กรุณาเลือก อสม.</option>
                            @foreach ($volunteers as $volunteer)
                            <option value="{{ $volunteer->id_card }}">{{ $volunteer->titlename }}
                                {{ $volunteer->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <button type="button" class="btn btn-primary mt-3" id="saveVolunteerButton">บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#volunteer-select').select2({
            placeholder: "กรุณาเลือก อสม.",
            allowClear: true,
            width: 'resolve',
            dropdownParent: $('#addVolunteerModal') // Ensure the dropdown is rendered inside the modal
        });

        $('#saveVolunteerButton').on('click', function() {
            const selectedValue = $('#volunteer-select').val();
            const villageName = $('#add-village-name').text();
            const v_id = $('#addVolunteerModal').data('village-id');
            console.log('Selected Value:', selectedValue);
            console.log('Village Name:', villageName);
            console.log('Village ID:', v_id);

            if (!selectedValue) {
                alert('กรุณาเลือก อสม.');
                return;
            }

            $.ajax({
                url: '{{ route("chvinvillage.store") }}',
                type: 'POST',
                data: {
                    id_card: selectedValue,
                    v_id: v_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    $('#addVolunteerModal').modal('hide');
                    location.reload(); // Refresh the page after saving
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('เกิดข้อผิดพลาด: ' + xhr.responseJSON.message);
                    console.log(selectedValue + "  " + v_id);
                }
            });
        });

        $('.btn-secondary[data-bs-target="#addVolunteerModal"]').on('click', function() {
            const villageName = $(this).data('village');
            const v_id = $(this).data('village-id');
            $('#add-village-name').text(villageName);
            $('#addVolunteerModal').data('village-id', v_id);
        });
    });
    </script>

    <!-- Modal for managing volunteers -->
    <div class="modal fade" id="manageVolunteersModal" tabindex="-1" aria-labelledby="manageVolunteersModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageVolunteersModalLabel">จัดการ อสม.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>จัดการ อสม. สำหรับหมู่บ้าน: <span id="village-name"></span></p>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 5%;">ที่</th>
                                <th style="width: 25%;">ชื่อ</th>
                                <th style="width: 25%;">เบอร์โทร</th>
                                <th style="width: 20%;">สถานะ</th>
                                <th style="width: 10%;">ย้าย</th>
                            </tr>
                        </thead>
                        <tbody id="volunteer-list">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Script to set the village name in the modal
    document.addEventListener('DOMContentLoaded', function() {
        const manageButtons = document.querySelectorAll('.btn-primary');
        manageButtons.forEach(button => {
            button.addEventListener('click', function() {
                const villageName = this.getAttribute('data-village');
                document.getElementById('village-name').textContent = villageName;
            });
        });

        const addVolunteerButtons = document.querySelectorAll(
            '.btn-secondary[data-bs-target="#addVolunteerModal"]');
        addVolunteerButtons.forEach(button => {
            button.addEventListener('click', function() {
                const villageName = this.getAttribute('data-village');
                document.getElementById('add-village-name').textContent = villageName;
            });
        });
    });

    $('.btn-primary[data-bs-target="#manageVolunteersModal"]').on('click', function() {
        const villageName = $(this).data('village');
        const v_id = $(this).data('village-id');
        $('#village-name').text(villageName);

        $.ajax({
            url: '{{ route("chvinvillage.chvjoin") }}',
            type: 'POST',
            data: {
                v_id: v_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                const volunteerList = $('#volunteer-list');
                volunteerList.empty();

                response[0].forEach((chv, index) => {
                    const statusButton = chv.status ==1 ? 
                        `<button class="btn btn-success change-status" data-id="${chv.id_card}"><i class="fas fa-briefcase"></i> ทำงานอยู่</button>` : 
                        `<button class="btn btn-danger change-status" data-id="${chv.id_card}"><i class="fas fa-times"></i> ไม่ทำงานแล้ว</button>`;

                    const row = `
                            <tr class="text-center">
                                <td>${index + 1}</td>
                                <td class="text-start">${chv.titlename} ${chv.fullname}</td>
                                <td>${chv.phone}</td>
                                <td>${statusButton}</td>


                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="destroy(${chv.id_card})">
                                        ย้าย
                                    </button>
                                </td>
                            </tr>
                        `;
                    volunteerList.append(row);

                    // Add edit modal for each volunteer

                });

                // Change status button functionality
                $('.change-status').on('click', function() {
                    if (confirm('คุณแน่ใจหรือไม่ว่าต้องการเปลี่ยนสถานะของผู้ใช้?')) {
                    const id = $(this).data('id');
                    const isActive = $(this).text().includes('ทำงานอยู่');
                    const newStatus = isActive ? 'ไม่ทำงานแล้ว' : 'ทำงานอยู่';
                    const status = isActive? 0 : 1;
                    const newClass = isActive ? 'btn-danger' : 'btn-success';
                    const newIcon = isActive ? '<i class="fas fa-times"></i>' : '<i class="fas fa-briefcase"></i>';
                    $.ajax({
                    url: '{{ route("chvinvillage.upstatus", [":id", ":status"]) }}'.replace(':id', id).replace(':status', status),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('เกิดข้อผิดพลาด: ' + xhr.responseJSON.message);
                    }
                });

                    $(this).html(`${newIcon} ${newStatus}`).removeClass('btn-success btn-danger').addClass(newClass);
                    // Here you can add an AJAX call to save the status change to the database if needed
                }
                });

            },
            error: function(xhr) {
                console.error(xhr);
                alert('เกิดข้อผิดพลาด: ' + xhr.responseJSON.message);
            }
        });
    });

    function destroy(id) {
        console.log(id);
        if (id) {
            if (confirm('คุณแน่ใจหรือไม่ว่าต้องการย้ายข้อมูลนี้ออก?')) {
                $.ajax({
                    url: '{{ route("chvinvillage.destroy", ":id") }}'.replace(':id', id),
                    type: 'DELETE',
                    data: {
                        id_card: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('เกิดข้อผิดพลาด: ' + xhr.responseJSON.message);
                    }
                });
            }
        } else {
            alert('เกิดข้อผิดพลาด: ID ไม่ถูกต้อง');
        }
    }
    </script>
</body>

</html>