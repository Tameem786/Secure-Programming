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