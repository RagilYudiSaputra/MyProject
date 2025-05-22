<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>@yield('title', 'To-Do List')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    body {
      margin: 0;
      display: flex;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #212529;
    }

    #sidebar {
      width: 240px;
      height: 100vh;
      background: #343a40;
      color: #ddd;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      overflow-y: auto;
      box-shadow: 3px 0 8px rgba(0, 0, 0, 0.1);
      transition: margin-left 0.3s ease;
      z-index: 1040;
      display: flex;
      flex-direction: column;
    }

    #sidebar h3 {
      color: #fff;
      margin-bottom: 1.5rem;
      text-transform: uppercase;
      user-select: none;
    }

    #sidebar a {
      color: #ddd;
      display: block;
      padding: 12px 18px;
      margin-bottom: 8px;
      border-radius: 6px;
      font-weight: 500;
      text-decoration: none;
      transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
    }

    #sidebar a:hover {
      background-color: #495057;
      color: #fff;
      transform: translateX(6px);
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
    }

    #sidebar a.active {
      background-color: #0d6efd;
      color: #fff;
      font-weight: 600;
      box-shadow: 0 3px 8px rgba(13, 110, 253, 0.6);
    }

    #content {
      margin-left: 240px;
      padding: 30px 40px;
      width: calc(100% - 240px);
      min-height: 100vh;
      background-color: #fff;
      transition: margin-left 0.3s ease, width 0.3s ease;
      position: relative;
    }

    #sidebar .dropdown-toggle {
      background-color: #343a40;
      color: #ddd;
      border: none;
      padding: 12px 18px;
      text-align: left;
      width: 100%;
      border-radius: 6px;
      font-weight: 500;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    #sidebar .dropdown-menu {
      background-color: #343a40;
      border: none;
      padding: 0;
      margin-top: 6px;
    }

    #sidebar .dropdown-menu .dropdown-item {
      color: #ddd;
      padding: 12px 18px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    #sidebar .dropdown-menu .dropdown-item:hover {
      background-color: #495057;
      color: white;
    }

    #sidebar .dropdown-toggle.active,
    #sidebar .dropdown-menu .dropdown-item.active {
      background-color: #0d6efd;
      color: white;
      font-weight: 600;
      box-shadow: 0 3px 8px rgba(13, 110, 253, 0.6);
    }

    .logout-item {
      color: #dc3545;
      background-color: transparent;
      text-align: left;
      display: inline-block;
      padding: 10px 16px;
      border-radius: 6px;
      font-weight: 500;
      text-decoration: none;
      transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
      max-width: 200px;
      white-space: nowrap;
    }

    .logout-item:hover {
      background-color: #dc3545;
      color: white;
      transform: translateX(6px);
      box-shadow: 0 3px 8px rgba(220, 53, 69, 0.4);
    }

    .avatar-btn {
      border: none;
      background: none;
      padding: 0;
      display: flex;
      justify-content: center;
      width: 100%;
      text-align: center;
      margin-top: auto;
      cursor: pointer;
    }

    .avatar-img {
      display: inline-block;
      width: 64px;
      height: 64px;
      border-radius: 50%;
      border: 2px solid #fff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #sidebar form button.btn-danger {
      border-radius: 6px;
      font-weight: 600;
      padding: 10px 0;
      transition: background-color 0.3s ease;
    }

    #sidebar form button.btn-danger:hover {
      background-color: #b02a37;
    }

    /* Sidebar hidden */
    .sidebar-hidden #sidebar {
      margin-left: -240px;
    }

    .sidebar-hidden #content {
      margin-left: 0;
      width: 100%;
    }

    /* Tombol toggle sidebar */
    #sidebarToggleClose {
      position: absolute;
      top: 12px;
      right: 12px;
      background: transparent;
      border: none;
      color: #ddd;
      font-size: 1.5rem;
      cursor: pointer;
      transition: color 0.3s ease;
    }

    #sidebarToggleClose:hover {
      color: #fff;
    }

    #sidebarToggleOpen {
      position: fixed;
      top: 12px;
      left: 12px;
      background: #0d6efd;
      border: none;
      color: white;
      font-size: 1.5rem;
      border-radius: 6px;
      padding: 6px 10px;
      cursor: pointer;
      box-shadow: 0 3px 8px rgba(13, 110, 253, 0.6);
      z-index: 1050;
      display: none;
      transition: background-color 0.3s ease;
    }

    #sidebarToggleOpen:hover {
      background-color: #0b5ed7;
    }

    /* Tampilkan tombol buka sidebar hanya saat sidebar tersembunyi */
    .sidebar-hidden #sidebarToggleOpen {
      display: block;
    }
  </style>
</head>

<body>

  <div id="sidebar">
    <!-- Tombol tutup sidebar -->
    <button id="sidebarToggleClose" aria-label="Tutup sidebar" title="Tutup sidebar">
      <i class="bi bi-x"></i>
    </button>

    <h3>To Do List</h3>

    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <i class="bi bi-house-door me-2"></i> Dashboard
    </a>

    <a href="{{ route('tugas.index') }}" class="{{ request()->routeIs('tugas.index') && !request('status') ? 'active' : '' }}">
      <i class="bi bi-list-task me-2"></i> Semua Tugas
    </a>

    @php
      $statusAktif = in_array(request('status'), ['Menunggu', 'Sedang Dikerjakan', 'Selesai', 'Batal']);
    @endphp

    <div class="dropdown mb-2">
      <button
        class="btn dropdown-toggle w-100 text-start {{ $statusAktif ? 'active' : '' }}"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        <i class="bi bi-tags me-2"></i> Status Tugas
      </button>
      <ul class="dropdown-menu w-100">
        <li><a class="dropdown-item {{ request('status') == 'Menunggu' ? 'active' : '' }}" href="{{ route('tugas.index', ['status' => 'Menunggu']) }}">Menunggu</a></li>
        <li><a class="dropdown-item {{ request('status') == 'Sedang Dikerjakan' ? 'active' : '' }}" href="{{ route('tugas.index', ['status' => 'Sedang Dikerjakan']) }}">Sedang Dikerjakan</a></li>
        <li><a class="dropdown-item {{ request('status') == 'Selesai' ? 'active' : '' }}" href="{{ route('tugas.index', ['status' => 'Selesai']) }}">Selesai</a></li>
        <li><a class="dropdown-item {{ request('status') == 'Batal' ? 'active' : '' }}" href="{{ route('tugas.index', ['status' => 'Batal']) }}">Batal</a></li>
      </ul>
    </div>

    <a href="{{ route('tugas.create') }}" class="{{ request()->routeIs('tugas.create') ? 'active' : '' }}">
      <i class="bi bi-plus-circle me-2"></i> Tambah Tugas
    </a>

    @auth
      <hr style="border-color: #495057; margin-top: 1.5rem; margin-bottom: 1rem;" />

      <!-- Avatar dropdown -->
      <div class="dropdown mt-3 text-center" style="margin-top:auto;">
        <button
          class="avatar-btn dropdown-toggle p-0 border-0 bg-transparent"
          type="button"
          id="profileDropdown"
          data-bs-toggle="dropdown"
          aria-expanded="false"
          aria-haspopup="true"
        >
          <img
            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6c757d&color=fff"
            alt="Avatar"
            class="avatar-img"
          />
        </button>

        <ul
          class="dropdown-menu dropdown-menu-dark text-start mt-2"
          aria-labelledby="profileDropdown"
          style="min-width: 220px;"
        >
          <li class="px-3 py-2 text-white">
            <strong>{{ Auth::user()->name }}</strong><br />
            <small>{{ Auth::user()->email }}</small>
          </li>
          <li>
            <hr class="dropdown-divider" style="border-color: #495057;" />
          </li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="logout-item w-100 text-start">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    @endauth
  </div>

  <!-- Tombol buka sidebar -->
  <button id="sidebarToggleOpen" aria-label="Buka sidebar" title="Buka sidebar">
    <i class="bi bi-list"></i>
  </button>

  <div id="content">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const body = document.body;
    const btnClose = document.getElementById('sidebarToggleClose');
    const btnOpen = document.getElementById('sidebarToggleOpen');

    btnClose.addEventListener('click', () => {
      body.classList.add('sidebar-hidden');
    });

    btnOpen.addEventListener('click', () => {
      body.classList.remove('sidebar-hidden');
    });
  </script>

</body>
</html>
