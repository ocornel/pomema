@section('results')
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                <button type="button" class="card-action card-toggler" title="Collapse"></button>
            </div>
            <strong>
                @if(isset($title))
                    {{ $title }}
                @endif
            </strong>
        </div>
        <div class="card-body">
    @component($component,$data_array) @endcomponent
        </div>
    </div>
@endsection
