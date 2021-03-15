@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">@isset($patient)Update {{$patient->full_name}} @else Create new
            Patient @endisset</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post"
                  action="@isset($patient){{ route('update_patient', $patient) }}@else{{ route('store_patient') }}@endisset">
                @csrf
                <input type="text" name="created_by"
                       @isset($patient) value="{{ $patient->created_by }}" @else value="{{ Auth::user()->id }}"
                       @endisset hidden>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="description" class="control-label">First name</label>
                            <input type="text" class="form-control" id="first_name" required
                                   name="first_name"
                                   @isset($patient)
                                   value="{{ $patient->first_name }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="description" class="control-label">Last name</label>
                            <input type="text" class="form-control" id="last_name" required
                                   name="last_name"
                                   @isset($patient)
                                   value="{{ $patient->last_name }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="description" class="control-label">Other names</label>
                            <input type="text" class="form-control" id="other_names"
                                   name="other_names"
                                   @isset($patient)
                                   value="{{ $patient->other_names }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="description" class="control-label">Residence</label>
                            <input type="text" class="form-control" id="residence"
                                   name="residence"
                                   @isset($patient)
                                   value="{{ $patient->residence }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="description" class="control-label">PC Number</label>
                            <input type="text" class="form-control" id="pc_number" required
                                   name="pc_number"
                                   @isset($patient)
                                   value="{{ $patient->pc_number }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="description" class="control-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone"
                                   name="phone"
                                   @isset($patient)
                                   value="{{ $patient->phone }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" data-toggle="match-height">
                            <label for="dob" class="control-label">Date of Birth</label>
{{--                            <div class="input-with-icon">--}}
                                <input class="form-control" type="text" name="dob" id="dob" required data-provide="datepicker" data-date-today-highlight="true" value=" @isset($patient){{ \Carbon\Carbon::parse($patient->dob)->format('m/d/Y') }} @else {{ \Carbon\Carbon::parse(now())->format('m/d/Y') }} @endisset ">
                                <span class="icon icon-calendar input-icon"></span>
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sex" class="control-label">Sex</label>
                            <select name="sex" id="sex" class="form-control" required>
                                @foreach(\App\Patient::SEX_VALUES as $sex)
                                    <option value="{{ $sex }}"
                                            @isset($patient) @if($patient->sex == $sex) selected @endif @endisset>{{ \App\Patient::GENDERS[$sex] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="description" class="control-label">Primary NOK ID number</label>
                            <input type="text" class="form-control" id="p_nok_id" name="p_nok_id" @isset($patient) value="{{ $patient->p_nok_id }}" @endisset>
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
