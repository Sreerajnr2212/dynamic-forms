@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin List</h1>
          </div>
          <!-- <div class="col-sm-6" style="text-align:right;">
            <a href="{{url('admin/admin/add')}}" class="btn btn-primary">Add New Form</a>
          </div> -->
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form List</h3>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Form Name</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                  @foreach($forms as $value)

                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$value->form_name}}</td>
                      <td>
                      <a href="{{url('admin/form/edit/'.$value->id)}}" class="btn btn-primary">Edit</a>
                      <a href="{{ url('admin/form/delete/'.$value->id) }}" onclick="return confirm('Do you want to delete?')" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection