<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 d-none">Site Form</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Site Form
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
                            <div class="card-title">Site Form</div>
                            <div class="card-tools">
                                <a wire:navigate class="btn btn-sm btn-secondary btn-flat float-end"
                                    href="{{ route('site.index') }}">Cancel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="save">
                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <select class="form-control form-control-sm" wire:model="account_id">
                                            <option value="">Select Customer</option>
                                            @foreach (\App\Models\Customer::all() as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('account_id')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 mb-3"><input type="text"
                                            class="form-control form-control-sm" wire:model="name" placeholder="Name"
                                            value="{{ $site->name ?? '' }}">
                                        @error('name')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 mb-3"> <input type="text"
                                            class="form-control form-control-sm" wire:model="address"
                                            placeholder="Address" value="{{ $site->address ?? '' }}">
                                        @error('address')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 mb-3"> <input type="number"
                                            class="form-control form-control-sm" wire:model="longitude"
                                            placeholder="Longitude" value="{{ $site->longitude ?? '' }}">
                                        @error('longitude')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 mb-3"> <input type="number"
                                            class="form-control form-control-sm" wire:model="latitude"
                                            placeholder="Latitude" value="{{ $site->latitude ?? '' }}">
                                        @error('latitude')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <select class="form-control form-control-sm" wire:model="status">
                                            <option value="">Select Status</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="pending_payment">Pending Payment</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                        @error('status')
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
