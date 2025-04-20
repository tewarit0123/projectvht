<style>
    .navbar {
        background-color: #e6b3e6;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .nav-link {
        color: #333;
        transition: color 0.3s, background-color 0.3s;
        padding: 10px 15px;
        border-radius: 5px;
    }

    .nav-link:hover {
        color: #333;
        background-color: #E69CE4;
    }

    .nav-link.active {
        background-color: #E69CE4;
        color: #333;
        border: 1px solid #c684c6;
        font-weight: bold;
    }

    .dropdown-menu {
        background-color: #f8f9fa;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        color: #000;
        transition: background-color 0.3s;
    }

    .dropdown-item:hover {
        background-color: #e6b3e6;
        color: #000;
    }

    .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
        color: #333;
    }

    .navbar-toggler {
        border-color: #007bff;
    }

    .navbar-toggler-icon {
        background-color: #007bff;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('formvolunteerindex') ? 'active' : '' }}" href="{{ route('formvolunteerindex') }}">ข้อมูล อสม.</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('formvillageindex') ? 'active' : '' }}" href="{{ route('formvillageindex') }}">ข้อมูลหมู่บ้าน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('formelderlyindex') ? 'active' : '' }}" href="{{ route('formelderlyindex') }}">ข้อมูลผู้สูงอายุ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('chvinvillage') ? 'active' : '' }}" href="{{ route('chvinvillage') }}">กำหนด อสม. ให้แต่ละหมู่บ้าน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor') ? 'active' : '' }}" href="{{ route('doctor') }}">การกำหนด User ให้กับหมอ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('elderinvolunteer') ? 'active' : '' }}" href="{{ route('elderinvolunteer') }}">กำหนดผู้สูงอายุให้ อสม.</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-inline"> | {{ Auth::guard('chv')->user()->fullname }}</div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">โปรไฟล์</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
