<style>
    .app-header {
        background-color: #1E3A8A !important; /* Deep Indigo Blue */
    }

    .app-header .nav-link,
    .app-header .nav-link i,
    .app-header .nav-link span {
        color: #ffffff !important; /* White text/icons */
    }

    .app-header .nav-link:hover {
        background-color: #bbc5d9 !important; /* Darker on hover */
        border-radius: 0.375rem;
    }
</style>

<nav class="app-header navbar navbar-expand">
    <div class="container-fluid">
        <!-- Start Navbar Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>

        <!-- End Navbar Links -->
        <ul class="navbar-nav ms-auto align-items-center">
            <!-- Fullscreen Toggle -->
            <li class="nav-item me-3">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen" title="Toggle Fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>

            <!-- User Info -->
            <li class="nav-item me-3">
                <span class="nav-link fw-semibold">
                    {{ Auth::user()->name ?? 'User' }}
                </span>
            </li>
        </ul>
    </div>
</nav>
