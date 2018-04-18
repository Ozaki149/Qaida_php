function validate()
{
if( document.myForm.Name.value == "" )
{
alert( "Please provide your name!" );
document.myForm.Name.focus() ;
return false;
}
if( document.myForm.EMail.value == "" )
{
alert( "Please provide your Email!" );
document.myForm.EMail.focus() ;
return false;
}
if( document.myForm.pass.value == "" )
{
alert( "Please provide your Password!" );
document.myForm.pass.focus() ;
return false;
}
return( true );
}

function validateEmail()
{
var emailID = document.myForm.EMail.value;
atpos = emailID.indexOf("@");
dotpos = emailID.lastIndexOf(".");
if (atpos < 1 || ( dotpos - atpos < 2 ))
{
alert("Please enter correct email ID")
document.myForm.EMail.focus() ;
return false;
}
return( true );
}

function validatePass()
{
var pass = document.myForm.pass.value;
var rpass = document.myForm.rpass.value;
if (pass != rpass)
{
alert("Please enter re-enter password")
document.myForm.EMail.focus() ;
return false;
}
return( true );
}


function myFunction() {
	if(validate() && validatePass()){
    document.myForm.submit();
	}
}

function validate1()
{
if( document.myForm.Name.value == "" )
{
alert( "Please provide your Login!" );
document.myForm.Name.focus() ;
return false;
}
if( document.myForm.pass.value == "" )
{
alert( "Please provide your Password!" );
document.myForm.pass.focus() ;
return false;
}
return( true );
}

function myFunction1() {
	if(validate1()){
    document.myForm.submit();
	}
}