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
                    <div class="card card">
                        <div class="card-header">
                            <h3 class="card-title">Title</h3>
                            <div class="card-tools"> <button type="button" class="btn btn-tool"
                                    data-lte-toggle="card-collapse" title="Collapse"> <i data-lte-icon="expand"
                                        class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"
                                    title="Remove"> <i class="bi bi-x-lg"></i> </button> </div>
                        </div>
                        <div class="card-body">
                            Start creating your amazing application!
                        </div>
                        <div class="card-footer">Footer</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
