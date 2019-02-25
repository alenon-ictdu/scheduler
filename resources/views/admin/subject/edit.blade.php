@extends('layouts.app2')

@section('styles')

@stop

@section('breadcrumb')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Edit Subject</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('subject.index') }}">Subjects</a></li>
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
                <h5 class="card-title m-b-0">Subject Info</h5>
                <form method="POST" action="{{ route('subject.update', $subject->id) }}">
                    <div class="form-group m-t-20">
                        <label>Subject Code <span class="required-field">*</span></label>
                        <input type="text" class="form-control" name="code" value="{{ $subject->code }}" required autofocus>
                    </div>
                    <div class="form-group m-t-20">
                        <label>Description <span class="required-field">*</span></label>
                        <input type="text" class="form-control" name="description" value="{{ $subject->description }}" required autofocus>
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