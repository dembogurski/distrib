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
            .titulo_factura{
                text-align: center;
                background: lightgray;
                font-family: sans-serif;
                font-size: 14px;
            }
            #cabecera{
                padding: 4px; 
                display: inline;
            }
            #detalle_factura, #lista_convenios, #lista_cheques, #lista_cuotas  {
                font-family: sans-serif;
                font-size: 12px;
                font-weight: normal;
                background-color: #F0F0F0; /*Casi blanco */
                border-color: #999999;
                border-collapse: collapse;
                margin-top: 10px;
                margin-left: 2px;
                margin-right: 4px;
                margin-bottom: 10px;
                background-color: rgb(250,250,250);
            }
            .titulo{
                background-color:#dddacd;
                font-size: 13px;
             }
             .porc{
                 display: none
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
   setRef("efectivo");
   $(".plan_pago").click(function(){
      setPlanPago($(this).val());
   });
   
   $("#punto_exp").change(function(){
      var exp = $(this).val();
      setCookie("exp",exp,5000);
   }); 
   $("#punto_exp").val(getCookie("exp"));
   setTimeout("getFacturas()",500);
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
      var cuotas = $("#total_cuotas").val().replace(/\./g, '').replace(/\,/g, '.');
      
      if(isNaN(cuotas) ){
         cuotas = 0;    
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
      // Sumar cheques solo si es Contado sino no
      var cheques = 0;
      if($("#tipo").val() == "Contado"){
          cheques = $("#total_cheques").val().replace(/\./g, '').replace(/\,/g, '.');
      }
      
      var m_ref =    ((parseFloat(efectivo) * parseFloat(cotiz)) ).format(2, 3, '.', ',');  
      var total = ((parseFloat(efectivo) * parseFloat(cotiz)) + parseFloat(tarjeta) +   parseFloat(cuotas) +  parseFloat(cheques)   ).format(2, 3, '.', ',');   
      var total_unformat = ((parseFloat(efectivo) * parseFloat(cotiz)) + parseFloat(tarjeta) +  parseFloat(cuotas) + parseFloat(cheques)  );
       
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
      var tipo = $("#tipo").val();
      
        $.ajax({
		type: "POST",
		url: "include/Ajax.class.php",
		data: "action=cerrar_venta&nro_factura="+nro_factura+"&usuario="+usuario+"&cj_ref="+cj_ref+"&efectivo="+efectivo+"&moneda="+moneda+"&cotiz="+cotiz+"&tarjeta="+tarjeta+"&voucher="+voucher+"&conv_cod="+conv+"&vuelto="+vuelto+"&tipo="+tipo,
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
       var tipo = $("#tipo").val();
       var porc = $("#porc").val();
       var punto_exp = $("#punto_exp").val();
       var factura_legal = $("#factura_legal").val();
       var suc = $("#sucursal").val();
       var fullpath = path+"?factura="+factura+"&punto_exp="+punto_exp+"&factura_legal="+factura_legal+"&tipo="+tipo+"&porc="+porc+"&suc="+suc;
       window.open(fullpath, "_blank", "toolbar=no,menubar=yes, scrollbars=yes, resizable=yes,  width=800, height=700,modal=yes");
   }
   function cuotasUI(){
      var tipo = $("#tipo").val();
	  if(tipo == "Credito"){
	     $(".venta_credito").fadeIn();
	  }else{
	     $(".venta_credito").fadeOut();
	  }
   }
 function getCuotasDeFactura(){
     // Este metodo toma NaN como Monto inicial por lo tanto solo devuelve las ya generadas
     $(".cuotas").remove();
     generarCuotas();
 }
  function setPlanPago( plan ){
      if(plan != 4){
         $("#n_cuotas").attr("disabled",true); 
      }else{
         $("#n_cuotas").removeAttr("disabled");
      }
      if(plan > 1){$("#generar_cuotas").val("Generar Cuotas");}else{$("#generar_cuotas").val("Generar Cuota");}
      calcRefCuota();
      $("#generar_cuotas").removeAttr("disabled");
  }
  
    function eliminarCuotas(){
      var factura =  $("#nro_factura").val();
      $.ajax({
        type: "POST",
        url: "include/Ajax.class.php", 
        data: {"action": "eliminar_cuotas", "factura": factura},
        async: true,
        dataType: "html",
        beforeSend: function() {
            $("#msg_cuotas").html("<img src='images/loading.gif'   height='20px' width='20px'  >");                      
        },
        complete: function(objeto, exito) {
            if (exito == "success") {                          
                $(".cuotas").remove();   $("#total_cuotas").val("0,00");  
                setRef();    
                $(".cuotas_bar").fadeOut();
                $("#msg_cuotas").html("Cuotas eliminadas puede generar de nuevo...");  
                $("#tipo_factura").val("Contado");
                setRef();
            }
        },
        error: function() {
            $("#msg_cuotas").html("Ocurrio un error en la comunicacion con el Servidor...");
        }
    }); 
  }
  
  function calcRefCuota(){
    //var moneda_cuota = $("#monedas_cuotas").val();
    var moneda_cuota = "G$";
    /*
    if(   moneda_cuota === "G$"){
        $("#cotiz_cuota").val("1,00");  
    }else{ // U$
        $("#cotiz_cuota").val(parseFloat(us).format(2, 3, '.', ','));  
    }     */
    //var cotiz = float("cotiz_cuota");
    var cotiz = 1; // G$
    var  faltante = float("vuelto");
    if(faltante < 0){
      faltante = faltante * -1;    
    }
    var plan = $('input[name=plan]:checked').val();
    var cuotas = plan;
    if(plan == 4){
         cuotas = $("#n_cuotas").val();
    }
    var valor_cuota = parseFloat((faltante / cotiz) / cuotas).format(2, 3, '.', ',');
    var moneda = $("#monedas_cuotas option:selected").text();
    $("#msg_valcuota").html(cuotas+" de "+valor_cuota+"  "+moneda);
  }
  
  
  
  function generarCuotas(){
    $("#generar_cuotas").attr("disabled",true);  
    var moneda_cuota = "G$";
    /*if(   moneda_cuota === "G$"){
        $("#cotiz_cuota").val("1,00");  
    }else{ // U$
        $("#cotiz_cuota").val(parseFloat(us).format(2, 3, '.', ','));  
    }   */  
    var cotiz = 1;
    var  faltante = float("vuelto");
    if(faltante < 0){
       faltante = faltante * -1;
    }
    var plan = $('input[name=plan]:checked').val();
    var cuotas = plan;
    if(plan == 4){
      cuotas = $("#n_cuotas").val();
    }
    var valor_cuota = parseFloat((faltante / cotiz) / cuotas);
    var tax = 0; // Para el Futuro    
    var interes = 0;  
    var factura =  $("#nro_factura").val();
    var suc =  $("#sucursal").val();
    $.ajax({
        type: "POST",
        url: "include/Ajax.class.php", 
        data: {"action": "generar_cuotas",factura:factura,monto:valor_cuota, moneda: moneda_cuota, cuotas:cuotas,cotiz:cotiz,suc:suc},
        async: true,
        dataType: "json",
        beforeSend: function() {
            $("#msg_cuotas").html("<img src='images/loading.gif' height='20px' width='20px' >"); 
        },
        success: function(data) {  
           $(".cuotas_foot").remove(); 
                var total_moneda = 0;  
                var total = 0;
                for(var i in data){ 
                     var nro = data[i].c_nro_cuota;
                     var moneda = data[i].c_moneda; 
                     var monto_ref = data[i].c_monto_ref;
                      
                     var vencimiento = data[i].venc;  
                     var estado = data[i].c_estado;                       
                     var monto_ref_formated = parseFloat( monto_ref ).format(2, 3, '.', ',');  
                     //var valor_gs_formated = parseFloat( valor_ref ).format(0, 3, '.', ',');  
                     total += parseFloat( monto_ref ); 
                     total_moneda+= parseFloat( monto_ref )
                     var paper_size = '<label>A4&nbsp;</label><input type="radio" value="9" name="paper_size_'+nro+'" checked="checked" >&nbsp;<label>Oficio</label><input type="radio" value="14" name="paper_size_'+nro+'" >'; 
                     $("#lista_cuotas") .append("<tr class='tr_"+nro+" cuotas'><td class='itemc'>"+nro+"</td><td class='num' >"+monto_ref+"</td><td class='itemc' >"+moneda+"</td><td class='itemc' ><input id='fecha_venc_"+nro+"' value='"+vencimiento+"' class='input_mini  fechas vencimientos' maxlength='10' size='10' type='text'></td><td  class='itemc'>"+estado+"</td>\n\
                     <td  class='itemc'>"+paper_size+"<img id='img_"+nro+"' src='images/printer-01_32x32.png' width='22' height='20' style='cursor:pointer' onclick='imprimirPagare("+nro+")' > </td></tr>");                                       
                     
                } 
                $(".cuotas_bar").fadeIn();
                if(total > 0){
                    $("#tipo").val("Credito");
                }else{
                    $("#tipo").val("Contado");
                }
                total = parseFloat(total).format(2, 3, '.', ',');  
                total_moneda = parseFloat(total_moneda).format(2, 3, '.', ',');
                $("#lista_cuotas").append("<tr class='cuotas_foot'><td> </td>  <td style='text-align: right;font-weight: bolder;font-size: 13px' class='total_cuotas'>\n\
                <input class='input_mini num' size='12' readonly style='font-weight:bolder;font-size:14px;padding:0px;border:0px' id='total_cuotas' type='text' value='"+total_moneda+"'>\
                </td><td colspan='4' ></td> </tr>");
                $("#msg_cuotas").html("");    
                setRef();         
                $('.vencimientos').dateValidation();
                $('.vencimientos').focus(function(){
                    var value = $(this).val();   
                    if(value == ""){
                      $(this).val("dd/mm/aaaa")
                    }    
                }).select();
                $('.vencimientos').click(function(){
                    $(this).select();
                });
                $('.vencimientos').change(function(){
                   var nro_cuota =  $(this).attr("id").toString().substring(11,30);
                   cambiarFechaVencimiento(nro_cuota);
                });
                $("#msg_cuotas").html(""); 
        }
    }); 
  }  
  function cambiarFechaVencimiento(nro_cuota){
    var factura =  $("#nro_factura").val();
    var vencimiento =  $("#fecha_venc_"+nro_cuota).val();
    
      $.ajax({
        type: "POST",
        url: "include/Ajax.class.php", 
        data: {"action": "cambiar_vencimiento_cuota", factura: factura,cuota:nro_cuota,vencimiento:vencimiento},
        async: true,
        dataType: "html",
        beforeSend: function() {
            $("#msg_cuotas").html("<img src='images/loading.gif'   height='20px' width='20px'  >");                      
        },
        complete: function(objeto, exito) {
            if (exito == "success") {  
                $("#msg_cuotas").html(objeto.responseText);  
            }
        },
        error: function() {
            $("#msg_cuotas").html("Ocurrio un error en la comunicacion con el Servidor...");
        }
    });   
  }
  function imprimirPagare(nro){
      $("#img_"+nro).attr("src","images/printer-02_32x32.png");
      var id_cliente = $("#id_cliente").val();
      var usuario = $("#usuario").val();
      var factura =  $("#nro_factura").val();
      var suc =  $("#sucursal").val();  
      var project =  $("#project").val();
      var papar_size = $('input[name=paper_size_'+nro+']:checked').val();
      var url = "pagares/Pagare.class.php?factura="+factura+"&id_cliente="+id_cliente+"&suc="+suc+"&nro_pg="+nro+"&usuario="+usuario+"&papar_size="+papar_size+"&project="+project;
      var title = "Impresion de Pagares";
      var params = "width=800,height=760,scrollbars=yes,menubar=yes,alwaysRaised = yes,modal=yes,location=no";
      
      if(typeof(showModalDialog) === "function"){ // Firefox         
         window.showModalDialog(url,title,params);             
      }else{
         window.open(url,title,params);        
      }
  }
  function float(id){
        var n =  parseFloat($("#"+id).val().replace(/\./g, '').replace(/\,/g, '.'));
        if(isNaN(n)){
            return 0;
        }else{
            return n;
        }
  }
  function getFacturas(){
     var punto_expedicion = $("#punto_exp").val();
     var suc = $("#sucursal").val();
      
     if(punto_expedicion != ""){ 
     $.ajax({
        type: "POST",
        url: "include/Ajax.class.php", 
        data: {"action": "get_facturas_contables",punto_expedicion:punto_expedicion,suc:suc},
        async: true,
        dataType: "json",
        beforeSend: function() {
            $(".nro_factura").remove(); 
            $("#msg_fact").append("<img src='images/loading.gif' height='20px' width='20px' >"); 
        },
        success: function(data) {  
                $(".nro_factura").remove(); 
                $("#imprimir").attr("disabled",true);                 
                var c = 0;
                for(var i in data){ 
                     var nro_mostrar = data[i].nro_mostrar;  
                     var factura = data[i].factura;
                     $("#factura_legal").append("<option class='nro_factura' value='"+factura+"'>"+nro_mostrar+"</option>");                     
                     c++;
                } 
                if(c > 0){                    
                    $("#imprimir").removeAttr("disabled");
                }
                 
                $("#msg_fact").html(""); 
        }
    });     
   }
  }
  
 </script>
   <div id="message" class="message"  style="opacity:0;" >  <img  onclick="cerrarPopup()" style="float:right;cursor:pointer;" src="images/close.png" />  </div>
             
<!-- end:   general_header -->


<!-- begin: start_query0 -->
<input type="hidden" id="nro_factura" value="{sup_f_nro}"> 
<input type="hidden" id="caja_ref" value="{caja_ref}"> 
<input type="hidden" id="usuario" value="{user}"> 
<input type="hidden" id="sucursal" value="{suc}"> 
<input type="hidden" id="project" value="{project}">  
<input type="hidden" id="id_cliente" value="{id_cliente}"> 

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
</td></tr>
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
    <td colspan="3">
    <table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><label>EFECTIVO:</label> </td>  <td><input class="numeric" onchange="setRef(this.id)" id="efectivo" type="text" maxlength="14" size="12"></td>  
                <td><label>Moneda:</label> </td>    <td>{monedas}</td> 
                <td><label>Cotiz:</label> </td>    <td><input class="numeric" id="cotiz" type="text" value="1" maxlength="5" size="5"></td>
                <td><label>Moneda Ref:</label> </td>  <td><input id="efectivo_ref" type="text" maxlength="14" size="12" readonly></td> 
            </tr>
            <tr> 
                <td><label>TARJETA: </label></td><td><input id="tarjeta" onchange="setRef(this.id)" class="numeric" onkeyup="fadeConv()" type="text" maxlength="14" size="12"></td>
                <td><label id="label_voucher" style="display:none">N&deg; Voucher:</label></td>
                <td><input id="voucher" onchange="setRef(this.id)" style="font-size:14px;;display:none" type="text" maxlength="20" size="14"></td>
                <td colspan="4">{convenios}</td>  
            </tr>
             
            <tr class="venta_credito" style="display:none">
                <td valign="top"><label>CUOTAS</label></td>
                <td colspan="7">
                        <div id="credito" style="text-align: left;min-height: 190px;border:solid gray 1px;" >
                                      <table cellspacing="0" cellpadding="0" border="0" style="width: 100%">
                                          <tr>
                                              <td style="width: 30%;font-weight: bolder;height: 80%"> 
                                                  <div class="titulo" style="width: 256px;margin-bottom:10px;text-align:center">Planes de Pago</div> 
                                                  <input type="radio" name="plan" class="plan_pago" value="1">&nbsp;<label>1 Cuota a 30 d&iacute;as</label><br>
                                                  <input type="radio" name="plan" class="plan_pago" value="2">&nbsp;<label>30-60 d&iacute;as</label><br>
                                                  <input type="radio" name="plan" class="plan_pago" value="3">&nbsp;<label>30-60-90 d&iacute;as</label><br>
                                                  <input type="radio" name="plan" class="plan_pago" value="4">&nbsp;
                                                  <label>Generar</label>  
                                                  <select id="n_cuotas" disabled onchange="calcRefCuota()" style="width:90px" >  
                                                    {n_cuotas} 
                                                  </select> <br> 
                                                <label>cuotas</label>
                                                <span id="msg_valcuota"></span>
                                                <div   style="width: 256px;height:40px;margin-top: 20px;text-align:center">
                                                    <input type="button" id="generar_cuotas" value="Generar Cuota" disabled onclick="generarCuotas()" style="font-size:11px">
                                                </div>                         
                                             </td>
                                             <td id="seccion_cuotas" style="vertical-align: top">
                                                 <div style="height:176px;overflow-y: scroll;"> 
                                                 <table id="lista_cuotas" border="1"  cellspacing="0" cellpadding="0" width="99%"   >
                                                    <tr><th colspan="11" class="titulo_factura">Cuotas</th></tr>  
                                                    <tr class="titulo"><th>N&deg;</th><th>Valor</th><th>Moneda</th><th>Vencimiento</th><th>Estado</th><th style="min-width: 120px">Imprimir Pagar&eacute;</th> </tr>  
                                                            <tr class="cuotas_foot">
                                                                <td> </td> 
                                                                <td class="total_cuotas num">
                                                                  <input class="input_mini num" size="12" readonly style="font-weight:bolder;font-size:14px;padding:0px;border:0px" id="total_cuotas" type="text" value="0,00">
                                                                </td>
                                                                <td colspan="4"></td> 
                                                            </tr>
                                                 </table> 
                                                 </div>    
                                                 <div style="text-align: center"> 
                                                     <input class="cuotas_bar" type="button" onclick="eliminarCuotas()" value="Eliminar cuotas" style="display:none;font-size: 10px;font-weight: bolder">                              
                                                 </div>                         
                                             </td>
                                        </tr>
                                      </table>
                                      <div id="msg_cuotas" style="text-align: center" class="info"></div>
                                  </div>                     
                </td>
            </tr>
            <tr class="venta_credito" >
                <td  valign="top" ><label>CHEQUES: </label></td>
                <td colspan="7" id="cheques">
                     {cheques}
                </td>
            </tr>
            <tr>
                <td><label>TOTAL:</label> </td><td><input id="total" style="color:red" type="text" class="numeric" maxlength="14" size="12" readonly></td>
                <td colspan="3"><label id="label_vuelto">Faltante Gs:</label> 
                    <input id="vuelto" value="{query0_TOTAL}" type="text" class="numeric" maxlength="14" size="12" readonly>
                </td>
                 
                <td> <input id="aceptar" disabled type="button" value="Cerrar Venta" onclick="aceptar()" > </td>
            </tr>
            <tr>
                <td colspan="2"> 
                    <label id="label_factura_legal" style="display:inline" title="Seleccione">Punto Exp N&deg;:</label> 
                    <select id="punto_exp" style="width:90px"  onchange="getFacturas()">
                        <option></option>
                        {puntos_exp}
                    </select>
                    <span id="msg_fact"></span>
                </td>
                <td colspan="3"> 
                    N&deg;:
                    <select id="factura_legal"  style="display:inline;width:auto" class="factura" > </select>     
                    <select id="tipo" onchange="cuotasUI()">
                           <option>Contado</option>
                           <option>Credito</option>
                       </select>
                </td>
                
                     
                <td>                    
                    <input class="porc" type="text" id="porc" size="3" value="100"><label class="porc">%</label>
                </td>
                <td>    
                    <input id="imprimir"  style="display:block" type="button" value="     Imprimir     " onclick=imprimir("{imprimir_factura}") disabled > 
                </td>
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

