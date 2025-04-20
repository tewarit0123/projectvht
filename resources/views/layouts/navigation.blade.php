<!-- Navigation -->
<style>
    .navbar {
        background: linear-gradient(135deg, #E69CE4 0%, #c684c6 100%);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .nav-link {
        color: #fff;
        transition: color 0.3s, background-color 0.3s;
        padding: 10px 15px;
        border-radius: 5px;
        background: none;
        border: none;
    }

    .nav-link:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        border: 1px solid #fff;
        font-weight: bold;
    }

    .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
        color: black;
        font-family: 'Kanit', sans-serif;
    }

    .navbar-toggler {
        border: none;
    }

    .navbar-toggler-icon {
        color: #fff;
    }
</style>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center">
            <span>สุขภาพดีมี อสม.</span>
        </a>

        <!-- Hamburger Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navigation Items -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link">
                            <i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>