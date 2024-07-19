@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Add New Form</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form action="{{ route('form.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="form_name">Form Name</label>
                                        <input type="text" class="form-control" value="{{ old('form_name') }}" name="form_name" id="form_name" placeholder="Enter Form Name">
                                        @error('form_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div id="form-container">
                                    @if (old('label'))
                                        @foreach (old('label') as $i => $label)
                                            <div class="form-clone" data-index="{{ $i }}">
                                                <div class="row form-row">
                                                    <div class="form-group col-lg-3">
                                                        <label for="label">Label</label>
                                                        <input type="text" class="form-control" value="{{ old('label.' . $i) }}" name="label[{{ $i }}]" placeholder="Enter Label">
                                                        @error('label.' . $i)
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <label for="field_name">Field Name</label>
                                                        <input type="text" class="form-control" value="{{ old('field_name.' . $i) }}" name="field_name[{{ $i }}]" placeholder="Enter Field Name">
                                                        @error('field_name.' . $i)
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <label for="field_type">Type</label>
                                                        <select class="form-control field_type" name="field_type[{{ $i }}]">
                                                            <option {{ (old('field_type.' . $i) == 'text') ? 'selected' : '' }} value="text">Text</option>
                                                            <option {{ (old('field_type.' . $i) == 'password') ? 'selected' : '' }} value="password">Password</option>
                                                            <option {{ (old('field_type.' . $i) == 'email') ? 'selected' : '' }} value="email">Email</option>
                                                            <option {{ (old('field_type.' . $i) == 'number') ? 'selected' : '' }} value="number">Number</option>
                                                            <option {{ (old('field_type.' . $i) == 'select') ? 'selected' : '' }} value="select">Select</option>
                                                            <option {{ (old('field_type.' . $i) == 'checkbox') ? 'selected' : '' }} value="checkbox">Checkbox</option>
                                                            <option {{ (old('field_type.' . $i) == 'radio') ? 'selected' : '' }} value="radio">Radio</option>
                                                        </select>
                                                        @error('field_type.' . $i)
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-3 mt-4">
                                                        <button type="button" class="{{ $i === 0 ? 'addfield btn-primary' : 'delete-field btn-danger' }}">
                                                            {{ $i === 0 ? 'Add Field' : 'Delete Field' }}
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="options_div mt-4" style="{{ (in_array(old('field_type.' . $i), ['select', 'checkbox', 'radio']) ? 'display:block;' : 'display:none;') }}">
                                                    <div class="row">
                                                        <div class="form-group col-lg-2">
                                                            <label for="value">Enter Values</label>
                                                        </div>
                                                        <div class="form-group col-lg-2">
                                                            <button type="button" class="btn btn-primary addvalue">Add Value</button>
                                                        </div>
                                                    </div>
                                                    <div class="row form-fieldrow">
                                                        @if (is_array(old('value.' . $i)))
                                                            @foreach (old('value.' . $i) as $valueIndex => $value)
                                                                <div class="form-group col-lg-4 fieldrow">
                                                                    <input type="text" class="form-control" value="{{ $value }}" name="value[{{ $i }}][]" placeholder="Enter value">
                                                                    @if ($valueIndex != 0)
                                                                        <button type="button" class="btn btn-danger removevalue mt-2">Remove</button>
                                                                    @endif
                                                                    @error('value.' . $i . '.' . $valueIndex)
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="form-group col-lg-4 fieldrow">
                                                                <input type="text" class="form-control" value="{{ old('value.' . $i . '.0') }}" name="value[{{ $i }}][]" placeholder="Enter value">
                                                                @error('value.' . $i . '.0')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="form-clone" data-index="0">
                                            <div class="row form-row">
                                                <div class="form-group col-lg-3">
                                                    <label for="label">Label</label>
                                                    <input type="text" class="form-control" value="{{ old('label.0') }}" name="label[0]" placeholder="Enter Label">
                                                    @error('label.0')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label for="field_name">Field Name</label>
                                                    <input type="text" class="form-control" value="{{ old('field_name.0') }}" name="field_name[0]" placeholder="Enter Field Name">
                                                    @error('field_name.0')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label for="field_type">Type</label>
                                                    <select class="form-control field_type" name="field_type[0]">
                                                        <option {{ (old('field_type.0') == 'text') ? 'selected' : '' }} value="text">Text</option>
                                                        <option {{ (old('field_type.0') == 'password') ? 'selected' : '' }} value="password">Password</option>
                                                        <option {{ (old('field_type.0') == 'email') ? 'selected' : '' }} value="email">Email</option>
                                                        <option {{ (old('field_type.0') == 'number') ? 'selected' : '' }} value="number">Number</option>
                                                        <option {{ (old('field_type.0') == 'select') ? 'selected' : '' }} value="select">Select</option>
                                                        <option {{ (old('field_type.0') == 'checkbox') ? 'selected' : '' }} value="checkbox">Checkbox</option>
                                                        <option {{ (old('field_type.0') == 'radio') ? 'selected' : '' }} value="radio">Radio</option>
                                                    </select>
                                                    @error('field_type.0')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-lg-3 mt-4">
                                                    <button type="button" class="addfield btn-primary">
                                                        Add Field
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="options_div mt-4" style="{{ (in_array(old('field_type.0'), ['select', 'checkbox', 'radio']) ? 'display:block;' : 'display:none;') }}">
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                        <label for="value">Enter Values</label>
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <button type="button" class="btn btn-primary addvalue">Add Value</button>
                                                    </div>
                                                </div>
                                                <div class="row form-fieldrow">
                                                    <div class="form-group col-lg-4 fieldrow">
                                                        <input type="text" class="form-control" value="{{ old('value.0.0') }}" name="value[0][]" placeholder="Enter value">
                                                        @error('value.0.0')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/dynamicform/addform.js') }}"></script>
@endsection
