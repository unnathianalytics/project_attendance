<aside class="app-sidebar bg-primary-subtle" data-bs-theme="dark">
    <div class="sidebar-brand"> <a wire:navigate href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"> <span
                class="brand-text fw-light">{{ \App\Models\Company::first()->name ?? 'Login' }}</span> </a>

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
                                    Labor
                                    <span
                                        class="nav-badge badge text-bg-secondary me-3">{{ \App\Models\Labor::count() }}</span>
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a wire:navigate href="{{ route('labor.create') }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-record-circle-fill"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item"> <a wire:navigate href="{{ route('labor.index') }}"
                                        class="nav-link"> <i class="nav-icon bi bi-record-circle-fill"></i>
                                        <p>List</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>
                                    Customers
                                    <span
                                        class="nav-badge badge text-bg-secondary me-3">{{ \App\Models\Customer::count() }}</span>
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
                                    <span
                                        class="nav-badge badge text-bg-secondary me-3">{{ \App\Models\Site::count() }}</span>
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
                <li class="nav-header">Transactions</li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle-fill"></i>
                        <p>
                            Attendance
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a wire:navigate href="{{ route('attendance.create') }}"
                                class="nav-link"> <i class="nav-icon bi bi-record-circle-fill"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item"> <a wire:navigate href="{{ route('attendance.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-record-circle-fill"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item"> <a wire:navigate href="{{ route('attendance.employee.create') }}"
                                class="nav-link"> <i class="nav-icon bi bi-record-circle-fill"></i>
                                <p>Employee Attendance</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle-fill"></i>
                        <p>
                            Expense
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a wire:navigate href="{{ route('expense.create') }}"
                                class="nav-link"> <i class="nav-icon bi bi-record-circle-fill"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item"> <a wire:navigate href="{{ route('expense.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-record-circle-fill"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle-fill"></i>
                        <p>
                            Payment
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a wire:navigate href="{{ route('payment.create') }}"
                                class="nav-link"> <i class="nav-icon bi bi-record-circle-fill"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item"> <a wire:navigate href="{{ route('payment.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-record-circle-fill"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle-fill"></i>
                        <p>
                            Receipt
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a wire:navigate href="{{ route('receipt.create') }}"
                                class="nav-link"> <i class="nav-icon bi bi-record-circle-fill"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item"> <a wire:navigate href="{{ route('receipt.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-record-circle-fill"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
