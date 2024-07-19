@extends('user.layouts.app')
      @section('contend')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1>{{ $form->form_name }}</h1>
    <form action="{{ route('userform.store')}}" method="post">
        @csrf
        <input type="hidden" name="form_id" value="{{$form->id}}" />
        <div class="row">
        @foreach($form->fields as $field)
            <div class="form-group col-lg-6">

                <label>{{ $field->label }}</label>
                @if($field->field_type == 'text')
                    <input type="text" class="form-control" name="{{ $field->field_name }}">
                @elseif($field->field_type == 'password')
                    <input type="password" class="form-control" name="{{ $field->field_name }}">
                @elseif($field->field_type == 'email')
                    <input type="email" class="form-control" name="{{ $field->field_name }}">
                @elseif($field->field_type == 'number')
                    <input type="number" class="form-control" name="{{ $field->field_name }}">
                @elseif($field->field_type == 'select')
                    <select class="form-control" name="{{ $field->field_name }}">
                        @foreach(json_decode($field->options) as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                @elseif($field->field_type == 'checkbox')
                    @foreach(json_decode($field->options) as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $field->field_name }}[]" value="{{ $option }}">
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                @elseif($field->field_type == 'radio')
                <div class="d-flex">
                    @foreach(json_decode($field->options) as $option)
                        <div class="form-check mr-4">
                           <div> <input class="form-check-input" type="radio" name="{{ $field->field_name }}" value="{{ $option }}"></div>
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        @endforeach
        </div>
        <div>
            <button type="submit" class="btn btn-primary mb-3 mt-3">Save</button>
            <a href="{{route('user_forms.list')}}" class="btn btn-warning mb-3 mt-3 float-right">Back</a>
        </div>
    </form>
</div>
@endsection
