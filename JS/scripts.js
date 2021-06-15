function validateForm(){
    var accountNumber = document.forms["login"]["account"].value;
    var pinNumber = document.forms["login"]["pin"].value;
    if(isNaN(accountNumber) || accountNumber.length != 10){
        alert('Enter valid Account Number');
        return false;
    }
    if(isNaN(pinNumber) || pinNumber.length != 8){
        alert('Enter valid PIN number');
        return false;
    }
}

// function ValidateSignUpForm(){
//     var fullname = document.forms["signup"]["fullname"].value;
//     var email = document.forms["signup"]["emailaddress"].value;
//     if(fullname.length > 20){
//         alert('Enter valid Account Number');
//         return false;
//     }
//     if(pinNumber.length != 8){
//         alert('Enter valid PIN number');
//         return false;
//     }
// }


function validateSignUp(){
    var fullname = document.forms["signup"]["fullname"].value;
    var email = document.forms["signup"]["emailaddress"].value;
    
}

