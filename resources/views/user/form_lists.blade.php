@extends('user.layouts.app')
      @section('contend')
      <div class="container">
        <h1>All Forms</h1>
                @if($forms->isEmpty())
                    <p>No forms available.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Form Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($forms as $form)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $form->form_name }}</td>
                                <td>
                                    <a href="{{ route('user_forms.show', $form->id) }}" class="btn btn-info btn-sm">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
    </div>
      @endsection
  
