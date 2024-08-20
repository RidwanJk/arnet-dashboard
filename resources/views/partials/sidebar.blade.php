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
            <a href="{{ url('img/LOGO BULAT.png') }}">
                <img src="{{ asset('img/LOGO_PANJANG.png') }}" alt="LOGO TRANSPARAN" class="img-fluid rectangular-logo"
                    width="150" height="50">
                <img src="{{ asset('img/LOGO BULAT.png') }}" alt="LOGO BULAT TRANSPARAN" width="50"
                    class="dark-mode-logo">
            </a>
        </div>

        <!-- SIDEBAR BODY -->
        <div class="sidebar-body mb-3">
            <div class="accordion accordion-flush">
                <!-- ADMIN MENU -->
                <div class="accordion-item text-bg-dark border-0">
                    <!-- ADMIN MENU HEADER -->
                    <div class="accordion-header px-3">
                        @if(Auth::check() && Auth::user()->role != 1)
                            <button class="accordion-button text-bg-dark shadow-none p-0 py-3" type="button"
                                data-bs-toggle="collapse" data-bs-target="#submenu-admin">
                                ADMIN
                            </button>
                        @else
                            <button class="accordion-button text-bg-dark shadow-none p-0 py-3" type="button"
                                data-bs-toggle="collapse" data-bs-target="#submenu-admin">
                                USER
                            </button>
                        @endif
                    </div>
                    <!-- ADMIN SUBMENU -->
                    <div id="submenu-admin" class="accordion-collapse collapse show">
                        <div class="accordion-body p-0 px-3">
                            <div class="list-group list-group-flush">
                                <!-- DOCUMENT SUBMENU -->
                                <button class="accordion-button text-bg-dark shadow-none p-0 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#submenu-document">
                                    <i class="bi bi-file-earmark-text me-3"></i>
                                    <span class="submenu-title">Document</span>
                                </button>
                                <div id="submenu-document" class="collapse show ms-3"> <!-- Added show class -->
                                    <a href="{{ url('/denah') }}"
                                        class="list-group-item list-group-item-action border-0 mb-1 text-bg-dark {{ Request::is('denah') ? 'active' : '' }}">
                                        <i class="bi bi-diagram-3 me-3"></i>
                                        <span class="submenu-title">STO Layout</span>
                                    </a>
                                    <a href="{{ url('/document') }}"
                                        class="list-group-item list-group-item-action border-0 mb-1 text-bg-dark {{ Request::is('document') ? 'active' : '' }}">
                                        <i class="bi bi-envelope me-3"></i>
                                        <span class="submenu-title">Scrapping Document</span>
                                    </a>
                                </div>

                                <!-- UNIT INFRASTRUCTURE SUBMENU -->
                                <button class="accordion-button text-bg-dark shadow-none p-0 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#submenu-network">
                                    <i class="bi bi-building me-3"></i>
                                    <span class="submenu-title">Unit Infrastructure</span>
                                </button>
                                <div id="submenu-network" class="collapse show ms-3"> <!-- No show class for default collapse -->
                                    <a href="{{ url('/sto') }}"
                                        class="list-group-item list-group-item-action border-0 mb-1 text-bg-dark {{ Request::is('sto') ? 'active' : '' }}">
                                        <i class="bi bi-hdd-network me-3"></i>
                                        <span class="submenu-title">STO</span>
                                    </a>
                                    <a href="{{ url('/room') }}"
                                        class="list-group-item list-group-item-action border-0 mb-1 text-bg-dark {{ Request::is('room') ? 'active' : '' }}">
                                        <i class="bi bi-cpu me-3"></i>
                                        <span class="submenu-title">Room</span>
                                    </a>
                                </div>

                                <!-- POTENTIAL SUBMENU -->
                                <button class="accordion-button text-bg-dark shadow-none p-0 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#submenu-potential">
                                    <i class="bi bi-lightning me-3"></i>
                                    <span class="submenu-title">Potential</span>
                                </button>
                                <div id="submenu-potential" class="collapse show ms-3"> <!-- No show class for default collapse -->
                                    <a href="{{ url('/core') }}"
                                        class="list-group-item list-group-item-action border-0 mb-1 text-bg-dark {{ Request::is('core') ? 'active' : '' }}">
                                        <i class="bi bi-modem me-3"></i>
                                        <span class="submenu-title">Core Potential</span>
                                    </a>
                                    <a href="{{ url('/cme') }}"
                                        class="list-group-item list-group-item-action border-0 mb-1 text-bg-dark {{ Request::is('cme') ? 'active' : '' }}">
                                        <i class="bi bi-cpu me-3"></i>
                                        <span class="submenu-title">CME Potential</span>
                                    </a>
                                </div>

                                <!-- USER MANAGEMENT SUBMENU -->
                                <button class="accordion-button text-bg-dark shadow-none p-0 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#submenu-user">
                                    <i class="bi bi-person me-3"></i>
                                    <span class="submenu-title">User Management</span>
                                </button>
                                <div id="submenu-user" class="collapse show ms-3"> <!-- No show class for default collapse -->
                                    @if(Auth::check() && Auth::user()->role != 1)
                                        <a href="{{ url('/viewuser') }}"
                                            class="list-group-item list-group-item-action border-0 mb-1 text-bg-dark {{ Request::is('viewuser') ? 'active' : '' }}">
                                            <i class="bi bi-person me-3"></i>
                                            <span class="submenu-title">Manage Users</span>
                                        </a>
                                    @endif
                                    <a href="{{ route('logout') }}"
                                        class="list-group-item list-group-item-action border-0 mb-1 text-bg-dark {{ Request::is('logout') ? 'active' : '' }}">
                                        <i class="bi bi-box-arrow-left me-3"></i>
                                        <span class="submenu-title">Logout</span>
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