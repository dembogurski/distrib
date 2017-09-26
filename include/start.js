
/**	start.js	The starts functions of plus systema
 *	========================================================================
 *	@author		Sergio Antonio Pohlmann <sergio@ycube.net>
 *	@date		october, 21 of 2005
 */
 


var project_='plus';
var page  = document.location.href;
orig_page=page;
var isFirefox = false;
var SO = "other";

if( navigator.userAgent.indexOf("Firefox") != -1){
	isFirefox = true;
} 
if( navigator.userAgent.indexOf("Win") != -1){
	SO = "Windows";
} 
if( navigator.userAgent.indexOf("Lin") != -1){
	SO = "Linux";
} 
if( navigator.userAgent.indexOf("Mac") != -1){
	SO = "Macintosh";
} 
if( ! isFirefox ){
	document.write("<BR />");
	document.write("<H1><B>ATENCIÓN</B></H1><P /><H3>");
	document.write("Su navegador no soporta los recursos del sistema.<P />");
	document.write("Si tiene instalado un navegador tipo <U>Mozilla Firefox,</U> "+
					"experimente llamar el sistema a través de dicho navegador.<P />");
	document.write("Caso contrario, podrá acceder a un instalador para su sistema Operativo <I>(");
	document.write( SO+")</I> haciendo click en el logo abajo<P />");
	if( SO == "Windows" ){
		document.write("<CENTER><A HREF=\"./install/Firefox Setup 1.5.exe\" " +
					    "> <IMG SRC='./install/Firefox_Banner_Horizontal.jpg'></A>"+
					    "</CENTER>");
		document.write("<P /><P />Además, podrás instalar el ");
		document.write("<A HREF=\"./install/ar500enu.exe\" " +
					    "><I>Adobe Acrobar Reader(R)</I> </A>");
		document.write(" en su equipo.");
	}

	if( SO == "Macintosh" ){
		document.write("<CENTER><A HREF=\"./install/Firefox 1.5.dmg\" " +
					    "> <IMG SRC='./install/Firefox_Banner_Horizontal.jpg'></A>"+
					    "</CENTER>");
	}

	if( ( SO == "Linux" ) || ( SO == "other" ) ){
		document.write("<CENTER><A HREF='www.getfirefox.com' " +
					    "> <IMG SRC='./install/Firefox_Banner_Horizontal.jpg'></A>"+
					    "</CENTER>");
	}

	document.write("</H3>.");
	document.write("<P /><P /><I><CENTER>ycube.net team</CENTER></I>");
}
else {
	document.write("<P />Solamente cierre esta página cuando desee cerrar completamente el sistema.<P />");
	document.write("<P />Si necesitas reabrir el sistema, simplespente presione el botón de recargar!<P />");
//	page = page.replace( /https/g,'http');
//	page = page.replace( /http/g,'https');
	if( page.indexOf("index.php") != -1){
		page = page.replace( /index/g,'plus');
	} 
	else {
		page += 'plus.php';
	}
	//alert ( page );

	var hpos = window.screenX;
	var vpos = window.screenY;
	var position =  "top=" + vpos + ",left=" + hpos ;
	var atrib = "chrome,dependent=yes," + position;

//	alert( page );
	window.open( page, "start", atrib ) ;

}
 
 