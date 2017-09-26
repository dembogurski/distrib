<!-- 
    Report Template File (recepcion)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
       <script src='include/jquery-1.11.1.js'></script>
	<treset_page>
<script language="javascript">
 
function getIdSeleccionados(){
	var matriz=new Array();
	$("table#tabla tr.marcada").each(function(){
	   matriz[matriz.length]=$(this).attr("id");
	});
	return matriz;
}
 
$(function () {
      var isMouseDown = false;
      $("#tabla td")
        .mousedown(function () {
          isMouseDown = true;
          $(this).parent().toggleClass("marcada");
          return false; // prevent text selection
        })
        .mouseover(function () {
          if (isMouseDown) {
            $(this).parent().toggleClass("marcada");
          }
        }).mouseup(function () {
            editar(); 
        })
        .bind("selectstart", function () {
          return false; // prevent text selection in IE
        });

      $(document).mouseup(function () {
          isMouseDown = false;
        });
      $(window).scroll(function(){
          $('#message').animate({top:$(window).scrollTop()+"px" },{queue: false, duration: 350});
      });            
 });
    
 
 
 function abrirPopup(obj){   
    $("#message").html( obj ); 
    $("#message").slideDown("fast"); 
 } 
 function cerrarPopup(){     
     $("#message").slideUp("fast");
 }
      
 function editar(){
    if(getIdSeleccionados().length > 0){
       var primer_id = getIdSeleccionados()[0].substring(3,20);
       var tr_id = getIdSeleccionados()[0];
        
       abrirPopup("<div>Cargando espere... <img src='images/activity.gif' width='50px' height='8px'></div>");
   	      $.ajax({
		type: "POST",
		url: "include/Ajax.class.php",
		data: "action=get_recepcion_ui&id="+primer_id,
		async:true,
                dataType: "html",
		beforeSend: function(objeto){
                   //abrirPopup("<div>Cargando espere... <img src='images/activity.gif' width='50px' height='8px'></div>");
                },
	        complete: function(objeto, exito){
	             if(exito=="success"){  
                         $("#message").html(objeto.responseText); 
                         //$("#"+tr_id).children('nth-child(6)').css("background","red")
                         var valmin = $("#"+tr_id).children(':nth-child(14)').html();
                         var p1 = $("#"+tr_id).children(':nth-child(15)').html();
                         var p2 = $("#"+tr_id).children(':nth-child(16)').html();
                         var p3 = $("#"+tr_id).children(':nth-child(17)').html();
                         var p4 = $("#"+tr_id).children(':nth-child(18)').html();
                          
                         $("#valmin").val(valmin);
                         $("#p1").val(p1);
                         $("#p2").val(p2);
                         $("#p3").val(p3);
                         $("#p4").val(p4);
                           
	             }
        	} 
	      });  
       //console.log(getIdSeleccionados());
    }else{
       cerrarPopup();
    }
 }
 function getGrupos(){
     var sector_id = $("#sector").val();
        $.ajax({
		type: "POST",
		url: "include/Ajax.class.php",
		data: "action=get_grupos&id_sector="+sector_id,
		async:true,
                dataType: "html",
		beforeSend: function(objeto){
                   //$("#grupo").html(""); 
                   $("#msg").html("<img src='images/activity.gif' width='50px' height='8px'>"); 
                },
	        complete: function(objeto, exito){
	             if(exito=="success"){  
                         $("#grupo").html(objeto.responseText); 
                         $("#msg").html(""); 
	             }
        	} 
	      });          
     
 }
 
 function getTipos(){
      var grupo_id = $("#grupo").val();
        $.ajax({
		type: "POST",
		url: "include/Ajax.class.php",
		data: "action=get_tipos&id_grupo="+grupo_id,
		async:true,
                dataType: "html",
		beforeSend: function(objeto){
                   //$("#grupo").html(""); 
                   $("#msg").html("<img src='images/activity.gif' width='50px' height='8px'>"); 
                },
	        complete: function(objeto, exito){
	             if(exito=="success"){  
                         $("#tipo").html(objeto.responseText); 
                         $("#msg").html(""); 
	             }
        	} 
	      });
 }
 function getColores(){
        var color = $("#buscar_color").val();
           
        $.ajax({
		type: "POST",
		url: "include/Ajax.class.php",
		data: "action=get_colores&color="+color,
		async:true,
                dataType: "html",
		beforeSend: function(objeto){
                   //$("#grupo").html(""); 
                   $("#msg").html("<img src='images/activity.gif' width='50px' height='8px'>"); 
                },
	        complete: function(objeto, exito){
	             if(exito=="success"){  
                         $("#colores").html(objeto.responseText); 
                         $("#msg").html(""); 
	             }
        	} 
       });
 }
 function actualizarDatos(){
    if(getIdSeleccionados().length > 0){
       var sector = $("#sector").val();   
       var grupo = $("#grupo").val(); 
       var tipo = $("#tipo").val(); 
       var color = $("#colores").val(); 
       var ancho = $("#ancho").val(); 
       var sectort = $("#sector option:selected").text();   
       var grupot = $("#grupo option:selected").text(); 
       var tipot = $("#tipo option:selected").text(); 
       var colort = $("#colores option:selected").text(); 
       var ids = "-1"; 
       for(var i = 0;i < getIdSeleccionados().length; i++ ){ 
          var id = getIdSeleccionados()[i].substring(3,20);
          ids = ids + ","+id;
       }
        $.ajax({
		type: "POST",
		url: "include/Ajax.class.php", 
		async:true,
                dataType: "html",
		data: "action=actualizar_descripcion&sector="+sector+"&grupo="+grupo+"&tipo="+tipo+"&color="+color+"&ancho="+ancho+"&ids="+ids,
		async:true,
                dataType: "html",
		beforeSend: function(objeto){ 
                   $("#msg").html("<img src='images/activity.gif' width='50px' height='8px'>"); 
                },
	        complete: function(objeto, exito){
	             if(exito=="success"){ 
                        var trs = getIdSeleccionados();
                        for(var i = 0;i < trs.length;i++){
                            var tr_id = trs[i];
                            $("#"+tr_id).children(':nth-child(1)').css("background","lightblue");
                            $("#"+tr_id).children(':nth-child(4)').html(sectort);
                            $("#"+tr_id).children(':nth-child(5)').html(grupot);
                            $("#"+tr_id).children(':nth-child(6)').html(tipot);
                            $("#"+tr_id).children(':nth-child(7)').html(colort);
                            $("#"+tr_id).children(':nth-child(12)').html(ancho);
                            $("#"+tr_id).children(':nth-child(13)').html('Activo');
                        }  
                        $("#msg").html("Ok"); 
	             }
        	} 
       }); 
    }    
 }
 function actualizarPrecios(){
    if(getIdSeleccionados().length > 0){
            var valmin = parseFloat($("#valmin").val());
            var p1 = parseFloat($("#p1").val());
            var p2 = parseFloat($("#p2").val());
            var p3 = parseFloat($("#p3").val());
            var p4 = parseFloat($("#p4").val());
             
            if( (p1 < valmin) || (p2  < valmin) || (p3 < valmin) || (p4 < valmin) || ( isNaN(p1) || isNaN(p2) ||  isNaN(p3) || isNaN(p4)  || isNaN(valmin))  ){// Lo hice a proposito
               alert("Error: Uno de los precios es menor al minimo...");   
            }else{
                var ids = "-1"; 
                for(var i = 0;i < getIdSeleccionados().length; i++ ){ 
                   var id = getIdSeleccionados()[i].substring(3,20);
                   ids = ids + ","+id;
                } 
                $.ajax({
                        type: "POST",
                        url: "include/Ajax.class.php", 
                        async:true,
                        dataType: "html",
                        data: "action=actualizar_precios&valmin="+valmin+"&p1="+p1+"&p2="+p2+"&p3="+p3+"&p4="+p4+"&ids="+ids,
                        async:true,
                        dataType: "html",
                        beforeSend: function(objeto){ 
                           $("#msg").html("<img src='images/activity.gif' width='50px' height='8px'>"); 
                        },
                        complete: function(objeto, exito){
                             if(exito=="success"){  
                                var trs = getIdSeleccionados();
                                for(var i = 0;i < trs.length;i++){
                                    var tr_id = trs[i];
                                    $("#"+tr_id).children(':nth-child(1)').css("background","lightblue");
                                    $("#"+tr_id).children(':nth-child(14)').html(valmin);
                                    $("#"+tr_id).children(':nth-child(15)').html(p1);
                                    $("#"+tr_id).children(':nth-child(16)').html(p2);
                                    $("#"+tr_id).children(':nth-child(17)').html(p3);  
                                    $("#"+tr_id).children(':nth-child(18)').html(p4);  
                                } 
                                $("#msg").html(objeto.responseText); 
                             }
                        } 
               });  
            }    
    }        
 }
 function imprimir(){
    var codigos = "-1";
    var trs = getIdSeleccionados();
    for(var i = 0;i < trs.length;i++){
        var tr_id = trs[i];
        var codigo = $("#"+tr_id).children(':nth-child(3)').html();
        codigos+=","+codigo;
    }
    
    window.open("project/distrib/reports/config/barcode_prg.php?codigos="+codigos+"&lote=true","Codigos de Barras","width=350,height=500,scrollbars=yes");
 }
</script>   

<style>
    .marcada{
        background: orange;
    }
   .message{
        position: absolute;
        top: 0;
        z-index: 10;
        background:#ffc;
        padding:5px;
        border:1px solid #CCCCCC;
        text-align:center;
        font-weight:bold;
        width: 80%;
        height: auto;
        margin-top: 40px;
        margin-left: 10%;
        margin-right: 10%;  
    }    
</style>
<!-- end:   general_header -->


<!-- begin: start_query0 -->
<div id="message" class="message"  style="display:none;"  >   xxxxxx  </div>
 

<table style="text-align: left; width: 100%;" border="1" cellpadding="0" cellspacing="0">
    <tbody>
    <thead>
<tr> <td colspan="50"> 
	<table style="text-align: left; width: 100%;" border="1"
	 cellpadding="0" cellspacing="0">
	  <tbody>
		<tr>
		  <td style="width: 20%;height:40px;"> </td>
		  <td style="text-align: center;width: 60%;">
			<b>{company}</b></td>
		  <td style="text-align: right;">
			<tpage><b>Pag: </b></tpage></td>
		</tr>
		<tr>
		  <td  style="width: 20%;">
			<small><small>ycube plus RAD [1.2.31]</small></small>
		  </td>
		  <td style="text-align: center;"><big
			style="font-weight: bold;"><big>Recepcion de Mercaderias</big></td>
		  <td style="text-align: right;">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>
	  </tbody>
	</table> 
</td></tr>
</thead>
<!-- end:   start_query0 -->

<!-- begin: header0 -->
<table id="tabla" style="text-align: left; width: 100%;" border="1" cellpadding="0" cellspacing="0">
    <tr>
        
        <th>Proveedor</th>
        <th>StoreNum</th>
        <th>Codigo</th>
        <th>Sector</th>
        <th>Grupo</th>
        <th>Tipo</th>
        <th>Color</th>
        <th>Um</th>
        <th style="text-align: right;">Cant_Compra</th>
        <th style="text-align: right;">Cant_Stock</th>
        <th>Descrip</th>
        <th>Ancho</th>
        <th>Estado</th>
        <th>Valmin</th>
        <th>Precio_1</th>
        <th>Precio_2</th>
        <th>Precio_3</th>
        <th>Precio_4</th>
    </tr>

 
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
        <tr id="tr_{query0_ID}" title="{query0_ID}">
            
            <td class="item">{query0_Proveedor}</td>
            <td class="item">{query0_StoreNum}</td>
            <td class="item">{query0_Codigo}</td>
            <td class="item">{query0_Sector}</td>
            <td class="item">{query0_Grupo}</td>
            <td class="item">{query0_Tipo}</td>
            <td class="item">{query0_Color}</td>
            <td class="itemc">{query0_Um}</td>
            <td class="num">{query0_Cant_Compra}</td>
            <td class="num">{query0_Cant_Stock}</td>
            <td class="item">{query0_Descrip}</td>
            <td class="item">{query0_Ancho}</td>
            <td class="itemc">{query0_Estado}</td>
            <td class="num">{query0_p_valmin}</td>
            <td class="num">{query0_p_precio_1}</td>
            <td class="num">{query0_p_precio_2}</td>
            <td class="num">{query0_p_precio_3}</td>
            <td class="num">{query0_p_precio_4}</td>
         </tr>
<!-- end:    query0_data_row -->
<!-- begin: query0_total_row -->
        <tr> 
           
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
<!-- end:    query0_total_row -->
<!-- begin: query0_subtotal_row -->
        <tr>
            <td></td>
             
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right;"><b>{subtotal0_Cant_Compra}</b></td>
            <td style="text-align: right;"><b>{subtotal0_Cant_Stock}</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
</table>   
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<!-- end:   end_query0 -->

