@extends('dashboard_layout.app')

@section('content')


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('footers.index') }}">Footers</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Footer Section</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('footers.update', $footer->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="visibility" class="form-label">Visibility</label>
                                <select class="form-select" id="visibility" name="visibility" required>
                                    <option value="public" {{ $footer->visibility === 'public' ? 'selected' : '' }}>Public</option>
                                    <option value="private" {{ $footer->visibility === 'private' ? 'selected' : '' }}>Private</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="heading" class="form-label">Heading</label>
                                <input type="text" class="form-control" id="heading" name="footer_column[heading]" 
                                       value="{{ $footer->footer_column['heading'] ?? '' }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Values</label>
                                <div id="values-container">
                                    @if(isset($footer->footer_column['values']))
                                        @foreach($footer->footer_column['values'] as $value)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="footer_column[values][]" value="{{ $value }}">
                                                <button type="button" class="btn btn-danger remove-value">Remove</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="footer_column[values][]">
                                            <button type="button" class="btn btn-danger remove-value">Remove</button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" id="add-value" class="btn btn-success mt-2">Add Value</button>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-value').addEventListener('click', function() {
            const container = document.getElementById('values-container');
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `
                <input type="text" class="form-control" name="footer_column[values][]">
                <button type="button" class="btn btn-danger remove-value">Remove</button>
            `;
            container.appendChild(div);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-value')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endsection