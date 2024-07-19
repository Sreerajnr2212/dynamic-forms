$(document).ready(function() {
    $(document).on('click', '.addfield', function() {
        var $formContainer = $('#form-container');
        var $clonedRow = $('.form-clone:last').clone();
        var index = $formContainer.find('.form-clone').length;

        $clonedRow.attr('data-index', index);
        $clonedRow.find('input[name^="label"]').attr('name', 'label[' + index + ']');
        $clonedRow.find('input[name^="field_name"]').attr('name', 'field_name[' + index + ']');
        $clonedRow.find('select[name^="field_type"]').attr('name', 'field_type[' + index + ']');
        $clonedRow.find('input[name^="value"]').attr('name', 'value[' + index + '][]');
        
        $clonedRow.find('input').val('');
        $clonedRow.find('select').prop('selectedIndex', 0);
        $clonedRow.find('.options_div').hide();
        $clonedRow.find('.text-danger').remove();
        
        $clonedRow.find('.addfield').removeClass('addfield btn-primary').addClass('delete-field btn-danger').text('Delete Field');
        
        $formContainer.append($clonedRow);
    });

    $(document).on('click', '.addvalue', function() {
        var $newFieldRow = $(this).closest('.options_div').find('.fieldrow:first').clone();
        $newFieldRow.find('input').val('');
        $newFieldRow.append('<button type="button" class="btn btn-danger removevalue mt-2">Remove</button>');
        $(this).closest('.options_div').find('.form-fieldrow').append($newFieldRow);
    });

    $(document).on('click', '.delete-field', function() {
        $(this).closest('.form-clone').remove();
    });

    $(document).on('click', '.removevalue', function() {
        $(this).closest('.fieldrow').remove();
    });

    $(document).on('change', '.field_type', function() {
        var selectedValue = $(this).val();
        var optionsDiv = $(this).closest('.form-row').next('.options_div');
        
        if (selectedValue === 'select' || selectedValue === 'checkbox' || selectedValue === 'radio') {
            optionsDiv.show();
        } else {
            optionsDiv.hide();
        }
    });

    $('.field_type').each(function() {
        var selectedValue = $(this).val();
        var optionsDiv = $(this).closest('.form-row').next('.options_div');
        
        if (selectedValue === 'select' || selectedValue === 'checkbox' || selectedValue === 'radio') {
            optionsDiv.show();
        } else {
            optionsDiv.hide();
        }
    });
});