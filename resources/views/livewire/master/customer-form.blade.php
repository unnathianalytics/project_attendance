<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 d-none">Customer Form</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Customer Form
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <div class="card-title">Customer Form</div>
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
                                            <input type="text" wire:model="op_balance"
                                                class="form-control form-control-sm">
                                            <select wire:model="cr_dr" class="form-control form-control-sm">
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
                <div class="col-lg-4">


                </div>
            </div>
        </div>
    </div>
</div>
