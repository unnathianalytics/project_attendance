<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 d-none">Payment Form</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Payment Form
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <div class="card-title">Payment Form</div>
                            <div class="card-tools">
                                <a wire:navigate class="btn btn-sm btn-secondary btn-flat float-end"
                                    href="{{ route('payment.index') }}">Cancel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="save">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <input type="date" class="form-control form-control-sm" wire:model="date">
                                        @error('date')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <table class="table table-sm-table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Labor</th>
                                                    <th>Amount</th>
                                                    <th>Mode</th>
                                                    <th>Description</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($payments as $index => $att)
                                                    <tr>
                                                        <td>
                                                            <select class="form-control form-control-sm"
                                                                wire:model.live="payments.{{ $index }}.user_id">
                                                                <option value="">Select Labor</option>
                                                                @foreach (\App\Models\Labor::all() as $labor)
                                                                    <option value="{{ $labor->id }}">
                                                                        {{ $labor->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error("payments.$index.user_id")
                                                                <div id="" role="alert" class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm"
                                                                wire:model.live="payments.{{ $index }}.amount"
                                                                placeholder="Amount Paid">
                                                            @error("payments.$index.amount")
                                                                <div id="" role="alert" class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <select class="form-control form-control-sm"
                                                                wire:model.live="payments.{{ $index }}.settlement_via">
                                                                <option value="">Select Payment Method</option>
                                                                <option value="Cash">Cash</option>
                                                                <option value="Bank/UPI">Bank/UPI</option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                            @error("payments.$index.settlement_via")
                                                                <div id="" role="alert" class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm"
                                                                wire:model="payments.{{ $index }}.description"
                                                                placeholder="Description">
                                                            @error("payments.$index.description")
                                                                <div id="" role="alert" class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                wire:click="removePayment({{ $index }})"><i
                                                                    class="bi bi-x"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @error('payments')
                                            <div id="" role="alert" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="row mb-3">
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-info btn-sm"
                                                    wire:click="addPayment">Add Payment</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button class="btn btn-primary btn-sm" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        </div>
    </div>
</div>
