@extends('dashboard_layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Footers</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Footer Sections</h4>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="{{ route('footers.create') }}" class="btn btn-primary mb-2">
                                    <i class="mdi mdi-plus-circle me-2"></i> Add Footer
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>S no.</th>
                                        <th>Visibility</th>
                                        <th>Heading</th>
                                        <th>Values</th>
                                        <th style="width: 75px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($footers as $index=>$footer)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>
                                                <span class="badge bg-{{ $footer->visibility === 'public' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($footer->visibility) }}
                                                </span>
                                            </td>
                                            <td>{{ $footer->footer_column['heading'] ?? '' }}</td>
                                            <td>
                                                @if(isset($footer->footer_column['values']))
                                                    @foreach($footer->footer_column['values'] as $value)
                                                        <span class="badge bg-primary me-1">{{ $value }}</span>
                                                    @endforeach
                                                @endif
                                            </td>


                                            <td>

                                                <a href="{{ route('footers.show', $footer->id) }}" class="btn btn-info">View</a>

                                                <a href="{{ route('footers.edit', $footer->id) }}" class="btn btn-warning">
                                                    Edit
                                                </a>

                                                <form action="{{ route('footers.destroy', $footer->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>

                                            </td>





                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection