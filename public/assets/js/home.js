$(document).ready(function () {
    $("#loginform").submit(function (e) {

        var captch_error = ValidCaptcha();
        console.log(captch_error);
        if (captch_error == false) {
            $("#cap_error").html('Please enter valid captcha');
            return false;
        } else {
            $("#cap_error").html('');

            e.preventDefault();
            $.ajax({
                // dataType: 'json',
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (result) {

                    var error = result.message;
                    if (result.success == 0) {
                        $("#error").html(error);
                    } else {
                        window.location.href = "/dashboard";

                    }
                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connected. Verify network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Error, please try again';
                    }
                    alert(msg)
                }

            });
        }
    })

})

// Register form submit
$(document).ready(function () {
    $("#register_form").submit(function (e) {
        e.preventDefault();
        var captch_error = ValidCaptcha1();
        
        if (captch_error == false) {
            $("#cap_error1").html('Please enter valid captcha');
            return false;
        } else {
            $("#cap_error1").html('');

            e.preventDefault();
            $.ajax({
                // dataType: 'json',
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (result) {

                  
                    var message = result.message;
                    console.log(message);
                    if (result.status == 1) {
                        $("#success").html(message);
                        // setInterval(function(){ location.reload();}, 4000);
                    } else {
                        
                    }
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                    
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connected. Verify network.';
                        alert(msg)
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                        alert(msg)
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                        alert(msg)
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                        alert(msg)
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                        alert(msg)
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                        alert(msg)
                    } else {
                        $("#error1").html('The email has already been taken');
                    }
                  
                }

            });
        }
    })

})


function Captcha() {
    var alpha = new Array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    var i;
    for (i = 0; i < 6; i++) {
        var a = alpha[Math.floor(Math.random() * alpha.length)];
        var b = alpha[Math.floor(Math.random() * alpha.length)];
        var c = alpha[Math.floor(Math.random() * alpha.length)];
        var d = alpha[Math.floor(Math.random() * alpha.length)];
        var e = alpha[Math.floor(Math.random() * alpha.length)];
        var f = alpha[Math.floor(Math.random() * alpha.length)];
    }
    var code = a + '' + b + '' + '' + c + '' + d + '' + e + '' + f;
    document.getElementById("mainCaptcha").innerHTML = code
    document.getElementById("mainCaptcha").value = code
}
function ValidCaptcha() {
    var string1 = removeSpaces(document.getElementById('mainCaptcha').value);
    var string2 = removeSpaces(document.getElementById('txtInput').value);
    if (string1 == string2) {
        return true;
    } else {
        return false;
    }
}

function Captcha1() {
    var alpha = new Array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    var i;
    for (i = 0; i < 6; i++) {
        var a = alpha[Math.floor(Math.random() * alpha.length)];
        var b = alpha[Math.floor(Math.random() * alpha.length)];
        var c = alpha[Math.floor(Math.random() * alpha.length)];
        var d = alpha[Math.floor(Math.random() * alpha.length)];
        var e = alpha[Math.floor(Math.random() * alpha.length)];
        var f = alpha[Math.floor(Math.random() * alpha.length)];
    }
    var code = a + '' + b + '' + '' + c + '' + d + '' + e + '' + f;
    document.getElementById("mainCaptcha1").innerHTML = code
    document.getElementById("mainCaptcha1").value = code
}
function ValidCaptcha1() {
    var string1 = removeSpaces(document.getElementById('mainCaptcha1').value);
    var string2 = removeSpaces(document.getElementById('txtInput1').value);
    if (string1 == string2) {
        return true;
    } else {
        return false;
    }
}


function removeSpaces(string) {
    return string.split(' ').join('');
}

function start() {
    Captcha1();
    Captcha();
}