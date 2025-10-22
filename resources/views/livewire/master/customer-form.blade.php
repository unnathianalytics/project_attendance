<div>
    <div class="app-content-header">
       <flux:heading size="xl" level="3">Customer</flux:heading>
       <div class="breadcrumbs text-sm flex justify-between">
            <ul>
                <li><a>Home</a></li>
                <li><a>Customer</a></li>
                <li>List</li>
            </ul>
            <a class="btn btn-sm btn-primary" wire:navigate href="{{ route('customer.index') }}">Cancel</a>
        </div>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 d-none">Customer Form</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Customer Form
                        </li>
                    </ol>
                </div>
            </div>

    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <div class="card-title">Customer Form</div>
                            <div class="card-tools">
                                <a wire:navigate class="btn btn-sm btn-secondary btn-flat float-end"
                                    href="{{ route('customer.index') }}">Cancel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="save">
                                <div class="row">
                                    <div class="col-lg-4 mb-3"><input type="text"
                                            class="form-control form-control-sm" wire:model="name" placeholder="Name"
                                            value="{{ $customer->name ?? '' }}">
                                        @error('name')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 mb-3"> <input type="email"
                                            class="form-control form-control-sm" wire:model="email" placeholder="Email"
                                            value="{{ $customer->email ?? '' }}">
                                        @error('email')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="input-group mb-3">
                                            <input type="number" wire:model="op_balance"
                                                class="text-end form-control form-control-sm">
                                            <select wire:model="cr_dr" class="form-control form-control-sm"
                                                style="max-width: 60px;">
                                                <option selected>Cr/Dr</option>
                                                <option value="Cr">Cr</option>
                                                <option value="Dr">Dr</option>
                                            </select>
                                        </div>
                                        @error('op_balance')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                        @error('cr_dr')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-sm" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">


                </div>
            </div>
        </div>
    </div>
</div>
