@extends('layouts.app2')

@section('styles')
<link href="{{ asset('matrix/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@stop

@section('breadcrumb')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Faculties</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Faculties</li>
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
                <a href="{{ route('faculty.create') }}" class="btn btn-outline-success btn-xs"><i class="mdi mdi-plus"></i> Add Faculty</a>
            </div>
            <div class="card-body border-top">
                <div class="table-responsive">
                    <table id="facultyTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Firstname</th>
                                <th>Middlename</th>
                                <th>Lastname</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faculties as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->firstname }}</td>
                                <td>{{ $row->middlename }}</td>
                                <td>{{ $row->lastname }}</td>
                                <td>
                                    <a href="{{ route('faculty.edit', $row->id) }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-success btn-xs" id="viewFaculty" data-id="{{ $row->id }}"><i class="fa fa-eye"></i></a>
                                    @if(!in_array($row->id, $cantDelete))<button type="submit" class="btn btn-xs btn-danger" form="deleteFaculty{{$row->id}}"><i class="fa fa-trash"></i> </button>@endif
                                    <a href="{{ route('faculty.schedule', $row->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-list"></i> View Section</a>
                                    @if(!in_array($row->id, $cantDelete))<form id="deleteFaculty{{$row->id}}" method="POST" action="{{ route('faculty.destroy', $row->id) }}" onsubmit="return ConfirmDelete()">
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        {{ method_field('DELETE') }}
                                    </form>@endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Firstname</th>
                                <th>Middlename</th>
                                <th>Lastname</th>
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
<div class="modal fade" id="faculty-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-list"></i> Teacher Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
        <input type="hidden" name="id" id="id" >
        <div class="modal-body">
          <div class="view-info">
            <dl class="row">
              <dt class="col-sm-3">Firstname</dt>
              <dd class="col-sm-9" id="vfirstname"></dd>

              <dt class="col-sm-3" id="vmiddlename-label">Middlename</dt>
              <dd class="col-sm-9" id="vmiddlename"></dd>

              <dt class="col-sm-3">Lastname</dt>
              <dd class="col-sm-9" id="vlastname"></dd>        
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
    $('#facultyTable').DataTable({
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
    var x = confirm("Are you sure you want to delete this teacher?");
    if (x)
      return true;
    else
      return false;
    }

    /*VIEW MEMBER*/
    $('body').delegate('#facultyTable #viewFaculty', 'click', function(e) {
        var id = $(this).data(id);
        $.get("{{ route('faculty.show') }}", {id:id}, function(data) {
            // console.log(data);
            var mname = 'None';
            if(!data[0].middlename == '') {
                mname = data[0].middlename;
            }
            $('#vfirstname').html(data[0].firstname);
            $('#vmiddlename').html(mname);
            $('#vlastname').html(data[0].lastname);
            $('#faculty-show').modal('show');
        });
    });
</script>
@stop