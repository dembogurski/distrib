// C Point Debugger JavaScript Library v6.0
// Copyright© 2002-2006 C Point Pty Ltd, 71 Williamson Road, Para Hills 5096
// Web: http://www.c-point.com Email: c-point@c-point.com

// *********************************************************************** //
// To use the C Point Debugger JavaScript Library you must be a registered 
// user of Antechinus JavaScript Editor.
// *********************************************************************** //

Debugger=1;
UseTimeStamp=0;
DbgX=10;
DbgY=10;
DbgWidth=500;
DbgHeight=120;
timestamp=0;
debugInit=0;

function DbgClear()
{
	InitDbgSession();
	document.fm.ta.value = "";
	return(1);
}

function DbgInspect(v)
{
	InitDbgSession();
	var str = "";
	try
	{
		str = v + ": " + eval(v) + "\n";
		document.fm.ta.value += str;
	}
	catch(e)
	{
		str = "Error: " + e.description + "\n";
		document.fm.ta.value += str;
	}
	DbgScrollEnd();
	return(str);
}

function PROPERTIES(objName, obj)
{
	if(!Debugger) return;
	InitDbgSession();
	var str = "";
	for(var v in obj)
	{
		str=objName+"."+v+" = " + obj[v] + "\n";
		document.fm.ta.value += str;
	}
	DbgScrollEnd();
}
function TRACE0(val)
{
  	if(!Debugger)return;
  	InitDbgSession();
	document.fm.ta.value += val + "\n";
	DbgScrollEnd();
}

function TRACE(label, val)
{
	if(!Debugger)return;
	InitDbgSession();
	var msg = label + "=" + val;
	var now = new Date();
	var elapsed = now - timestamp;
	if(UseTimeStamp)
	{
		msg+=" (" + elapsed + " msec)";	
	}
	timestamp = now;
	  
	document.fm.ta.value += msg + "\n";
	DbgScrollEnd();
}

// ************  Move object functions ************ 
function InitDbgSession()
{
	  if(debugInit)return;
	  debugInit=1;	
// Init the draggable class
	bMoving = false;
	document.onmousedown=DbgStartMove;
	document.onmousemove=DbgMoveObj;
	document.onmouseup=new Function("bMoving=false");
// Init debugger session
	var str = '<div class="dbgdrag" border=1 style="cursor:hand;position:absolute; left:' + DbgX +
	 ';top:' + DbgY + '; width:' + DbgWidth + 'px;' + 
	'background-color=silver;height:' + DbgHeight + 'px; z-index:1;border=1;borderColor=black">' +
	'<form name ="fm">';
	 DbgWidth-=10; 
	 DbgHeight-=10;
	 str+='<textarea id="ta" name="ta" style="position:absolute; width:' + DbgWidth + 'px;height:' + DbgHeight + 
	 	'px;left:5;top:5;">' + '</textarea></form></div>';
	document.write(str);
}

function DbgMoveObj()
{
	if(!bMoving) return true;
	if(event.button!=1) return true;

// Reposition the object, keeping the same distance from the cursor
	ob.style.pixelLeft=event.clientX-xdif;
	ob.style.pixelTop=event.clientY-ydif;
	return false;
}

function DbgStartMove()
{
// Only "draggable" objects can move
	if(event.srcElement.className!="dbgdrag") return;

	bMoving=true;
// Store the object and the differnce between the obj pos and cursor pos: it must remain the same
	ob=event.srcElement;
	xdif=event.clientX-event.srcElement.style.pixelLeft;
	ydif=event.clientY-event.srcElement.style.pixelTop;
}

function DbgScrollEnd() 
{
	var range = document.fm.ta.createTextRange();
	range.collapse(false);
	range.select();	
}
