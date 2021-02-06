@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">@isset($credit)Update {{$credit->code}} @else New Credit on {{$patient->full_name}} @endisset</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post"
                  action="@isset($credit){{ route('update_credit', $credit) }}@else{{ route('store_credit') }}@endisset">
                @csrf
                <input type="text" name="created_by"
                       @isset($credit) value="{{ $credit->created_by }}" @else value="{{ Auth::user()->id }}"
                       @endisset hidden>
                <input type="text" name="patient_id"
                       @isset($credit) value="{{ $credit->patient_id }}" @else value="{{ $patient->id }}"
                       @endisset hidden>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group" data-toggle="match-height">
                            <label for="due_date" class="control-label">Date Due</label>
                            <div class="input-with-icon">
                                <input class="form-control" type="text" name="due_date"
                                       id="due_date" data-provide="datepicker"
                                       data-date-today-highlight="true"
                                       value=" @isset($credit){{ \Carbon\Carbon::parse($credit->due_date)->format('m/d/Y') }} @else
                                       {{ \Carbon\Carbon::parse(now())->format('m/d/Y') }} @endisset ">
                                <span class="icon icon-calendar input-icon"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="amount_due" class="control-label">Amount</label>
                            <input type="number" class="form-control" step="0.5" id="amount_due" required
                                   name="amount_due" min="1"
                                   @isset($credit)
                                   value="{{ $credit->amount_due }}"
                                @endisset>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cleared" class="control-label">Status</label>
                            <select name="cleared" id="cleared" class="form-control" required>
                                    <option value="0" @isset($credit) @if($credit->cleared == 0) selected @endif @endisset>Pending</option>
                                    <option value="1" @isset($credit) @if($credit->cleared == 1) selected @endif @endisset>Cleared</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-outline-success pull-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
