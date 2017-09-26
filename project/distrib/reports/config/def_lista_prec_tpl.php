<!-- 
    Report Template File (def_lista_prec)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
       <script src='include/jquery-1.11.1.js'></script>       
	<treset_page>
            
            <style>
                .tit{
                    font-weight: bolder;
                }
                #cab td{
                    padding: 4px
                }
                .titulo{
                    background-color: #fffccc;
                }
                .rec{
                    display: none; 
                }
                .err{
                    border:solid red 1px;
                }
            </style>
            
            <script language="javascript">
                
               $(function(){
                    $(".precio").on("mouseover",function(){                     
                      $(".rec").fadeIn();
                    });
                    $(".precio").on("mouseout",function(){  
                       setTimeout('$(".rec").fadeOut()',5000);
                    });  
                    $(".precio").change( function(){ 
                        controlar();
                    });
                   
                }); 
                
                function autoasignar(){
                    var costo = parseFloat($("#costo").text().replace(".","").replace(",","."));
                    
                    $(".precio").each(function(){
                        var porc = $(this).attr("data-porc");                        
                        var calc = costo + ((costo * porc) / 100);
                        $(this).val(calc.toFixed(0));
                    });
                    controlar();
                }
                function controlar(){
                    var minimo = parseFloat($("#minimo").text().replace(".","").replace(",","."));
                    //console.log(minimo);
                    var c = 0;
                    $(".precio").each(function(){                                   
                        var v = parseFloat($(this).val());
                        if(v < minimo){
                            $(this).addClass("err"); 
                            c++;                           
                        }else{
                            $(this).removeClass("err");                            
                        }
                    });  
                    if(c > 0){
                        $("#msg").html("CUIDADO! Precio bajo el Minimo.");
                        $("#msg").fadeIn();
                    }else{
                       $("#msg").html("");
                       $("#msg").fadeOut();  
                    }                    
                }
                function guardar(){
                  $(".precio").each(function(){   
                     var codigo = $(this).attr("data-codigo"); 
                     var precio = parseFloat($(this).val());
                     var lista = $(this).attr("data-lista");
                    
                     $.ajax({
                        type: "POST",
                        url: "include/Ajax.class.php",
                        data: "action=guardar_precio&codigo="+codigo+"&precio="+precio+"&lista="+lista,
                        async:true,
                        dataType: "html",
                        beforeSend: function(objeto){
                           $(".rec").fadeIn(); 
                           $(".rec_"+lista).html("<b> Guardando...</b><img src='images/activity.gif' height='12px' width='60px'  >");
                        },
                        complete: function(objeto, exito){
                            if(exito=="success"){    
                               $(".rec_"+lista).html(objeto.responseText);                      
                            }
                            $(".rec").fadeIn();
                        } 
                   });   
                      
                  });                   
                }
                function volver(){
                   self.close();
                }
            </script>
<!-- end:   general_header -->


<!-- begin: start_query0 -->
 
<table id="cab" style="text-align: left; width: 100%;" border="1"  cellpadding="0" cellspacing="0">
	  <tbody>
	 
		<tr>
		  <td  style="width: 20%;">
			<small><small>ycube plus RAD [1.2.31]</small></small>
		  </td>
		  <td style="text-align: center; height: 42px"><big
                      style="font-weight: bold;"><big>Definici&oacute;n de Precios</big></td>
		  <td style="text-align: right;">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>                
                <tr>
                    <td class="tit">
                         Art&iacute;culo:
                     </td>
                     <td colspan="3">{sup_codigo}</td>
                 </tr>  
                 <tr>
                     <td class="tit">
                         Descripci&oacute;n:
                     </td>
                     <td colspan="3">{sup_p_descrip}</td>
                 </tr>  
                 <tr>
                     <td class="tit"> Costo Promedio: </td>
                     <td colspan="3" id="costo">{COSTO_PROMEDIO}</td>
                 </tr>
                 <tr>
                     <td class="tit"> Valor M&iacute;nimo: </td>
                     <td colspan="3" id="minimo">{PORC_VALMIN}</td>
                 </tr>
	  </tbody>
	</table>  
<br>
<table style="text-align: left; width: 80%;" border="1" cellpadding="0" cellspacing="0">
       
    

<!-- end:   start_query0 -->

<!-- begin: header0 -->
<tr class="titulo">         
        <th>Categoria</th>
        <th colspan="2">Precio</th>
    </tr>

 
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
         <tr>            
             <td class="itemc" style="font-size: 20px;width:10%" >{query0_num}</td>
             <td style="width:30%">
                 <input data-codigo="{query0_codigo}" data-lista="{query0_num}" data-porc="{query0_valor}" id="precio_{query0_num}"  class="num precio" style="font-size: 20px;width: 100%" type="text" value="{query0_precio_unit}" size="14" >                 
             </td>
             <td style="width:40%"><span class="rec_{query0_num} rec"> Recomendado {query0_valor}% sobre el costo </span></td>
         </tr>
<!-- end:    query0_data_row -->
 
<!-- begin: end_query0 -->
<tr>
    <td colspan="3" style="text-align: center">
        <input type="button" onclick="volver()" value="Volver" >
        <input type="button" onclick="autoasignar()" value="Autoasignar" >
        <input type="button" onclick="guardar()" value="Guardar" >
    </td>
</tr>
</table>
<div id="msg" style="text-align: center;color:white;background-color: red"></div>
<!-- end:   end_query0 -->

