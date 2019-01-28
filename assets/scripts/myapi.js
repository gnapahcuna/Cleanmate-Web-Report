function NotifyMessage(message, messagetype) {
    if (messagetype == '0') {
        messagetype = 'success';
    } else if (messagetype == '1') {
        messagetype = 'warn';
    } else if (messagetype == '2') {
        messagetype = 'error';
    }

    $.notify(message, messagetype, {
        autoHideDelay: 5000
    });
}