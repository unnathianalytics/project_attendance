<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 d-none">Labor Form</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Labor Form
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <div class="card-title">Labor Form</div>
                            <div class="card-tools">
                                <a wire:navigate class="btn btn-sm btn-secondary btn-flat float-end"
                                    href="{{ route('labor.index') }}">Cancel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="save">
                                <div class="row">
                                    <div class="col-lg-4 mb-3"><input type="text"
                                            class="form-control form-control-sm" wire:model="name" placeholder="Name"
                                            value="{{ $labor->name ?? '' }}">
                                        @error('name')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 mb-3"> <input type="email"
                                            class="form-control form-control-sm" wire:model="email" placeholder="Email"
                                            value="{{ $labor->email ?? '' }}">
                                        @error('email')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 mb-3"> <input type="password"
                                            class="form-control form-control-sm" wire:model="password"
                                            placeholder="Password" value="">
                                        @error('password')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 mb-3"> <input type="number"
                                            class="form-control form-control-sm text-end" wire:model="mobile"
                                            placeholder="Mobile" value="{{ $labor->mobile ?? '' }}">
                                        @error('mobile')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 mb-3"> <input type="number"
                                            class="form-control form-control-sm text-end" wire:model="basic_salary"
                                            placeholder="Basic Salary" value="{{ $labor->basic_salary ?? '' }}">
                                        @error('basic_salary')
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
