@extends('layouts.app2')

@section('styles')

@stop

@section('breadcrumb')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Edit Faculty</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('faculty.index') }}">Faculties</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title m-b-0">Faculty Info</h5>
                <form method="POST" action="{{ route('faculty.update', $faculty->id) }}">
                    <div class="form-group m-t-20">
                        <label>Firstname <span class="required-field">*</span></label>
                        <input type="text" class="form-control" name="firstname" value="{{ $faculty->firstname }}" required autofocus>
                    </div>
                    <div class="form-group m-t-20">
                        <label>Middlename</label>
                        <input type="text" class="form-control" name="middlename" value="{{ $faculty->middlename }}">
                    </div>
                    <div class="form-group m-t-20">
                        <label>Lastname <span class="required-field">*</span></label>
                        <input type="text" class="form-control" name="lastname" value="{{ $faculty->lastname }}" required autofocus>
                    </div>
                    <div class="form-group m-t-20">
                        <button class="btn btn-block btn-outline-success">Submit</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    {{ method_field('PUT') }}
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    @if(count($errors) > 0)
          @foreach($errors->all() as $error)
            toastr.error('{{ $error }}', '');
          @endforeach
    @endif
</script>
@stop