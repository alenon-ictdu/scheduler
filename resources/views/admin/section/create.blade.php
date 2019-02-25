@extends('layouts.app2')

@section('styles')

@stop

@section('breadcrumb')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Add Section</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('section.index') }}">Sections</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add</li>
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
                <h5 class="card-title m-b-0">Section Info</h5>
                <form method="POST" action="{{ route('section.store') }}">
                {{ csrf_field() }}
                    <div class="form-group m-t-20">
                        <label>Section Code <span class="required-field">*</span></label>
                        <input type="text" class="form-control" name="code" value="{{ old('code') }}" required autofocus>
                    </div>
                    <div class="form-group m-t-20">
                        <label>Name <span class="required-field">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    <div class="form-group m-t-20">
                        <label>Year <span class="required-field">*</span></label>
                        <select class="form-control" name="year">
                            <option value="none"> -- Select Year Level -- </option>
                            <option value="Grade 7">Grade 7</option>
                            <option value="Grade 8">Grade 8</option>
                            <option value="Grade 9">Grade 9</option>
                            <option value="Grade 10">Grade 10</option>
                            <option value="Grade 11">Grade 11</option>
                            <option value="Grade 12">Grade 12</option>
                        </select>
                    </div>
                    <div class="form-group m-t-20">
                        <button class="btn btn-block btn-outline-success">Submit</button>
                    </div>
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