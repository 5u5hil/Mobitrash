$(document).ready(function () {
    $("#yesweight").click(function () {
        $("#weightpas").show();
    });
    $("#noweight").click(function () {
        $("#weightpas").hide();
    });
});

$(function () {
    $('.travel-date-group .default').datepicker({
        autoclose: true,
        startDate: "today",
    });

    $('.travel-date-group .today').datepicker({
        autoclose: true,
        startDate: "today",
        todayHighlight: true
    });

    $('.travel-date-group .past-enabled').datepicker({
        autoclose: true,
    });
    $('.travel-date-group .format').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
    });

    $('.travel-date-group .autoclose').datepicker();

    $('.travel-date-group .disabled-week').datepicker({
        autoclose: true,
        daysOfWeekDisabled: "0"
    });

    $('.travel-date-group .highlighted-week').datepicker({
        autoclose: true,
        daysOfWeekHighlighted: "0"
    });

    $('.travel-date-group .mnth').datepicker({
        autoclose: true,
        minViewMode: 1,
        format: "mm/yy"
    });

    $('.travel-date-group .multidate').datepicker({
        multidate: true,
        multidateSeparator: " , "
    });

    $('.travel-date-group .input-daterange').datepicker({
        autoclose: true
    });

    $('.travel-date-group .inline-calendar').datepicker();

    $('.datetimepicker').datetimepicker({
        showClose: true
    });

    $('.datetimepicker1').datetimepicker({
        format: 'LT',
        showClose: true
    });

    $('.datetimepicker2').datetimepicker({
        inline: true,
        sideBySide: true
    });

});