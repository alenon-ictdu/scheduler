@extends('layouts.app2')

@section('styles')
<link href="{{ asset('matrix/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@stop

@section('breadcrumb')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Sections</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sections</li>
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
                <a href="{{ route('section.create') }}" class="btn btn-outline-success btn-xs"><i class="mdi mdi-plus"></i> Add Section</a>
            </div>
            <div class="card-body border-top">
                <div class="table-responsive">
                    <table id="sectionTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Section Code</th>
                                <th>Name</th>
                                <th>Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sections as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->code }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->year }}</td>
                                <td>
                                    <a href="{{ route('section.edit', $row->id) }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-success btn-xs" id="viewSection" data-id="{{ $row->id }}"><i class="fa fa-eye"></i></a>
                                    <button type="submit" class="btn btn-xs btn-danger" form="deleteSection{{$row->id}}"><i class="fa fa-trash"></i> </button>
                                    <a href="{{ route('section.schedule', $row->id) }}" class="btn btn-xs btn-warning"> View Schedule</a>
                                    <a href="{{ route('section.schedule.create', $row->id) }}" class="btn btn-xs btn-light"> Manage Schedule</a>
                                    <form id="deleteSection{{$row->id}}" method="POST" action="{{ route('section.destroy', $row->id) }}" onsubmit="return ConfirmDelete()">
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Section Code</th>
                                <th>Name</th>
                                <th>Year</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="subject-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-list"></i> Section Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
        <input type="hidden" name="id" id="id" >
        <div class="modal-body">
          <div class="view-info">
            <dl class="row">
              <dt class="col-sm-3">Section Code</dt>
              <dd class="col-sm-9" id="vcode"></dd>

              <dt class="col-sm-3">Name</dt>
              <dd class="col-sm-9" id="vname"></dd>   

              <dt class="col-sm-3">Year</dt>
              <dd class="col-sm-9" id="vyear"></dd>        
            </dl>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

    </div>
  </div>
</div>

@stop

@section('scripts')
<script src="{{ asset('matrix/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
<script src="{{ asset('matrix/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
<script src="{{ asset('matrix/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script>
    $('#sectionTable').DataTable({
        "order": [[ 0, "desc" ]],
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
        ]
    });

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

    /*VIEW MEMBER*/
    $('body').delegate('#sectionTable #viewSection', 'click', function(e) {
        var id = $(this).data(id);
        $.get("{{ route('section.show') }}", {id:id}, function(data) {
            console.log(data);
            $('#vcode').html(data[0].code);
            $('#vname').html(data[0].name);
            $('#vyear').html(data[0].year);
            $('#subject-show').modal('show');
        });
    });
</script>
@stop