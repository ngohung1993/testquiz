$('input#currency-fields').on('blur', function () {
    const value = this.value.replace(/,/g, '');
    this.value = parseFloat(value).toLocaleString('en-US', {
        style: 'decimal',
        maximumFractionDigits: 0,
        minimumFractionDigits: 0
    });
});
function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
        });
    });
}
setInputFilter(document.getElementById("currency-fields"), function(value) {
    return /^\d*$/.test(value); });

function validateFormDeal() {
    let money = $('#currency-fields').val();
    let wallet = $('#wallet_user').val();
    let account = $('#account_user').val();
    let minimum = $('#minimum_money_wallet').val();

    var find = ',';
    var re = new RegExp(find, 'g');
    str = money.replace(re, '');

    cod = parseInt(str, 10);
    wallet = parseInt(wallet, 10);

    if (!account) {
        $('.note').css('display', 'block');
        $('#note-account').css('display', 'block');
        return false;
    } else {
        $('#note-account').css('display', 'none');
    }

    if (!money) {
        $('.note').css('display', 'block');
        $('#note-money').css('display', 'block');
        return false;
    } else {
        $('#note-money').css('display', 'none');
    }

    if (!Number.isInteger(cod)) {
        $('.note').css('display', 'block');
        $('#note-check-money').css('display', 'block');
        return false;
    } else {
        $('#note-check-money').css('display', 'none');
    }

    if (cod < 20000) {
        $('.note').css('display', 'block');
        $('#note-minimum-money').css('display', 'block');
        return false;
    } else {
        $('#note-minimum-money').css('display', 'none');
    }



    if (cod > wallet) {
        $('.note').css('display', 'block');
        $('#compare-money').css('display', 'block');
        return false;
    } else {
        $('#compare-money').css('display', 'none');
    }

    if (!$('#content-message').val()) {
        $('.note').css('display', 'block');
        $('#content-deal').css('display', 'block');
        return false;
    } else {
        $('#content-deal').css('display', 'none');
    }

    if(wallet - cod < minimum ){
        $('.note').css('display', 'block');
        $('#minimum_amount_wallet_user').css('display', 'block');
        return false;
    }else{
        $('#minimum_amount_wallet_user').css('display', 'none');
    }

    $('.note').css('display', 'none');
    return true;
}