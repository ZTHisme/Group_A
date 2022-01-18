$(function () {
    $('#attendances').DataTable();
    $('#leave').on('change', function () {
        // sets the 'disabled' property to false (if the 'this' is checked, true if not):
        $('input[type=radio').prop('disabled', this.checked);
        // triggers the change event (so the disabled property is set on page-load:
    });
});