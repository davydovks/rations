$(function() {
    $('input[name="daterange[]"]').daterangepicker({
        autoUpdateInput: false,
    });

    $('#periods').on('apply.daterangepicker', 'input[name="daterange[]"]', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY.MM.DD') + ' - ' + picker.endDate.format('YYYY.MM.DD'));
        const count = $(this).parent().children('input[name="daterange[]"]').length;
        if (count == $(this).data('num')) {
            const $input = $(`<input type="text" name="daterange[]" data-num="${count + 1}" /><br>`);
            $input.appendTo($(this).parent());
            $input.daterangepicker({autoUpdateInput: false});
        }
    });
});
