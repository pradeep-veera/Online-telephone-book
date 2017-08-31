
$(document).ready(function(){
    $('.content-login').show()
	$('.content-left').hide
	$('.edit').hide();
	$('.level_hidden').hide();
	$('.Insert').hide();
	$('.hidden_sublevel_edit').hide();
	$('.orderby').hide()
	$('.edit_abteilung').hide();
	$('.Insert-abt').hide();
	$('.edit_Firma').hide();	
	$('.Insert-I').hide();
	$('.Insert_Bereich').hide();
	$('.edit_Bereich').hide();	

});	

	

function validateUser() {
    var x = document.forms["userlogin"]["fname"].value;
    var y = document.forms["userlogin"]["pname"].value;
    if ((x == "telefonbuch") &&(y =="#telNbrs")) {
		// cookie should be set
        return true;	
    }else {
		alert("Fehler bei der Anmeldung");
		return false;
	}	
}