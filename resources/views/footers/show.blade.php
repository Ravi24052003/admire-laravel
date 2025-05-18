@extends('dashboard_layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('footers.index') }}">Footers</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Footer Section Details</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">ID</label>
                                    <p class="form-control-plaintext">{{ $footer->id }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Visibility</label>
                                    <p class="form-control-plaintext">
                                        <span class="badge bg-{{ $footer->visibility === 'public' ? 'success' : 'warning' }}">
                                            {{ ucfirst($footer->visibility) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Heading</label>
                            <p class="form-control-plaintext">{{ $footer->footer_column['heading'] ?? '' }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Values</label>
                            <div class="form-control-plaintext">
                                @if(isset($footer->footer_column['values']))
                                    <ul>
                                        @foreach($footer->footer_column['values'] as $value)
                                            <li>{{ $value }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Created At</label>
                            <p class="form-control-plaintext">{{ $footer->created_at->format('M d, Y H:i:s') }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Updated At</label>
                            <p class="form-control-plaintext">{{ $footer->updated_at->format('M d, Y H:i:s') }}</p>
                        </div>

                        <a href="{{ route('footers.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection