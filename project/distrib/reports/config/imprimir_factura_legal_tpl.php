<!-- 
    Report Template File (caja)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval --> 
   <!--<script type="text/javascript" src="xinclude/jquery-1.3.2.js" > </script>--> 
   <script type="text/javascript" src="include/functions.js" > </script>
   
   	<link rel='stylesheet' href='include/jquery-dateValidator-master/src/validator.css'>
	  
        <script src='include/jquery-1.11.1.js'></script>
	<script src='include/jquery-dateValidator-master/src/dateValidation.jquery.js'></script>
	<treset_page>
            <style type="text/css">
                td,th{
                   padding:4px 
                } 
                label{
                    padding: 4px;
                    font-size: 18px;
                    font-weight: bolder;
                }
                .label_mini{
                    padding: 2px;
                    font-size: 11px;
                    font-weight: bolder;
                }
                input{
                    padding: 4px;
                    font-size: 18px;
                    text-align: right;
                }
                .input_mini{
                   padding: 2px;
                   font-size: 11px;
                   font-weight: bolder;  
                   text-align: left
                }
                select{
                    padding: 4px;
                    font-size: 18px;
                    text-align: left;
                    width:130px;
                }
               .error {
                    font-family:Arial, Helvetica, sans-serif; 
                    font-size:15px;
                    border: 1px solid;
                    margin: 80px 0px;
                    padding:15px 10px 15px 80px;
                    background-repeat: no-repeat;
                    background-position: 10px center;
                    position:relative;
                    color: #D8000C;
                    background-color: #FFBABA;
                    background-image: url('images/error.png');
               } 
               .cheques{
                   font-size: 9px;
                   font-family: helvetica;
               }
               .cheques th{
                   font-weight: bolder;
                   background: lightgray
               }
               .num{
                   text-align: right;
                   padding-right: 2px;
               }
               .itemc{
                   text-align: center; 
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

                width: 60%;
                height: auto;
                margin-top: 180px;
                margin-left: 20%;
                margin-right: 20%;  
            }
            </style>  
<script lang="javascript">
    
    var flag = 0;
function abrirPopup(obj){   
   $("#message").html( obj );
   $("#message").animate({ opacity:100 }, 2000);  
}
   
function cerrarPopup(){   
     $("#message").html("");
     $("#message").animate({ opacity:0 }, "fast");    
}    
Number.prototype.format = function(n, x, s, c) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
        num = this.toFixed(Math.max(0, ~~n));

    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};
function setNumberField(){
   $(".numeric").change(function(){
      var n = parseFloat($(this).val() ).format(2, 3, '.', ',') ;
      $(this).val( n  );
      if($(this).val() =="" || $(this).val() =="NaN" ){
          $(this).val( 0);
      }
   });  
}    
 $(document).ready(function(){
   setNumberField();
   $(".factura").change(function(){
      var n = parseFloat($(this).val() ).format(0, 8, '.', '') ;
      $(this).val( n  );
      if($(this).val() =="" || $(this).val() =="NaN" ){
          $(this).val( 0); $("#imprimir").attr("disabled",true);
      }else{
         $("#imprimir").removeAttr("disabled");$("#imprimir").focus(); 
      }
   });
    
   $("#efectivo").focus(); 
   setRef("total_cheques");
 });
 
 function cotiz(){   
   	   var moneda = $("#monedas").val();   
   	      $.ajax({
		type: "POST",
		url: "include/Ajax.class.php",
		data: "action=get_cotiz_compra&moneda="+moneda,
		async:true,
                dataType: "html",
		beforeSend: function(objeto){
                   $("#msg").html("<b> Buscando... </b>&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  <img src='images/activity.gif' height='12px' width='60px'  >");
                },
	        complete: function(objeto, exito){
	             if(exito=="success"){    
	              	 $("#msg").html("");
                         $("#cotiz").val(objeto.responseText);
                         setRef("cotiz");
	             }
        	} 
	      });   	  
   }  
 
   
   function setRef(id){   
     
      //var efectivo = $("#efectivo").val().replace(".","").replace(",",".");  
      var efectivo = $("#efectivo").val().replace(/\./g, '').replace(/\,/g, '.');
      if(id=="efectivo"){
       var efectivo = $("#efectivo").val();
      }    
      var cotiz =  $("#cotiz").val().replace(/\./g, '').replace(/\,/g, '.');
      var tarjeta =  $("#tarjeta").val().replace(/\./g, '').replace(/\,/g, '.');
      if(id=="tarjeta"){
         tarjeta =  $("#tarjeta").val();
      } 
      var cheques = $("#total_cheques").val().replace(/\./g, '');
      
      if(isNaN(cheques) ){
         cheques = 0;    
      }
      if(isNaN(efectivo) || efectivo == ""){  
         $("#efectivo").val(0); efectivo = 0;
      }   
      if(isNaN(tarjeta) || tarjeta == ""){  
         $("#tarjeta").val(0); tarjeta = 0;
      }   
      if(isNaN(cotiz) || cotiz == ""){ 
         $("#cotiz").val(0); cotiz = 0;
      }
         
      var m_ref =    ((parseFloat(efectivo) * parseFloat(cotiz)) ).format(2, 3, '.', ',');  
      var total = ((parseFloat(efectivo) * parseFloat(cotiz)) + parseFloat(tarjeta)).format(2, 3, '.', ',');   
      var total_unformat = ((parseFloat(efectivo) * parseFloat(cotiz)) + parseFloat(tarjeta) +  parseFloat(cheques) );
       
      $("#efectivo_ref").val(m_ref); 
      $("#total").val(total); 
      
     var total_a_pagar =  $("#total_pagar").val().replace(/\./g, '').replace(/\,/g, '.');
     
     var vuelto = total_unformat - total_a_pagar ;
     
     if(vuelto >= 0){
         $("#label_vuelto").html("Vuelto Gs:");  $("#vuelto").css("color","green");
     }else{
         $("#label_vuelto").html("Faltante Gs:"); $("#vuelto").css("color","red");
     }    
     if(vuelto >= 0){
        if((parseFloat(tarjeta) > 0 && $("#voucher").val()=="")){
           $("#aceptar").attr("disabled",true);   $("#voucher").css("border","solid red 1px");
        }else{ 
          $("#aceptar").removeAttr("disabled");   $("#voucher").css("border","solid gray 1px");
        }
     }else{
        $("#aceptar").attr("disabled",true);  
     }    
     $("#vuelto").val(vuelto.format(2, 3, '.', ','));  
   }
   
   function fadeConv(){
        
     if( $("#tarjeta").val().replace(".","").replace(",",".") > 0 ){
         $("#label_voucher").fadeIn("fast"); $("#voucher").fadeIn("fast"); $("#convenios").fadeIn("fast");
     }else{
         $("#label_voucher").fadeOut("slow"); $("#voucher").fadeOut("slow");  $("#convenios").fadeOut("slow"); 
     } 
   }
   function aceptar(){
      $("#aceptar").attr("disabled",true); 
      $("#efectivo").attr("readonly",true);
      $("#tarjeta").attr("readonly",true);
      $("#cotiz").attr("readonly",true);
      $("#voucher").attr("readonly",true);
      var moneda = $("#monedas").val();  
      var conv = $("#convenios").val();  
      $("#convenios").attr("disabled",true);
      $("#monedas").attr("disabled",true); 
      window.opener.close();  
      var usuario = $("#usuario").val();
      var nro_factura = $("#nro_factura").val();
	  
      var cj_ref = $("#caja_ref").val();  
      var efectivo = $("#efectivo").val().replace(/\./g, "").replace(/\,/g, ".");
     
      var cotiz = $("#cotiz").val().replace(/\./g, "").replace(/\,/g, ".");
      var tarjeta = $("#tarjeta").val().replace(/\./g, "").replace(/\,/g, ".");
      var vuelto = $("#vuelto").val().replace(/\./g, "").replace(/\,/g, ".");
      var voucher = $("#voucher").val(); 
  
      
        $.ajax({
		type: "POST",
		url: "include/Ajax.class.php",
		data: "action=cerrar_venta&nro_factura="+nro_factura+"&usuario="+usuario+"&cj_ref="+cj_ref+"&efectivo="+efectivo+"&moneda="+moneda+"&cotiz="+cotiz+"&tarjeta="+tarjeta+"&voucher="+voucher+"&conv_cod="+conv+"&vuelto="+vuelto,
		async:true,
                dataType: "html",
		beforeSend: function(objeto){
                   $("#msg").html("<b> Procesando... </b>&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  <img src='images/activity.gif' height='12px' width='60px'  >");
                },
	        complete: function(objeto, exito){
	             if(exito=="success"){    
	              	 $("#msg").html(objeto.responseText); 
	             }
        	   } 
		}
	 );    
    
     $("#factura_legal").fadeIn("fast");
     $("#label_factura_legal").fadeIn("fast");
     $("#imprimir").fadeIn("fast");
	 $("#finalizar").fadeIn("fast");
     $("#factura_legal").focus();  
   } 
   
   function addCheque(){
       var factura = $("#nro_factura").val();  
        $.ajax({
		type: "POST",
		url: "include/Ajax.class.php",
		data: "action=get_cheque_terceros_ui",
		async:true,
                dataType: "html",
		beforeSend: function(objeto){
                    abrirPopup("<b> Cargando... </b>&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  <img src='images/activity.gif' height='12px' width='60px'  >");
                },
	        complete: function(objeto, exito){
	             if(exito=="success"){    
	              	  abrirPopup(objeto.responseText); 
                          setNumberField();
                          configureForm();
	             }
        	   } 
		}
	 );  
   }
 
   function configureForm(){ 
        
        $("#benef").focus();$("#benef").select();
        $('#fecha_emision').dateValidation();
        $('#fecha_pago').dateValidation();
        $('.fechas').focus(function(){
            var value = $(this).val();   
            if(value == "__/__/____"){
              $(this).val("")
            }    
        });
        var i = 0;
        $('.input_mini').blur(function(){
            
            var length = $(this).val().length;  
            if($(this).attr("id")!="bancos" && $(this).attr("id")!="fecha_emision" && $(this).attr("id")!="fecha_pago"){ 
                if(length < 4){
                   $(this).addClass("wrong-date");checkComplete();
                }else{
                   $(this).removeClass("wrong-date");checkComplete();
                }    
            } 
            checkComplete(); 
        }); 
        
        $("#benef").blur(function(){ 
            $(this).val($(this).val().toString().toUpperCase());
        });
   }
   function checkComplete(){
       flag = 0;
       $('.wrong-date').each(function(){
           flag++;   
       });
       if(flag == 0){
             $("#aceptar").removeAttr("disabled"); 
       }else{
            $("#aceptar").attr("disabled","true");    
       }       
    }    
   function guardarCheque(){
      $("#aceptar").attr("disabled","true");
      var suc = $("#sucursal").val();
      var factura = $("#nro_factura").val();
      var benef   = $("#benef").val();  
      var banco = $("#bancos").val();  
      var cta = $("#cuenta").val();  
      var nro_cheque = $("#nro_cheque").val();  
      var fecha_pago = $("#fecha_pago").val();  
      var fecha_emision = $("#fecha_emision").val();  
      var valor = $("#valor").val();  
       $.ajax({
		type: "POST",
		url: "include/Ajax.class.php",
		data: "action=registrar_cheque&nro_factura="+factura+"&benef="+benef+"&banco="+banco+"&cuenta="+cta+"&nro_cheque="+nro_cheque+"&fecha_pago="+fecha_pago+"&fecha_emision="+fecha_emision+"&valor="+valor+"&suc="+suc,
		async:true,
                dataType: "html",
		beforeSend: function(objeto){
                   abrirPopup("<b> Procesando favor espere... </b>&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  <img src='images/activity.gif' height='12px' width='60px'  >");
                },
	        complete: function(objeto, exito){
	             if(exito=="success"){    
                        cerrarPopup();
	              	$("#cheques").html(objeto.responseText); 
                        setRef("total_cheques");
	             }
        	   } 
		}
	 );
   }
   function delChq(id){
     var del = confirm("Comfirma que desea eliminar este Cheque?"); 
     if(del){
         var factura = $("#nro_factura").val();  
         $.ajax({
		type: "POST",
		url: "include/Ajax.class.php",
		data: "action=eliminar_cheque&id="+id+"&nro_factura="+factura,
		async:true,
                dataType: "html",
		beforeSend: function(objeto){
                   abrirPopup("<b> Procesando favor espere... </b>&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  <img src='images/activity.gif' height='12px' width='60px'  >");
                },
	        complete: function(objeto, exito){
	             if(exito=="success"){  
                        cerrarPopup();
                        $("#cheques").html(objeto.responseText); 
                        setRef("total_cheques");
	             }
        	} 
	});  
     } 
   }
   function imprimir(path){
       var factura = $("#nro_factura").val();  
       var factura_legal = $("#factura_legal").val(); 
	   var tipo = $("#tipo").val();       
       var fullpath = path+"?factura="+factura+"&factura_legal="+factura_legal+"&tipo="+tipo; 
        
       window.open(fullpath, "_blank", "toolbar=no,menubar=yes, scrollbars=yes, resizable=yes,  width=800, height=700,modal=yes");
   }
    
 </script>
   <div id="message" class="message"  style="opacity:0;" >  <img  onclick="cerrarPopup()" style="float:right;cursor:pointer;" src="images/close.png" />  </div>
             
<!-- end:   general_header -->


<!-- begin: start_query0 -->
<input type="hidden" id="nro_factura" value="{sup_f_nro}"> 
<input type="hidden" id="caja_ref" value="{caja_ref}"> 
<input type="hidden" id="usuario" value="{user}"> 
<input type="hidden" id="sucursal" value="{suc}"> 
    <!--
<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <thead>
        <tr> <td style="width: 100%;padding: 0px; " colspan="3"> 
	<table style="text-align: left; width: 100%;" border="1" cellpadding="0" cellspacing="0">
	  <tbody>
		<tr>
                   <td style="width: 25%">Factura N&deg;.: {sup_f_nro}</td>
		   <td style="text-align: center;"><b>{company}</b></td>
		   <td style="text-align: right;width: 25%"><tpage><b>Pag: </b></tpage></td>
		</tr>
		<tr>
		  <td>
                      <small><small>ycube plus RAD [1.2.31]</small> </small>
		  </td>
		  <td style="text-align: center;"><big
			style="font-weight: bold;"><big>Caja</big></td>
		  <td style="text-align: right;">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>
	  </tbody>
	</table> 
</td></tr>   -->
<!-- end:   start_query0 -->

<!-- begin: header0 -->
</thead>
<tr style="background:#E0EEEE"> 
        <th>Fecha</th>  
        <th>Doc</th>
        <th>Cliente</th> 
    </tr>

 
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
        <tr style="background:#E0EEEE"> 
            <td >{query0_Fecha}</td> 
            <td>{query0_TipoDoc}: {query0_Doc}</td> 
            <td>{query0_Cliente}</td>  
        </tr>
        <tr> 
            <td colspan="3" style="text-align: left;height:50px">
                <span style="font-size: 22px" >TOTAL A PAGAR:</span><img src="images/gs.png" align="top">
                <span style="font-size: 22px;color:#1A94CD;font-weight: bolder"><input id="total_pagar" type="text" style="width:150px;color:blue;font-weight:bolder" class="numeric" value="{query0_TOTAL}" readonly  > </input></span> 
                <span style="font-size: 22px" >Gs.</span>&nbsp;&nbsp;  
                
                &nbsp;&nbsp;&nbsp;<img src="images/rs.png" align="top"><input type="text" title="Reales" style="width:80px;color:black;" readonly  value="{total_Rs}" > </input>
                &nbsp;&nbsp;<img src="images/us.png" align="top"><input type="text" title="Dolares Americanos" style="width:80px;color:black;" readonly  value="{total_Us}" > </input>
                &nbsp;&nbsp;<img src="images/ps.png" align="top"><input type="text" title="Pesos" style="width:80px;color:black;" readonly  value="{total_Ps}" > </input>
                <span  style="text-align:center" id="msg"></span> 
            </td>
        
        </tr>
        
<!-- end:    query0_data_row -->
<!-- begin: query0_total_row -->

<tr>
    
    <td colspan="3" >
    <table style="text-align: left; width: 60%;padding-top: 40px" border="0" cellpadding="0" cellspacing="0">
        <tr><td colspan="4" style="text-align:center;font-weight: bolder;font-size: 20px;border: solid 1px">Imprimir Factura Contable</td></tr>
            <tr> 
                <td colspan="2"> <label id="label_factura_legal" style="display:block">Ingrese N&deg; Factura contable:</label> </td>
                <td> <input id="factura_legal"  style="display:block" value="" type="text" class="factura" maxlength="14" size="12" ></td>
				<td>   
				   <select id="tipo">
				       <option>Contado</option>
					   <option>Credito</option>
				   </select>
				</td>
                <td> <input id="imprimir"  style="display:block" type="button" value="Imprimir" onclick=imprimir("{imprimir_factura}") disabled > </td>
            </tr>
	   <tr><td style="text-align:center;border:solid gray 1px;height:46px" colspan="8"> <input id="finalizar"  style="display:none" type="button" value="Finalizar" onclick="javascript:self.close()"  > </td></tr>
            
    </table>
    </td>
</tr>        
<!-- end:    query0_total_row -->
<!-- begin: query0_subtotal_row -->
        <tr>
            <td></td> 
        </tr>
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<!-- end:   end_query0 -->

<!-- begin: error -->
<div class="error">No hay nada que cobrar en esta Factura! &nbsp;&nbsp; &nbsp;&nbsp; <input type="button" value="Volver" onclick="javascript:self.close()"></div>
<!-- end:   error -->

