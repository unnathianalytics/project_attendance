<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand"> <a wire:navigate href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"> <span class="brand-text fw-light">AdminLTE 4</span> </a>

    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a wire:navigate href="{{ route('dashboard') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Dashboard v1</p>
                            </a> </li>
                    </ul>
                </li>
                <li class="nav-header">Administration</li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle-fill"></i>
                        <p>
                            Masters
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>
                                    Customers
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a wire:navigate href="{{ route('customer.create') }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-record-circle-fill"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item"> <a wire:navigate href="{{ route('customer.index') }}"
                                        class="nav-link"> <i class="nav-icon bi bi-record-circle-fill"></i>
                                        <p>List</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>
                                    Sites
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a wire:navigate href="{{ route('site.create') }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-record-circle-fill"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item"> <a wire:navigate href="{{ route('site.index') }}"
                                        class="nav-link"> <i class="nav-icon bi bi-record-circle-fill"></i>
                                        <p>List</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Level 2</p>
                            </a> </li>
                    </ul>
                </li>
                <li class="nav-item"> <a href="../generate/theme.html" class="nav-link"> <i
                            class="nav-icon bi bi-palette"></i>
                        <p>Theme Generate</p>
                    </a> </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Widgets
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="../widgets/small-box.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Small Box</p>
                            </a> </li>
                        <li class="nav-item"> <a href="../widgets/info-box.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>info Box</p>
                            </a> </li>
                        <li class="nav-item"> <a href="../widgets/cards.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Cards</p>
                            </a> </li>
                    </ul>
                </li>

                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-tree-fill"></i>
                        <p>
                            UI Elements
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="../UI/general.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>General</p>
                            </a> </li>
                        <li class="nav-item"> <a href="../UI/icons.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Icons</p>
                            </a> </li>
                        <li class="nav-item"> <a href="../UI/timeline.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Timeline</p>
                            </a> </li>
                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i
                            class="nav-icon bi bi-pencil-square"></i>
                        <p>
                            Forms
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="../forms/general.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>General Elements</p>
                            </a> </li>
                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-table"></i>
                        <p>
                            Tables
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="../tables/simple.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Simple Tables</p>
                            </a> </li>
                    </ul>
                </li>
                <li class="nav-header">EXAMPLES</li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i
                            class="nav-icon bi bi-box-arrow-in-right"></i>
                        <p>
                            Auth
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="#" class="nav-link"> <i
                                    class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Version 1
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="../examples/login.html" class="nav-link"> <i
                                            class="nav-icon bi bi-circle"></i>
                                        <p>Login</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="../examples/register.html" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Register</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i
                                    class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Version 2
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="../examples/login-v2.html" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Login</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="../examples/register-v2.html" class="nav-link"> <i
                                            class="nav-icon bi bi-circle"></i>
                                        <p>Register</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="../examples/lockscreen.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Lockscreen</p>
                            </a> </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
