

/*	 ----------------------------------- 
	|									|
	|	GLOBAL VARIABLES 				|
	|									|
	 ----------------------------------- 
*/


// Constant

var debug=0;		// debug system (active in 1)
var isEdited = false;
var childWin = false;
var pass_='';
var version_;

/*	 ----------------------------------- 
	|									|
	|	PAGE CALL SYSTEM 				|
	|									|
	 ----------------------------------- 
*/



function menuAction( action, session, proj, link, page, filter ) {
	var hpos = window.screenX;
	var vpos = window.screenY;
	
	var position =  "top=" + vpos + ",left=" + hpos ;
	var xaction = "?action=" + action;
	var xsession= "&sess=" + session;
	var xproj   = "&project=" + proj ;
	var xlink	= "&link=" + link;
	getRef();
	var xpage	= "&page=" + page + "-" + session;
	var xfilter	= "&pass=" + filter;
	getRef();
	var xvers	= "&v=" + version_;

	// Prepare a reload system
	document.getElementById("reload_").value = "1";
	document.getElementById("reload_").ref = window.location.href;
	
	var url   =	"plusexec.php" + xaction + xsession + xproj + 
					xlink + xfilter + xpage + xvers;
	if ( debug == 1 ) {
		var atrib = "toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,"+
					"scrollbars=yes,resizable=yes,dependent=yes," + position;
	}
	else {
		var atrib = "chrome,dependent=yes," + position;
	}

	// Internal Procedure to logout
	if ( link == "logout_" ) {
		logout_( proj );
		return;
	}
	
	// Internal procedure to Reload
	if ( link == "reload_" ) {
		reload_();
		return;
	}

	// Internal procedure to print
	if ( link == "print_" ) {
		print_();
		return;
	}
	window.open( url, "page" + page, atrib ) ;
	
}


/*	callNew()		Call a new window										
	======================================================================*/
function callNew( action, session, proj, link, page, obj , xtra, sup, pgc, flt) {
	var hpos = window.screenX;
	var vpos = window.screenY;
	disableAcceptButton();
	
	var position =  "top=" + vpos + ",left=" + hpos ;
	var xaction = "?action=" + action;
	var xsession= "&sess=" + session;
	var xproj   = "&project=" + proj ;
	var xlink	= "&link=" + link;
	
	getRef();
	if( page.indexOf( '-' ) >= 0 ){
		var tmp=page.split("-");
		var xpage	= "&page=" + page;
	}
	else{
		var xpage	= "&page=" + page + "-" + session;
	}
	var xobj	= "&obj=" + obj;
	var xpgc	= "&pgc=" + pgc;
	var xvers	= "&v=" + version_;
	
    var xpass="";
	if( obj != undefined ){
	    obj+='';
		if (obj.indexOf( '&pass' ) < 0){
			var xpass	= "&pass=" + flt;
		}
	}

	if ( xtra != undefined ) {
		xsel = "&sel="+ xtra;
	}
	else{
		xsel = "";
	}
	if ( sup != undefined ) {
		xsup = "&sup="+ sup;
	}
	else{
		xsup = "";
	}
	var url   =	"plusexec.php" + xaction + xsession + xproj +
				xlink + xpage + xobj + xsel + xsup + xvers + xpgc + xpass;
	if ( debug == 1 ){				
		var atrib = "toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,"+
					"scrollbars=yes,resizable=no,dependent=yes," + position;
	}
	else {
		var atrib = "chrome,dependent=yes," + position;
	}

	// Prepare a reload system
	document.getElementById("reload_").value = "1";
	document.getElementById("reload_").ref = window.location.href;
	childWin = window.open( url, "page" + page, atrib ) ;

} // callNew() -------------------------------------------------------------


/*	callDoc()		Call a doc window										
	======================================================================*/
function callDoc( action, session, proj, link, page, obj , xtra, sup) {
	var hpos = window.screenX;
	var vpos = window.screenY;
	disableAcceptButton();
	getRef();
	var position =  "top=" + vpos + ",left=" + hpos ;
	var xaction = "?action=" + action;
	var xsession= "&sess=" + session_;
	var xproj   = "&project=" + project_ ;
	var xlink	= "&link=" + link;
	var xpage	= "&page=" + page;
	var xobj	= "&obj=" + obj;
	getRef();
	var xvers	= "&v=" + version_;
	if ( xtra != undefined ) {
		xsel = "&sel="+ xtra;
	}
	else{
		xsel = "";
	}
	xsup = "";
	
	var url   =	"plusdoc.php" + xaction + xsession + xproj + 
					xlink + xpage + xobj + xsel + xsup + xvers;
	var atrib = "toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,"+
				"scrollbars=yes,resizable=no,dependent=yes," + position;
	window.location.href=url;
} // callDoc() -------------------------------------------------------------


function internal( func, parameters, variable, value ) {

	var hpos = window.screenX + 150;
	var vpos = window.screenY + 250;
	disableAcceptButton();

	if ( func == "reload_" ) {
		reload_();
		return;
	}
	
	var position   	=  "top=" + vpos + ",left=" + hpos ;
	var xfunction  	= "?function=" + func;
	var xparameters	= "&par=" + parameters;
	var xvariable	= "&var=" + variable;
	var xvalue		= "&val=" + value;
	getRef();
	var xvers	= "&v=" + version_;
	var url   		=	"plusinternal.php" + xfunction + xparameters + 
						xvariable + xvalue + xvers;
	
						
	if ( debug == 0 ) {
		var atrib = "chrome,dependent=yes," + position;
		window.open( url, "internal", atrib ) ;
	}
	else {
		var atrib = "toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,"+
					"scrollbars=yes,resizable=no,dependent=yes," + position;
		window.open( url, "internal", atrib ) ;
	}
	
} // internal() -------------------------------------------------------------



/** logout_		Close the actual seccion and start a new login seccion
 *	==================================================================
 *
 * @parameters		proj	Name of actual project
 *
 */
 
function logout_( proj) {

	if ( confirm( QST_CLOSE_ ) ) {
		getRef();
		var xvers	= "&v=" + version_;
		var xsess   = "&sess=" + session_;
		var xaction = "?action=0&ok=0&project=" + proj + xsess + xvers;

		// Prepare a reload system
		document.getElementById("reload_").value = "1";
		document.getElementById("reload_").ref = "plus.php" + xaction;
		reload_();
	}
} // logout_() --------------------------------------------------------------



/** loginCmd	Call the main program to log user with the entry data 
 */
 
function loginCmd( proj ) {
	var user = document.getElementById( 'loginUser' ).value; 
	var pass = document.getElementById( 'loginPass' ).value; 
	window.location.href="plus.php?action=2&user=" + user + 
	"&pass="+ pass + "&project=" + proj ;
} // ------------------------------------------------------------------------



/**	validate	Call a validate System
 *	==================================
 */
 
function validate( action, session, proj, link, page, obj ) {

	var xaction = "?action=" + action;
	var xsession= "&sess=" + session;
	var xproj   = "&project=" + proj ;
	var xlink	= "&link=" + link;
	var xpage	= "&page=" + page;
	var xobj	= "&obj=" + obj;
	getRef();
	var xvers	= "&v=" + version_;
	var url   =	"plusvalidate.php" + xaction + xsession + xproj + 
						xlink + xpage + xobj + xvers;

	// Prepare a return system
	document.getElementById("return_").value = "none";
							
	if ( debug == 0 ) {

		req = new XMLHttpRequest();		// RPC request variable
		req.onreadystatechange = processReqChange;
		req.open("GET", url, true );
		req.send( null );
		
	}
	else {
		var atrib = "toolbar=yes,location=yes,directories=yes,status=yes," +
					"menubar=yes,scrollbars=yes,resizable=no,dependent=yes";
		window.open( url, "page" + page, atrib ) ;
	}
	
} // validate() ------------------------------------------------------------


/*	 ----------------------------------- 
	|									|
	|	GENERIC FUNCTIONS				|
	|									|
	 ----------------------------------- 
*/

function starting() {
	var hpos = window.screenX;
	var vpos = window.screenY;
	alert ("tonterias");
	alert( window.heigth +","+ window.width );
	window.resizeTo( resh, resv);
	window.moveTo( hpos, vpos );
	
} // starting() -------------------------------------------------------------



/**	Prepare a reload system
 *
 */
function prepare_reload() {	

	document.getElementById("reload_").value = "1";
	document.getElementById("reload_").ref = window.location.href;
} // ------------------------------------------------------------------------


function reload_() {
	try{
	    window.parent.enableVal();
		window.parent.preValidation();
	}
	catch(e){
	}
	try {
		if( operation == 5 ){
			try {
				var top = window.top.name;
				var parent = window.parent.name;
				top.focus();
				parent.focus();
			}
			catch(e){
				//
			}
		}
	}
	catch(e){
		//
	}
	try {
		var rld = document.getElementById("reload_").value;
	} 
	catch( e ) {
		return;
	}
	try{
		if( operation != undefined ){
			setTimeout("preValidation()",200);
		}
	}
	catch(e){
		//
	}

	if ( rld == false ) {
		return;
	}
	
	if ( rld == "1" ) {
		actual=  document.getElementById("reload_").ref;
		if ( actual != undefined ) {
			window.location.href = actual;
			return;
		}
		else {
			alert ("undefined actual");
		}
	}
	//enableVal();
	preValidation();
		
} // reload_() ---------------------------------------------------------------

function callpreValidation(){

// ># 29 - New preValidation control system  ////////////////////

	// One process is running, and other in wait state
	if( vFlag >=2 ){
		return;
	}
	
	// One process is running
	if( vFlag == 1 ){
		vFlag++;	// Prepare a wait state to this process
		return
	}
	
	// Star a new process
	vFlag++;

	preValidation();
	
// <# 29 /////////////////////////////////////////////////////////

}


/**	Debug		Says a debug message
 *	======================================================================*/

function Debug( mess ) {
	try{
		var elem = document.getElementById('debug_');
		elem.setAttribute('value', mess );
		elem.removeAttribute('hidden');	
	}
	catch(e){
		//
	}
} // Debug() ---------------------------------------------------------------


function releases( version ) {
	var xaction = "?action=" + 21;
	var url   =	"plus.php" + xaction ;
	var atrib = "chrome,scrollbars";
	window.open( url, "releases", atrib ) ;
} // releases() -------------------------------------------------------------


/**	goBack()		Go to Back on the page									
	======================================================================*/
	
function goBack() {
	
	previous = window.parent.name;
	
	if ( isEdited == true ) {
		if ( ! confirm ( QST_BACK_ )) {
			return;
		}
	}	
	
	self.close();

} // goBack() --------------------------------------------------------------


/**	getRef		Get a reference of a session and proyect					
==========================================================================*/	
function getRef () {
	temp  = document.location.href;
//alert(temp);
	temp1 = temp.split("?");
	temp  = temp1[1];
	temp1 = temp.split("&");
	for ( i=0; i< temp1.length; i++ ) {
		temp2 = temp1[i].split("=");
		if ( temp2[0] == "project" ) {
			project_ = temp2[1];
		}
		if ( temp2[0] == "sess" ) {
			session_ = temp2[1];
		}
		if( temp2[0] == "v" ) {
			version_ = temp2[1];
		}
		if( temp2[0] == "action" ) {
			action_ = temp2[1];
		}
		if( temp2[0] == "pass" ) {
			pass_ = temp2[1];
			for( var x=2; x<=10; x++){
				if( temp2[x]!=undefined ){
					pass_ += "="+temp2[x];
				}
			}
		}
	}
} // getRef() --------------------------------------------------------------



/**	print_		Prints an actual page					
==========================================================================*/	
function print_() {
	getRef();
	if( action_ == 0 ) {
		alert( MSG_NOTPRINT_ );
		return;	
	}
	url  = document.location.href+"&print=1";
	var atrib = "toolbar=no,location=no,directories=no,status=no," +
				"menubar=no,scrollbars=no,resizable=no";
	window.open( url, "print", atrib );

} // getRef() --------------------------------------------------------------



/** 
 * 	disableAcceptButton		Disable a button "accept"
 *
 */

function disableAcceptButton() {		
	var xbutton = document.getElementById("acceptbutton");
	if( xbutton != undefined ){
		document.getElementById("acceptbutton").setAttribute('hidden', 'true');
		acceptButton = false;
	}
	return true;
} // disableAcceptButton() -------------------------------------------------


/** 
 * 	enableAcceptButton		Enable a button "accept"
 *
 */

function enableAcceptButton() {		
	var xbutton = document.getElementById("acceptbutton");
	if( xbutton != undefined ){
		document.getElementById("acceptbutton").removeAttribute('hidden');
		acceptButton = true;
	}
	return true;
} // enableAcceptButton() -------------------------------------------------



/** 
 * 	disableInsConsButton		Disable a button "accept"
 *
 */

function disableInsConsButton() {		
	var xbutton = document.getElementById("insconsbutton");
	if( xbutton != undefined ){
		document.getElementById("insconsbutton").setAttribute('hidden', 'true');
		acceptButton = false;
	}
	return true;
} // disableInsConsButton() ------------------------------------------------


/** 
 * 	enableInsConsButton		Enable a button "accept"
 *
 */

function enableInsConsButton() {		
	var xbutton = document.getElementById("insconsbutton");
	if( xbutton != undefined ){
		document.getElementById("insconsbutton").removeAttribute('hidden');
		acceptButton = true;
	}
	return true;
} // enableInsConsButton() --------------------------------------------------


/** 
 * 	disableBackButton		Disable a button "Back"
 *
 */

function disableBackButton() {		
	var xbutton = document.getElementById("closebutton");
	if( xbutton != undefined ){
		document.getElementById("closebutton").setAttribute('hidden', 'true');
	}
	return true;
} // disableBackButton() ---------------------------------------------------


/** 
 * 	enableBackButton		Enable a button "Back"
 *
 */

function enableBackButton() {		
	var xbutton = document.getElementById("closebutton");
	if( xbutton != undefined ){
		document.getElementById("closebutton").removeAttribute('hidden');
	}
	return true;
} // enableCloseButton() --------------------------------------------------


/** 
 * 	enableMessageButton		Enable a button "Message"
 *
 */
function enableMessageButton( message, time ) {		
	document.getElementById("messagebutton").removeAttribute('hidden');
	document.getElementById("messagebutton").setAttribute('label', message);
	if( time!= undefined ){
		setTimeout('disableMessageButton()',time);
	}
	return true;
} // enableMesageButton() --------------------------------------------------

/** 
 * 	disableMessageButton		Enable a button "Message"
 *
 */
function disableMessageButton( message ) {		
	document.getElementById("messagebutton").setAttribute('hidden',true);
	return true;
} // disableMesageButton() --------------------------------------------------


/** 
 * 	disableChangeButton		Disables a button "Change"
 *
 */
function disableChangeButton() {		
	var xbutton = document.getElementById("enableChange");
	if( xbutton != undefined ){
		document.getElementById("enableChange").setAttribute('hidden', 'true');
	}
	return true;
} // disablechangeButton() -------------------------------------------------

/** 
 * 	enableChangeButton		Enables a button "Change"
 *
 */
function enableChangeButton() {		
	var xbutton = document.getElementById("enableChange");
	if( xbutton != undefined ){
		document.getElementById("enableChange").removeAttribute('hidden');
	}
	return true;
} // enablechangeButton() --------------------------------------------------


/** 
 * 	disableDeleteButton		Disables a button "Delete"
 *
 */
function disableDeleteButton() {		
	var xbutton = document.getElementById("deletebutton");
	if( xbutton != undefined ){
		document.getElementById("deletebutton").setAttribute('hidden', 'true');
	}
	return true;
} // disableDeleteButton() -------------------------------------------------

/** 
 * 	enableDeleteButton		Enables a button "Delete"
 *
 */
function enableDeleteButton() {		
	var xbutton = document.getElementById("deletebutton");
	if( xbutton != undefined ){
		document.getElementById("deletebutton").removeAttribute('hidden');
	}
	return true;
} // enableDeleteButton() --------------------------------------------------


/*
* by Doglas A. Dembogurski Function to load other javascript files
*/
function loadScript(url){

   var script = document.createElement("script")
   script.type = "text/javascript";
   script.onload = function(){
     //callback();
   }; 
 
 script.src = url;
 document.getElementsByTagName("head")[0].appendChild(script);
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}