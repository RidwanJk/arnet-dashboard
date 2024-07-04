<aside class="bd-sidebar">
    <div class="offcanvas-lg offcanvas-start text-bg-dark pb-5" id="sidebar">
        <!-- SIDEBAR HEADER -->
        <div class="sidebar-header p-3 position-sticky top-0 bg-dark z-3 d-block d-lg-none">
            <div class="text-end">
                <button type="button" class="btn btn-dark" data-bs-dismiss="offcanvas" data-bs-target="#sidebar">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>
        <!-- END OF SIDEBAR HEADER -->

        <!-- LOGO -->
        <div class="p-3 text-center">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/img/LOGO_PANJANG.png') }}" alt="LOGO TRANSPARAN" class="img-fluid rectangular-logo">
                <img src="{{ asset('assets/img/LOGO BULAT.png') }}" alt="LOGO BULAT TRANSPARAN" width="50" class="dark-mode-logo">
            </a>
        </div>

        <!-- SIDEBAR BODY -->
        <div class="sidebar-body mb-3">
            <div class="accordion accordion-flush">
                <!-- ADMIN MENU -->
                <div class="accordion-item text-bg-dark border-0">
                    <!-- ADMIN MENU HEADER -->
                    <div class="accordion-header px-3">
                        <button class="accordion-button text-bg-dark shadow-none p-0 py-3" type="button"
                                data-bs-toggle="collapse" data-bs-target="#submenu-admin">
                            ADMIN
                        </button>
                    </div>
                    <!-- ADMIN SUBMENU -->
                    <div id="submenu-admin" class="accordion-collapse collapse show">
                        <div class="accordion-body p-0 px-3">
                            <div class="list-group list-group-flush">
                                <a href="{{ url('/') }}" class="list-group-item list-group-item-action border-0 mb-1 text-bg-dark active"
                                   data-bs-placement="right" data-bs-title="Dashboard">
                                    <i class="bi bi-speedometer me-3"></i>
                                    <span class="submenu-title">Dashboard</span>
                                </a>
                                <a href="{{ url('/table') }}" class="list-group-item list-group-item-action border-0 mb-1 text-bg-dark"
                                   data-bs-placement="right" data-bs-title="Table">
                                    <i class="bi bi-table me-3"></i>
                                    <span class="submenu-title">Table</span>
                                </a>
                                <a href="{{ url('/form') }}" class="list-group-item list-group-item-action border-0 mb-1 text-bg-dark"
                                   data-bs-placement="right" data-bs-title="Form">
                                    <i class="bi bi-input-cursor me-3"></i>
                                    <span class="submenu-title">Form</span>
                                </a>
                                <a href="{{ url('/settings') }}" class="list-group-item list-group-item-action border-0 mb-1 text-bg-dark"
                                   data-bs-placement="right" data-bs-title="Settings">
                                    <i class="bi bi-gear me-3"></i>
                                    <span class="submenu-title">Settings</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END OF ADMIN SUBMENU -->
                </div>
                <!-- END OF ADMIN MENU -->
                <!-- Additional menus like PAGES MENU, ERRORS MENU, etc. can be added here in a similar fashion -->
            </div>
        </div>
        <!-- END OF SIDEBAR BODY -->
    </div>
</aside>
