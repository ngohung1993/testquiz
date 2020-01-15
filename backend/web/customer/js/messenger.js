function showErrorMessage(msg) {
    Messenger({
        extraClasses: 'messenger-fixed messenger-on-right messenger-on-top',
        theme: 'flat'
    }).post({
        message: msg,
        type: 'error',
        showCloseButton: true
    });
}

function showSuccess(msg) {
    Messenger({
        extraClasses: 'messenger-fixed messenger-on-right messenger-on-top',
        theme: 'flat'
    }).post(msg);
}