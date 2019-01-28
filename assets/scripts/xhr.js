
function xhr_request(_url, _method, _param, _callback) {
    $.ajax({
        type: "POST",
        url: _url + '/' + _method,
        data: (_param) ? JSON.stringify(_param) : "",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        async: true,
        beforeSend: function () {

        },
        success: function (response) {
            if (response.d != null) {
                _callback($.parseJSON(response.d.replace(/\u0009/g, '')));
                //_callback();
            } else {
                _callback();
            }
        },
        error: function (request, status, error) {

            var responseText = $.parseJSON(request.responseText);
            alert(responseText.Message);
            //hide_Preloader();
                        if (_callback) {
                            _callback();
                        }

                        if (window.parent) {
                            if (window.parent.NotifyMessage) {
                                //window.parent.NotifyMessage({ message: responseText.Message, type: '1' });

                            }
                            else if (window.parent.parent.NotifyMessage) {
                                //window.parent.parent.NotifyMessage({ message: responseText.Message, type: '1' });
                            }
                        }

        }
    });
}

function xhr_request_sync(_url, _method, _param) {
    strReturn = null;
    $.ajax({
        type: "POST",
        url: _url + '/' + _method,
        data: (_param) ? JSON.stringify(_param) : "",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        success: function (response) {
            strReturn = eval("(" + response.d + ")");
        },
        error: function (request, status, error) {
            var responseText = $.parseJSON(request.responseText);

            if (window.parent) {
                if (window.parent.NotifyMessage) {
                    window.parent.NotifyMessage({ message: responseText.Message, type: '1' });
                }
                else if (window.parent.parent.NotifyMessage) {
                    window.parent.parent.NotifyMessage({ message: responseText.Message, type: '1' });
                }
            }
        }
    });

    return strReturn;
}

function xhr_request_text(_url, _method, _param) {
    strReturn = null;
    $.ajax({
        type: "POST",
        url: _url + '/' + _method,
        data: (_param) ? JSON.stringify(_param) : "",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        success: function (response) {
            strReturn = response.d;
        },
        error: function (request, status, error) {
            var responseText = $.parseJSON(request.responseText);

            if (window.parent) {
                if (window.parent.NotifyMessage) {
                    window.parent.NotifyMessage({ message: responseText.Message, type: '1' });
                }
                else if (window.parent.parent.NotifyMessage) {
                    window.parent.parent.NotifyMessage({ message: responseText.Message, type: '1' });
                }
            }
        }
    });

    return strReturn;
}

function show_Preloader() {
    if (window.parent) {
        if (window.parent.showPreloader) {
            window.parent.showPreloader();
        } else if (window.parent.parent.showPreloader) {
            window.parent.parent.showPreloader();
        }
    }
}

function hide_Preloader() {
    if (window.parent) {
        if (window.parent.hidePreloader) {
            window.parent.hidePreloader();
        } else if (window.parent.parent.hidePreloader) {
            window.parent.parent.hidePreloader();
        }
    }
}

function showPreloader() {
    if (window.parent) {
        if (window.parent.showPreloader) {
            window.parent.showPreloader();
        } else if (window.parent.parent.showPreloader) {
            window.parent.parent.showPreloader();
        }
    }
}

function hidePreloader() {
    if (window.parent) {
        if (window.parent.hidePreloader) {
            window.parent.hidePreloader();
        } else if (window.parent.parent.hidePreloader) {
            window.parent.parent.hidePreloader();
        }
    }
}








