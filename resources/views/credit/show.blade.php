@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">{{ $credit->code }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <?php
            $patient = $credit->patient
            ?>
            <h4 class="underline"><b>Credit details</b></h4>
            {{--            {{$patient}}--}}
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Client</div>
                        <div class="col-md-7"><a
                                href="{{ route('show_patient', [$patient, $patient->last_name]) }}">{{ $patient->full_name }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Phone Number:</div>
                        <div class="col-md-7">{{ $patient->phone }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Primary NOK:</div>
                        <div class="col-md-7">
                            @isset($patient->primary_nok)
                                <?php $nok = $patient->primary_nok ?>
                                <a
                                    href="{{ route('show_nok', [$nok, $nok->last_name]) }}">{{ $nok->full_name }}</a>
                                {{--                            {{ $patient->primary_nok->full_name }}--}}
                            @else
                                None <small>(Edit Patient put NOK ID)</small>
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Amount:</div>
                        <div class="col-md-7">KSH. {{ number_format($credit->amount_due, 2) }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Due Date:</div>
                        <div class="col-md-7">{{ $credit->due_date }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Status:</div>
                        <div class="col-md-7">{{ $credit->status_text }}</div>
                    </div>
                </div>
            </div>
            @if($credit->status_text == \App\Credit::STATUS_OVERFLOW)
                    <hr>
                <p>This amount is an overpayment. Will be used to settle the next credit that will be created against <a
                        href="{{ route('show_patient', [$patient, $patient->last_name]) }}">{{$patient->full_name}}</a> and balances reconciled.</p>
                @elseif($credit->status_text == \App\Credit::STATUS_PENDING)
                <br>
                <h4 class="underline">Clearance</h4>
                <p>Enter the Amount to clear below and submit.</p>
                <b>Note:</b>
                <ol>
                    <li>If amount <u>equals</u> {{ number_format($credit->amount_due, 2) }}, this credit will be cleared
                    </li>
                    <li>If amount <u>is less than</u> {{ number_format($credit->amount_due, 2) }}, this credit amount
                        will adjust to the amount and clear, then new credit will be created with balance due today.
                    </li>
                    <li>If amount is <u>more than</u> {{ number_format($credit->amount_due, 2) }}, this credit be
                        cleared, then the balance will be used as overpayment on next credit
                    </li>
                </ol>
                <form action="{{ route('clear_credit') }}" method="post">
                    @csrf
{{--                    <input type="text" name="created_by" value="{{ Auth::user()->id }}" hidden>--}}
                    <input type="text" name="credit_id" value="{{ $credit->id }}" hidden>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="amount_paid" class="control-label"><b>Amount</b></label>
                                        <input type="number" class="form-control" step="0.01" id="amount_paid" required
                                               oninput="Suggest({{$credit->amount_due}}, this.value)"
                                               name="amount_paid"
                                               @isset($credit)
                                               value="{{ $credit->amount_due }}"
                                            @endisset>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-outline-success pull-right">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-7">
                            {{--                            <b>What Next?</b>--}}
                            <span id="suggestion_box"></span>
                        </div>
                        <script>
                            Suggest({{$credit->amount_due}},{{$credit->amount_due}});

                            function Suggest(credit_amount, deposit_amount) {
                                if (credit_amount === deposit_amount) {
                                    document.getElementById('suggestion_box').innerHTML
                                        = "<p><b style='color: green'>Scenario 1</b></p>" +
                                        "<p>If you submit with this amount, This credit will be cleared.</p>"
                                } else if (credit_amount > deposit_amount) {
                                    document.getElementById('suggestion_box').innerHTML
                                        = "<p><b style='color: red'>Scenario 2</b></p>" +
                                        "<p>If you submit with this amount, This credit amount will be adjusted downwards and cleared then the balance used to create  a new credit due today.</p>"
                                } else {
                                    document.getElementById('suggestion_box').innerHTML
                                        = "<p><b style='color: darkorange'>Scenario 3</b></p>" +
                                        "<p>If you submit with this amount, This credit will be cleared then the excess forwarded to the next pending credit for this patient. If none exists, the excess will be saved for use later on next credit.</p>"
                                }
                            }
                        </script>
                    </div>
                </form>

            @endif
        </div>
    </div>
@endsection
