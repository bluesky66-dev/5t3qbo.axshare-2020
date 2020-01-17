
function upsign() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("insign").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "signup.html", true);
    xhttp.send();
}
function forgotpass() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("insign").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "forgot.html", true);
    xhttp.send();
}
function never() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("insign").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "sign-in.html", true);
    xhttp.send();
}
function square1() {
    $.ajax({
        method: "GET",
        url: "square1.html",
    }).done(function( responseText ) {
        $('#text-area').text(responseText);
    });
}
function square2() {

    $.ajax({
        method: "GET",
        url: "square2.html",
    }).done(function( responseText ) {
        $('#text-area').text(responseText);
    });
}
function square3() {

    $.ajax({
        method: "GET",
        url: "square3.html",
    }).done(function( responseText ) {
        $('#text-area').text(responseText);
    });
}

function square1_cover() {
    $.ajax({
        method: "GET",
        url: "square1-cover.html",
    }).done(function( responseText ) {
        $('#text-area').text(responseText);
    });
}
function square2_cover() {

    $.ajax({
        method: "GET",
        url: "square2-cover.html",
    }).done(function( responseText ) {
        $('#text-area').text(responseText);
    });
}
function square3_cover() {

    $.ajax({
        method: "GET",
        url: "square3-cover.html",
    }).done(function( responseText ) {
        $('#text-area').text(responseText);
    });
}

    function view_overlay() {
        $('.overlay').css('display', 'block') ;

    }
    function view_overlay_reject() {
        $('.overlay-reject').css('display', 'block');

    }
function hide_overlay() {
    $('.overlay').css('display', 'none');
    $('.overlay-reject').css('display', 'none');
}

function hide_overlay_reject() {
    $('.overlay-reject').css('display', 'none');

}

function view_overlay_home() {
    $('.overlay-home').css('display', 'block');
}

function hide_overlay_home() {
    $('.overlay-home').css('display', 'none');
}
validateEmail('newtheme@outlook.com');
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
function validateEmai2(email_number) {
    var re1 = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re1.test(String(email_number).toLowerCase());
}
function user_name1(user_name) {
    var name=/^[A-Za-z\s]+$/;
    return name.test(user_name);
}


if (typeof Stripe !== "undefined") {
    var stripe = Stripe('pk_test_Q1zE6Ng0BGqpUE4vv0h3gvqj00EL6S0bkW');
}

function read(show) {
    if (show) {
        $("#about_result").css('display', 'block');
        $("#about_result").css('font-size', '13px');
        $("#about_result").css('font-weight', '400');
    }  else {
        $("#about_result").css('display', 'none');
    }




}

function read1(show) {
    if (show) {
        $("#about_result1").css('display', 'block');
        $("#about_result1").css('font-size', '13px');
        $("#about_result1").css('font-weight', '400');
    }  else {
        $("#about_result1").css('display', 'none');
    }
}

function sendEmail() {//var $result = $("#result");
    var formData = window.localStorage.getItem('formData');//payment hours account get
    formData = JSON.parse(formData);
    var email = formData.email;
    var user_name = formData.user_name;
    var email_number = formData.email_number;
    var legal_problem = formData.legal_problem;
    var when_come = formData.when_come;
    var hours = formData.hours;
    // test
    $.ajax({
        method: "POST",
        url: "https://nolawyer.org.uk/contact-submit.php",
        dataType: "json",
        data: {
            userName: user_name,
            userEmail: email,
            emailNumber: email_number,
            legal_problem: legal_problem,
            userTime:when_come,
            userHours:hours
        }
    }).done(function( result ) {
        var $resultDiv = $(".contact-result");
        $resultDiv.show();
        $resultDiv.removeClass("text-success text-danger");
        if (result.type === "error") {
            $resultDiv.addClass("text-danger");
            $resultDiv.text(result.text);
        } else {
            $('#contact-form').reset();
            $resultDiv.addClass("text-success");
            $resultDiv.text("Thank you, your message has been sent successfully.");
        }
    });
}

$(document).ready(function () {

    // if (typeof validate !== 'undefined') {
    //     var validator = $('#contact-form').validate({
    //         rules: {
    //             user_name: {
    //                 required: true
    //             },
    //             email: {
    //                 required: true,
    //                 email: true
    //             },
    //             email_number: {
    //                 required: true,
    //                 number: true
    //             },
    //             legal_problem: {
    //                 required: true,
    //             },
    //             when_come: {
    //                 required: true,
    //             },
    //             hours: {
    //                 required: true,
    //             },
    //
    //         },
    //         errorElement : 'div',
    //         errorLabelContainer: '.errorTxt',
    //         submitHandler: function(form) {
    //             // some other code
    //             // maybe disabling submit button
    //             // then:
    //             var email = $("#email").val();
    //             var user_name = $("#user_name").val();
    //             var email_number = $("#email_number").val();
    //             var legal_problem = $("#legal_problem").val();
    //             var when_come = $("#when_come").val();
    //             var hours = $("#hours").val();
    //             var stripe = Stripe("pk_test_Q1zE6Ng0BGqpUE4vv0h3gvqj00EL6S0bkW"); //payment
    //
    //             var formData = {
    //                 email: email,
    //                 user_name: user_name,
    //                 email_number: email_number,
    //                 legal_problem: legal_problem,
    //                 when_come: when_come,
    //                 hours: hours,
    //             };
    //
    //             console.log('formData', formData);
    //
    //             window.localStorage.setItem('formData', JSON.stringify(formData)); //payment set
    //             // alert("ok");
    //
    //
    //
    //             console.log('checkout', validator);
    //             if (typeof stripe !== "undefined") { //undefined next
    //                 stripe.redirectToCheckout({
    //                     items: [{sku: 'sku_GPn9Mb0xZnqcYo', quantity: parseInt(hours)}],
    //
    //                     // Do not rely on the redirect to the successUrl for fulfilling
    //                     // purchases, customers may not always reach the success_url after
    //                     // a success    ful payment.
    //                     // Instead use one of the strategies described in
    //                     // https://stripe.com/docs/payments/checkout/fulfillment
    //                     successUrl: 'https://bluesky66-dev.github.io/nolaywer.co.uk/Book_Consultation.html',
    //                     cancelUrl: 'https://bluesky66-dev.github.io/nolaywer.co.uk/canceled.html',
    //                 })
    //                     .then(function (result) {
    //                         if (result.error) {
    //                             // If `redirectToCheckout` fails due to a browser or network
    //                             // error, display the localized error message to your customer.
    //                             var displayError = document.getElementById('error-message');
    //                             displayError.textContent = result.error.message;
    //                             alert(result.error.message)
    //                         } else {
    //                             console.log('checkout', result);
    //                             sendEmail();
    //                         }
    //                     });
    //             }
    //         },
    //         invalidHandler: function (e, validator) {
    //             // $("div.error").hide();
    //         },
    //     });
    // }
    // if (typeof daterangepicker !== 'undefined') {
    //     $('#when_come').daterangepicker({  /*calendar*/
    //         singleDatePicker: true,
    //         // showDropdowns: true,
    //         // minYear: 1901,
    //         // maxYear: parseInt(moment().format('YYYY'),10)com
    //     }, function(start, end, label) {
    //         var years = moment().diff(start, 'years');
    //         console.log("You are " + years + " years old!");
    //     });
    // }
    $("#square1_cover").click(function () {
        square1_cover(true);
    });
    $("#square2_cover").click(function () {
        square2_cover(true);
    });
    $("#square3_cover").click(function () {
        square3_cover(true);
    });
    $("#home-link").click(function () {
        view_overlay_home(true);
    });
    $("#interview").click(function () {
        view_overlay(true);
    });
    $("#reject").click(function () {
        view_overlay_reject(true);
    });
    $("#square1").click(function () {
        square1(true);
    });
    $("#square2").click(function () {
        square2(true);
    });
    $("#square3").click(function () {
        square3(true);
    });




    $("#never").click(function () {
        never(true);
    });
    $("#upsign").click(function () {
        upsign(true);
    });
    $("#forgot").click(function () {
        forgotpass(true);
    });
    $('#when_come').data('datepicker');

     $("#read").click(function () {
        read(true);
    });
    $("#read1").click(function () {
        read1(true);
    });
});


