@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Patients
                        <a style="float: right" href="{{ route('create_patient') }}">Add Patient</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            @component('components.table_patients', ['patients' => $patients, 'actions'=>true])
                            @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
