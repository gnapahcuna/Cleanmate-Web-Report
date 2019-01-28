// Check Even Handler For Select
var eventHandler = function (name) {
    return function () {
        console.log(name, arguments);
    };
};

function iconMenuOnMouseOver(element, src) {
    $(element).find("figure img").attr("src", src);
}

function iconMenuOnMouseOut(element, src) {
    $(element).find("figure img").attr("src", src);
}

function ResizeIframeLevel2(id) {
    var frame = document.getElementById(id);
    frame.height = frame.contentWindow.document.body.offsetHeight;
    frame.style.height = frame.contentWindow.document.body.offsetHeight + "px";
}

$(document).ready(function () {
    $(".modal.modal-recode1").on("shown.bs.modal", function (e) {
        if ($(".modal-body.modal-body-recode1").height() >= 290) {
            $(".modal-body.modal-body-recode1").css("overflow-y", "scroll");
            $(".modal-body.modal-body-recode1").css("overflow-x", "hidden");
            $(".modal-body.modal-body-recode1").css("padding-right", "10px");
        } else {
            $(".modal-body.modal-body-recode1").css("overflow-y", "visible");
            $(".modal-body.modal-body-recode1").css("overflow-x", "visible");
            $(".modal-body.modal-body-recode1").css("padding-right", "");
        }
    });

    // Load Tooltip
    $('.tooltipLink').tooltip({
        animation: true
    });

    // Load Select
    $('.select-default').selectize({
        create: false
    });

    $('.select-search').selectize({
        create: false,
        searchField: ['text', 'value'], // Option Search By Field
        onChange: eventHandler('onChange'),
        onItemAdd: eventHandler('onItemAdd'),
        onItemRemove: eventHandler('onItemRemove'),
        onOptionAdd: eventHandler('onOptionAdd'),
        onOptionRemove: eventHandler('onOptionRemove'),
        onDropdownOpen: eventHandler('onDropdownOpen'),
        onDropdownClose: eventHandler('onDropdownClose'),
        onInitialize: eventHandler('onInitialize')
    });

    // Load Text Area Autosize
    $('.textarea-autosize').autosize({append: "\n"});

    // Load DateTimePicker
    $('.dateTimePicker').datetimepicker({
        timepicker: true,
        datepicker: true,
        scrollMonth: false,
        scrollTime: false,
        scrollInput: false,
        format: 'd/m/Y H:i'
    });

    $('.dateTimePickerCall').click(function () {
        $('.dateTimePicker').datetimepicker('show');
    });

    // Load DateOnlyPicker
    $('.dateOnlyPicker').datetimepicker({
        timepicker: false,
        datepicker: true,
        scrollMonth: false,
        scrollTime: false,
        scrollInput: false,
        format: 'd/m/Y'
    });

    $('.dateOnlyPickerCall').click(function () {
        $('.dateOnlyPicker').datetimepicker('show');
    });

    // Load TimeOnlyPicker
    $('.timeOnlyPicker').datetimepicker({
        timepicker: true,
        datepicker: false,
        scrollMonth: false,
        scrollTime: false,
        scrollInput: false,
        format: 'H:i'
    });

    $('.timeOnlyPickerCall').click(function () {
        $('.timeOnlyPicker').datetimepicker('show');
    });

    $('input.icheck-square-green').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
        increaseArea: '20%' // optional
    });
});