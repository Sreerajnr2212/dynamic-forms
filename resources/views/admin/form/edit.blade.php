@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Form</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <form action="{{ route('form.update', $geForm->id) }}" method="post" id="edit-form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="form_name">Form Name</label>
                                        <input type="text" class="form-control" value="{{ old('form_name', $geForm->form_name) }}" name="form_name" id="form_name" placeholder="Enter Form Name">
                                        @error('form_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div id="form-container">
                                    @foreach ( $geForm->fields as $index => $field)
                                    <div class="form-clone" data-index="{{ $index }}">
                                        <div class="row form-row">
                                            <div class="form-group col-lg-3">
                                                <label for="label">Label</label>
                                                <input type="text" class="form-control" value="{{ old('label.' . $index, $field->label) }}" name="label[{{ $index }}]" placeholder="Enter Label">
                                                @error('label.' . $index)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label for="field_name">Field Name</label>
                                                <input type="text" class="form-control" value="{{ old('field_name.' . $index, $field->field_name) }}" name="field_name[{{ $index }}]" placeholder="Enter Field Name">
                                                @error('field_name.' . $index)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label for="field_type">Type</label>
                                                <select class="form-control field_type" name="field_type[{{ $index }}]">
                                                    <option value="text" {{ old('field_type.' . $index, $field->field_type) == 'text' ? 'selected' : '' }}>Text</option>
                                                    <option value="password" {{ old('field_type.' . $index, $field->field_type) == 'password' ? 'selected' : '' }}>Password</option>
                                                    <option value="email" {{ old('field_type.' . $index, $field->field_type) == 'email' ? 'selected' : '' }}>Email</option>
                                                    <option value="number" {{ old('field_type.' . $index, $field->field_type) == 'number' ? 'selected' : '' }}>Number</option>
                                                    <option value="select" {{ old('field_type.' . $index, $field->field_type) == 'select' ? 'selected' : '' }}>Select</option>
                                                    <option value="checkbox" {{ old('field_type.' . $index, $field->field_type) == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                                                    <option value="radio" {{ old('field_type.' . $index, $field->field_type) == 'radio' ? 'selected' : '' }}>Radio</option>
                                                </select>
                                                @error('field_type.' . $index)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group col-lg-3 mt-4">
                                                @if($index == 0)
                                                <button type="button" class="btn btn-primary addfield">Add Field</button>
                                                @else
                                                    <button type="button" class="btn btn-danger delete-field">Remove</button>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="options_div mt-4" style="{{ in_array(old('field_type.' . $index, $field->field_type), ['select', 'checkbox', 'radio']) ? 'display:block;' : 'display:none;' }}">
                                            <div class="row">
                                                <div class="form-group col-lg-2">
                                                    <label for="value">Enter Values</label>
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <button type="button" class="btn btn-primary addvalue">Add Value</button>
                                                </div>
                                            </div>
                                            <div class="row form-fieldrow">
                                                @if (in_array(old('field_type.' . $index, $field->field_type), ['select', 'checkbox', 'radio']))
                                                    @foreach (old('value.' . $index, json_decode($field->options, true)) as $valueIndex => $value)
                                                        <div class="form-group col-lg-4 fieldrow">
                                                            <input type="text" class="form-control" value="{{ old('value.' . $index . '.' . $valueIndex, $value) }}" name="value[{{ $index }}][]" placeholder="Enter value">
                                                            @if ($valueIndex != 0)
                                                                <button type="button" class="btn btn-danger removevalue mt-2">Remove</button>
                                                            @endif
                                                            @error('value.' . $index . '.' . $valueIndex)
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="form-group col-lg-4 fieldrow">
                                                        <input type="text" class="form-control" value="{{ old('value.' . $index . '.0') }}" name="value[{{ $index }}][]" placeholder="Enter value">
                                                        @error('value.' . $index . '.0')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        var lastIndex = {{ old('fields', $geForm->fields)->count() - 1 }};
        $(document).on('change', '.field_type', function () {
            var selectedValue = $(this).val();
            var optionsDiv = $(this).closest('.form-clone').find('.options_div');

            if (selectedValue === 'select' || selectedValue === 'checkbox' || selectedValue === 'radio') {
                optionsDiv.show();
                optionsDiv.find('input[name^="value"]').attr('required', true);
            } else {
                optionsDiv.hide();
            }
        });

        // Add field functionality
        $(document).on('click', '.addfield', function () {
            lastIndex++;
            var $clonedRow = $(this).closest('.form-clone').clone();
            $clonedRow.find('input').each(function () {
                $(this).val('');
            });
            $clonedRow.find('.addfield').removeClass('addfield btn-primary').addClass('delete-field btn-danger').text('Remove');
            $clonedRow.find('select').prop('selectedIndex', 0);
            $clonedRow.find('.options_div').hide();
            $clonedRow.attr('data-index', lastIndex);
            $clonedRow.find('input[name^="label"]').attr('name', 'label[' + lastIndex + ']');
            $clonedRow.find('input[name^="field_name"]').attr('name', 'field_name[' + lastIndex + ']');
            $clonedRow.find('select[name^="field_type"]').attr('name', 'field_type[' + lastIndex + ']');
            $clonedRow.find('input[name^="value"]').attr('name', 'value[' + lastIndex + '][]');
            $clonedRow.find('input').each(function () {
                $(this).val('').attr('required', true);
                
            });
            $clonedRow.find('input[name^="value"]').attr('required', false);
            
            $('#form-container').append($clonedRow);
        });

        // Add value functionality
        $(document).on('click', '.addvalue', function () {
            var $newFieldRow = $(this).closest('.options_div').find('.fieldrow:first').clone();
            $newFieldRow.find('input').val('');
            $newFieldRow.find('input').attr('required', true);
            $newFieldRow.append('<button type="button" class="btn btn-danger removevalue mt-2">Remove</button>');
            $(this).closest('.options_div').find('.form-fieldrow').append($newFieldRow);
        });

        // Remove field functionality
        $(document).on('click', '.delete-field', function () {
            $(this).closest('.form-clone').remove();
        });

        // Remove value functionality
        $(document).on('click', '.removevalue', function () {
            $(this).closest('.fieldrow').remove();
        });

        // Initial visibility based on field type
        $('.field_type').each(function () {
            var selectedValue = $(this).val();
            var optionsDiv = $(this).closest('.form-row').find('.options_div');

            if (selectedValue === 'select' || selectedValue === 'checkbox' || selectedValue === 'radio') {
                optionsDiv.show();
            } else {
                optionsDiv.hide();
            }
        });
        
    });
</script>
@endsection
