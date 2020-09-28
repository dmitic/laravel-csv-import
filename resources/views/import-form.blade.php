@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if (\Session::has('message'))
            <div class="alert alert-info">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Import CSV
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action={{route('import.store')}}>
                            @csrf
                            <div class="form-group" onSubmit="submitonce(this)">
                                <label for="file">Choose CSV</label>
                                <input type="file" name="file" class="form-control-file" accept=".csv">
                            </div>
                            <input type="submit" class="btm btm-light" value="Import" disabled>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(
            function(){
                $('input:file').change(
                    function(){
                        if ($(this).val()) {
                            $('input:submit').attr('disabled',false);
                        }
                    }
                );
            });
    </script>
@endsection
