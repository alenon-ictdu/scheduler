@extends('layouts.app2')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('matrix/assets/libs/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('matrix/assets/libs/jquery-minicolors/jquery.minicolors.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('matrix/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('matrix/assets/libs/quill/dist/quill.snow.css') }}">
{{-- <link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/> --}}
<style>
    .custom-border {
        border:1px solid #444;
        line-height: 15px;
        border-radius: 3px;
    }
</style>
@stop

@section('breadcrumb')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Section : {{ $section->name }}</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Section {{ $section->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-success btn-xs" id="addRowBtn"><i class="fa fa-plus"></i> Add Row</button>
            </div>
            <div class="card-body border-top">
                <form method="POST" action="{{ route('section.schedule.store', $section->id) }}">
                    {{ csrf_field() }}
                    <table id="subjectTeacherTable" class="table">
                        <thead>
                            <tr>
                                <th style="width: 20%;">Subject</th>
                                <th style="width: 20%;">Teacher</th>
                                <th style="width: 20%;">Day</th>
                                <th style="width: 20%;">Start</th>
                                <th style="width: 20%;">End</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($schedule as $sched)
                          <tr>
                            <td>
                              <select class="form-control js-single" name="subject_{{ $ctr }}">
                                <option value="none">Select subject</option>
                                @foreach($subjects as $row)
                                  <option @if($sched->subject_id == $row->id) selected @endif value="{{ $row->id }}">{{ $row->description. ' (' .$row->code. ')' }}</option>
                                @endforeach
                              </select>
                            </td>
                            <td>
                              <select class="form-control js-single" name="teacher_{{ $ctr }}">
                                <option value="none">Select Teacher</option>
                                @foreach($faculties as $row)
                                  <option @if($sched->teacher_id == $row->id) selected @endif value="{{ $row->id }}">{{ $row->firstname. ' ' .$row->middlename. ' ' .$row->lastname. ' (' .$row->id. ')' }}</option>
                                @endforeach
                              </select>
                            </td>
                            <td>
                                <select class="form-control js-single" name="day_{{ $ctr }}" required autofocus>
                                    <option value="none"> -- Select Day -- </option>
                                    <option @if($sched->day == 'Monday') selected @endif value="Monday">Monday</option>
                                    <option @if($sched->day == 'Tuesday') selected @endif value="Tuesday">Tuesday</option>
                                    <option @if($sched->day == 'Wednesday') selected @endif value="Wednesday">Wednesday</option>
                                    <option @if($sched->day == 'Thursday') selected @endif value="Thursday">Thursday</option>
                                    <option @if($sched->day == 'Friday') selected @endif value="Friday">Friday</option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control custom-border" type="text" name="start_{{ $ctr }}" placeholder="00:00 am/pm" value="{{ $sched->start }}" required autofocus>
                            </td>
                            <td>
                                <input class="form-control custom-border" type="text" name="end_{{ $ctr }}" placeholder="00:00 am/pm" value="{{ $sched->end }}" required autofocus>
                            </td>
                            <td><button id='delete-row' type='button' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>
                          </tr>
                          <?php $ctr++; ?>
                          @endforeach
                          @if($schedule->count() == 0)
                          <tr>
                            <td>
                              <select class="form-control js-single" name="subject_1" required autofocus>
                                <option value="none"> -- Select Subject -- </option>
                                @foreach($subjects as $row)
                                  <option value="{{ $row->id }}">{{ $row->description. ' (' .$row->code. ')' }}</option>
                                @endforeach
                              </select>
                            </td>
                            <td>
                              <select class="form-control js-single" name="teacher_1" required autofocus>
                                <option value="none"> -- Select Teacher -- </option>
                                @foreach($faculties as $row)
                                  <option value="{{ $row->id }}">{{ $row->firstname. ' ' .$row->middlename. ' ' .$row->lastname. ' (' .$row->id. ')' }}</option>
                                @endforeach
                              </select>
                            </td>
                            <td>
                                <select class="form-control js-single" name="day_1" required autofocus>
                                    <option value="none"> -- Select Day -- </option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control custom-border" type="text" name="start_1" placeholder="00:00 am/pm" required autofocus>
                            </td>
                            <td>
                                <input class="form-control custom-border" type="text" name="end_1" placeholder="00:00 am/pm" required autofocus>
                            </td>
                            <td><button id='delete-row' type='button' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>
                          </tr>
                          @endif
                        </tbody>
                    </table>
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
{{-- <script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script> --}}
<script src="{{ asset('matrix/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('matrix/assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script>
    @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}', '');
    @endif

    $('.js-single').select2();

    @if (Session::has('success'))
        toastr.success('{{ Session::get('success') }}', '');
    @endif

    @if (Session::has('info'))
        toastr.info('{{ Session::get('info') }}', '');
    @endif

    function ConfirmDelete()
    {
    var x = confirm("Are you sure you want to delete this section?");
    if (x)
      return true;
    else
      return false;
    }

    $("#addRowBtn").on('click',function() {
    // table length
    var rowLength = $('#subjectTeacherTable tbody tr').length + 1;
    console.log(rowLength);

    // console.log('wew');
      /*// alert('working!');
    var $book_id = $(this).closest("tr")   // Finds the closest row <tr> 
                       .find(".ir")     // Gets a descendent with class="nr"
                       .text();         // Retrieves the text within <td>*/

    var markup = "<tr><td><select name='subject_"+rowLength+"' class='form-control js-single' required autofocus><option value='none'> -- Select Subject -- </option>@foreach($subjects as $row)<option value='{{$row->id}}'>{{$row->description. ' (' .$row->code. ')'}}</option>@endforeach</select></td><td><select name='teacher_"+rowLength+"' class='form-control js-single' required autofocus><option value='none'> -- Select Teacher -- </option>@foreach($faculties as $row)<option value='{{$row->id}}'>{{$row->firstname. ' ' .$row->middlename. ' ' .$row->lastname. ' (' .$row->id. ')'}}</option>@endforeach</select></td><td><select class='form-control js-single' name='day_"+rowLength+"' required autofocus><option value='none'> -- Select Day -- </option><option value='Monday'>Monday</option><option value='Tuesday'>Tuesday</option><option value='Wednesday'>Wednesday</option><option value='Thursday'>Thursday</option><option value='Friday'>Friday</option></select></td><td><input class='form-control custom-border' type='text' name='start_"+rowLength+"' placeholder='00:00 am/pm' required autofocus></td><td><input class='form-control custom-border' type='text' name='end_"+rowLength+"' placeholder='00:00 am/pm' required autofocus></td><td><button id='delete-row' type='button' class='btn btn-danger'><i class='fa fa-trash'></i></button></td></tr>";
    $("#subjectTeacherTable tbody").append(markup);
    $('.js-single').select2();
  });


  $('#subjectTeacherTable').on('click', '#delete-row', function() {
      $(this).closest('tr').remove();
  });


</script>
@stop