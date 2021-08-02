require('./bootstrap');

/* #################
    DEF. SCRIPTS
################# */

/**
 * Catch and send the forms by ajax (axios)
 */
$('.form-type-ajax').submit(function (event) {
    event.preventDefault();

    var form = $(this)[0];
    var formData = new FormData(form);

    $(".form-errors").hide();
    $(".form-errors").html(null);

    axios({
        method: form.method,
        url: form.action,
        data: formData

    }).then((response) => {
        switch (response.data.succefulRequestAction) {
            case undefined:
                break;
            case 'nothing':
                break;
            case 'backWithCache':
                window.history.back();
                break;
            case 'back':
                window.location = document.referrer
                break;
            case 'reload':
                location.reload();
                break;
            default:
                break;
        }

    }).catch((err) => {
        if (err.response.data.errors !== undefined && !$.isEmptyObject(err.response.data.errors)) {
            for (const [key, value] of Object.entries(err.response.data.errors)) {
                $(".form-errors").append("<p>" + value + "</p>");
            }

        } else {
            $(".form-errors").append("<p>" + err.response.data.message + "</p>");
        }

        $(".form-errors").show();
    });
});

/**
 * Delete specific data from DB (axios)
 */
$('.btn-destroy-ajax').click(function (event) {
    const urlDelete = $(this).data('url');

    if(_.isNull(urlDelete)) {
        alert('Atributo data-url é requirido no button');
    }

    axios.delete(urlDelete).then((response) => {
        window.location.reload();

    }).catch((err) => {
        var errMsg = "";

        if(err.response.data.errors !== undefined && !$.isEmptyObject(err.response.data.errors)) {
            for (const [key, value] of Object.entries(err.response.data.errors)) {
                errMsg += value + "\n\r";
            }

            alert(errMsg);
        } else {
            alert(err.response.data.message);
        }
    });
});