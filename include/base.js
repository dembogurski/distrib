
/** base.js		The most basic function system of plus						
	======================================================================*/

	//////////////////////
	//					//
	//  BAD DOCUMENTED  //
	//					//
	//////////////////////


debug = 0;



/** loginCmd	Call the main program to log user with the entry data 
 */
 
function loginCmd( proj ) {
	var user = document.getElementById( 'loginUser' ).value; 
	var pass = document.getElementById( 'loginPass' ).value; 
	
	document.getElementById( 'loginUser' ).setAttribute("readonly","true"); 
	document.getElementById( 'loginPass' ).setAttribute("readonly","true"); 
	document.getElementById( 'login' ).setAttribute("hidden","true"); 
	
	enableMessageButton('Actualizando Base de Datos... Aguarde...');
	window.location.href="plus.php?action=2&user=" + user + 
	"&pass="+ pass + "&project=" + proj ;
} // ------------------------------------------------------------------------

/** 
 * 	enableMessageButton		Enables a button "Message"
 *
 */
function enableMessageButton( message ) {		
	document.getElementById("messagebutton").removeAttribute('hidden');
	document.getElementById("messagebutton").setAttribute('label', message);
} // enableMesageButton() --------------------------------------------------



/** gotoPlus	Call the main program, with the specificated parameters
 * 
 * @parameter	act		number of the action (look the define in plus.php)
 * @parameter	ok 		number of user logged in the system
 * @parameter 	proj	name of the actual project
 */
 
function gotoPlus( act, ok, proj ) {
	var xaction = "?action=" + act;
	var xuser   = "&ok=" + ok;
	var xproj   = '&project=' + proj;
	var hpos = window.screenX;
	var vpos = window.screenY;
	var position =  "top=" + vpos + ",left=" + hpos ;

	var atrib = "chrome,dependent=yes," + position;
	window.location.href="plus.php" + xaction + xuser + xproj;
} // ------------------------------------------------------------------------
 
 
 
 function checkSecure() {
 		temp  = document.location.href;
		alert( temp );

 } // checkSecure() ---------------------------------------------------------
 
 
 
 
/**	getRef		Get a reference of a session and proyect					
==========================================================================*/	
function getRef () {
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
	}
} // getRef() --------------------------------------------------------------


/** gotoPlusexec	Call the main program, with the specificated parameters
 * 
 * @parameter	act		number of the action (look the define in plus.php)
 * @parameter	ok 		number of user logged in the system
 * @parameter 	proj	name of the actual project
 */
 
function gotoPlusexec( act, session, proj, version ) {
	var xaction = "?action=" + act;
	var xsess   = "&sess=" + session;
	var xproj   = '&project=' + proj ;
	var xvers   = '&v=' + version;	
	window.location.href="plusexec.php" + xaction + xsess + xproj + xvers;
} // ------------------------------------------------------------------------



function starting() {
} // starting() -------------------------------------------------------------


/** reload_()		Reload control - ONLY FOR THE FIRST PAGE
 *	======================================================================*/

function reload_() {
	try {
		var rld = document.getElementById("reload_").value;
	} 
	catch( e ) {
		return;
	}
	if ( rld == false ) {
		return;
	}
	
	if ( rld == "1" ) {
		//document.location.reload();
		actual=  document.getElementById("reload_").ref;
		if ( actual != undefined ) {
			window.location.href = actual;
			return;
		}
		else {
			alert ("undefined actual");
		}
	}
} // reload() ---------------------------------------------------------------



