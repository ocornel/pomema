@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">@isset($nok)Update {{$nok->full_name}} @else Create new
            Next Of Kin @isset($patient) for {{$patient->full_name}} @endisset @endisset</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post"
                  action="@isset($nok){{ route('update_nok', $nok) }}@else{{ route('store_nok') }}@endisset">
                @csrf
                <input type="text" name="created_by"
                       @isset($nok) value="{{ $nok->created_by }}" @else value="{{ Auth::user()->id }}"
                       @endisset hidden>
                @isset($is_primary) <input type="text" name="is_primary" value = '{{$is_primary}}' hidden> @endisset
                @isset($patient) <input type="text" name="patient_id" value="{{ $patient->id }}" hidden> @endisset
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name" class="control-label">First name</label>
                            <input type="text" class="form-control" id="first_name" required
                                   name="first_name"
                                   @isset($nok)
                                   value="{{ $nok->first_name }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="description" class="control-label">Last name</label>
                            <input type="text" class="form-control" id="last_name" required
                                   name="last_name"
                                   @isset($nok)
                                   value="{{ $nok->last_name }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="other_names" class="control-label">Other names</label>
                            <input type="text" class="form-control" id="other_names"
                                   name="other_names"
                                   @isset($nok)
                                   value="{{ $nok->other_names }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="residence" class="control-label">Residence</label>
                            <input type="text" class="form-control" id="residence"
                                   name="residence"
                                   @isset($nok)
                                   value="{{ $nok->residence }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="id_number" class="control-label">ID Number</label>
                            <input type="text" class="form-control" id="id_number"
                                   name="id_number"
                                   @isset($nok_id)
                                       value = {{ $nok_id }}
                                   @elseif(isset($nok))
                                   value="{{ $nok->id_number }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone" class="control-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone"
                                   name="phone"
                                   @isset($nok)
                                   value="{{ $nok->phone }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" data-toggle="match-height">
                            <label for="dob" class="control-label">Date of Birth</label>
                            <div class="input-with-icon">
                                <input class="form-control" type="text" name="dob" id="dob" data-provide="datepicker" data-date-today-highlight="true" value="@isset($nok){{ \Carbon\Carbon::parse($nok->dob)->format('m/d/Y') }} @else {{ \Carbon\Carbon::parse(now())->format('m/d/Y') }} @endisset">
                                <span class="icon icon-calendar input-icon"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="work_place" class="control-label">Work Place</label>
                            <input type="text" class="form-control" id="work_place"
                                   name="work_place"
                                   @isset($nok)
                                   value="{{ $nok->work_place }}"
                                @endisset>
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
