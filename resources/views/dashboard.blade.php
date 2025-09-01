@extends('layouts.app')
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Fixed All</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Fixed Complete
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-success card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Form Validation</div>
                        </div>
                        <form class="needs-validation" novalidate="">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">First name<span
                                                class="required-indicator sr-only"> (required)</span></label>
                                        <input type="text" class="form-control form-control-sm" id="validationCustom01"
                                            value="Mark" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom02" class="form-label">Last name<span
                                                class="required-indicator sr-only"> (required)</span></label>
                                        <input type="text" class="form-control form-control-sm" id="validationCustom02"
                                            value="Otto" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustomUsername" class="form-label">Username<span
                                                class="required-indicator sr-only"> (required)</span></label>
                                        <div class="input-group input-group-sm has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" class="form-control form-control-sm"
                                                id="validationCustomUsername" aria-describedby="inputGroupPrepend"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">City<span
                                                class="required-indicator sr-only"> (required)</span></label>
                                        <input type="text" class="form-control form-control-sm" id="validationCustom03"
                                            required="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">State<span
                                                class="required-indicator sr-only"> (required)</span></label>
                                        <select class="form-control form-control-sm" id="validationCustom04" required="">
                                            <option selected="" disabled="" value="">Choose...</option>
                                            <option>...</option>
                                            <option>...</option>
                                            <option>...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Zip<span
                                                class="required-indicator sr-only"> (required)</span></label>
                                        <input type="text" class="form-control form-control-sm" id="validationCustom05"
                                            required="">
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                                required="">
                                            <label class="form-check-label" for="invalidCheck">
                                                Agree to terms and conditions
                                                <span class="required-indicator sr-only"> (required)</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-flat btn-success" type="submit">Submit form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
