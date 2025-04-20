<x-guest-layout>
    <div class="login-container">
        <h1 class="login-title">เข้าสู่ระบบ</h1>
        
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Error!</strong>
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <div class="d-flex justify-content-center gap-4 text-black">
                    <div class="form-check">
                        <input type="radio" id="type_osm" name="user_type" value="osm" class="form-check-input" required onclick="toggleLoginFields('osm')">
                        <label class="form-check-label" for="type_osm">อสม.</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="type_elderly" name="user_type" value="elderly" class="form-check-input" onclick="toggleLoginFields('elderly')">
                        <label class="form-check-label" for="type_elderly">ผู้สูงอายุ</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="type_doctor" name="user_type" value="doctor" class="form-check-input" onclick="toggleLoginFields('doctor')">
                        <label class="form-check-label" for="type_doctor">คุณหมอ</label>
                    </div>
                </div>
            </div>

            <div id="normal_login_fields">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="text" id="username" name="username" class="form-control" placeholder="ชื่อผู้ใช้งาน" required>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
                    </div>
                </div>
            </div>

            <div id="elderly_login_fields" class="hidden">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-id-card"></i>
                        </span>
                        <input type="text" id="id_card" name="id_card" class="form-control" placeholder="เลขบัตรประชาชน" maxlength="13">
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-login">
                    Login
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleLoginFields(userType) {
            const normalFields = document.getElementById('normal_login_fields');
            const elderlyFields = document.getElementById('elderly_login_fields');
            
            if (userType === 'elderly') {
                normalFields.classList.add('hidden');
                elderlyFields.classList.remove('hidden');
                document.getElementById('id_card').required = true;
                document.getElementById('username').required = false;
                document.getElementById('password').required = false;
            } else {
                normalFields.classList.remove('hidden');
                elderlyFields.classList.add('hidden');
                document.getElementById('id_card').required = false;
                document.getElementById('username').required = true;
                document.getElementById('password').required = true;
            }
        }
    </script>
</x-guest-layout>
