


<!-- begin: general_header noeval -->
  
    <script type="text/javascript" src="../../../../include/jquery-1.3.2.js" > </script>
    <treset_page>
    <style type="text/css">
        @media-print{
            .arrow{
                display:none;
            } 
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
 
    
    .sub{
       border-style: groove;
       border-width: 0px 0px 0px 0px;
        font-size:9px;
        font-family: serif;
     }
        
        
    .marco{
       border:solid gray 0px;
    }
    .curve{
        -moz-border-radius: 9px 9px 9px 9px;
         border:solid 1px;
         border-color: black black black black; 
    }
    .curveb{
        -moz-border-radius: 9px 9px 9px 9px;
         border:solid 1px;
         border-color: gray black black black; 
    }
    label{
        font-size:9px;
        font-family: serif;
    }

    .cab_det{
        font-size:9px;
        font-family:sans-serif;
    }
    .der_ab{
        border-style:solid;
        border-width: 0px 1px 1px 0px;      
    }
    .der{
        border-style:solid;
        border-width: 0px 1px 0px 0px;
    }
    .ab{
        border-style:solid;
        border-width: 0px 0px 1px 0px;
    }
    .item_num{
      text-align:right;
      padding-right:2px;
      font-size:9px;
      border-style:solid;
     border-width: 0px 1px 0px 0px;
    }
    .item{
      text-align:left;
      padding-left:3px;
      font-size:9px;
      border-style:solid;
      border-width: 0px 1px 0px 0px;
    }
    .subtotal{
        border-style:solid;
        border-width: 1px 1px 1px 0px;
        height:26px
    }
    .arrow{
        display:none;
        cursor:pointer;
    }

    </style>
    
    <script language="javascript">
        var nro_factura = 0;
        
        function igualarNombres(){  
           var nombre = $("#primer_nombre").val();   
           $("#segundo_nombre").val(nombre);
           var ci = $("#primer_ci").val();
           $("#segundo_ci").val(ci);
        }
		
		function igualarFechas(){  
           var nombre = $("#primer_fecha").val();   
           $("#segunda_fecha").val(nombre);            
        }  
        
        function verConf(){
           $(".arrow").fadeIn("fast"); 
        }
        function closeConf(){
           $(".arrow").fadeOut("fast"); 
        }
        function saveMargins(key,value){ 
           $.post( "../../../../include/Ajax.class.php", { action:"save_margins", key:key,value:value } ); 
        }        
        function setIntervalo(sign){
            var altura = $("#intervalo").outerHeight(); 
            if(sign == "+"){
                $("#intervalo").css("height",altura+5);   saveMargins("factura_interval_dup",altura+5);
            }else{
                $("#intervalo").css("height",altura-5);   saveMargins("factura_interval_dup",altura-5);
            }
        }

        function setAltura(sign){
            var margen = parseInt($("#marco").css("marginTop").replace('px', ''));// console.log(margen);
            if(sign == "+"){
                $("#marco").css("marginTop",margen+5+"px"); saveMargins("factura_margen_sup",margen+5);
            }else{
                $("#marco").css("marginTop",margen-5+"px"); saveMargins("factura_margen_sup",margen-5);
            }
        } 
        function setMargen(sign,leftRight){
            var margen = parseInt($("#marco").css("margin"+leftRight).replace('px', ''));  
            if(sign == "+"){
                $("#marco").css("margin"+leftRight,margen+5+"px"); if(leftRight == "Left"){ saveMargins("factura_margen_izq",margen+5); }else{ saveMargins("factura_margen_der",margen+5); }
            }else{
                $("#marco").css("margin"+leftRight,margen-5+"px"); if(leftRight == "Left"){ saveMargins("factura_margen_izq",margen-5); }else{ saveMargins("factura_margen_der",margen-5); }
            }
        }  
        $(document).ready(function(){
            $(".config").mouseleave(function(){  closeConf()   });
            $(".config").mouseenter(function(){  verConf()  });
			
			jQuery(document).bind("keyup keydown", function(e){
				if(e.ctrlKey  || e.keyCode == 80){
					closeConf(); 
				}
			});
        });
    </script>  
    
<div class="config" style="text-align: center;position: fixed;top:1px;left:5%;width: 90%;border: solid black 0px;height:20px">
    <img class="arrow" src="../../../../images/arrow-up.png"  onclick=setAltura("-") >    <img class="arrow" src="../../../../images/arrow-down.png"  onclick=setAltura("+")  >
</div>  
    
 <div id="message" class="message"  style="opacity:0;"  >  <img  onclick="cerrarPopup()" style="float:right;cursor:pointer;" src="images/12-em-cross.png" />  </div>

<!-- end:   general_header -->


<!-- begin: start_marco -->

<input type="hidden" id="suc" value="{suc}" >

<div id="marco" class="marco" style="margin: {margenes};" >
<!-- end:   start_marco -->


<!-- begin: cabecera -->
<table  width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="curveb">
               <table border="0" border="0" cellpadding="0" cellspacing="0" width="100%">
                 <tr>
                   <td style="width:60%"><label class="label">&nbsp;&nbsp;NOMBRE O RAZ&Oacute;N SOCIAL:</label>&nbsp;
                   <input id="{id_nombre}" onkeyup="igualarNombres()" class="sub" type="text" size="50" value="{cliente}" /> </td>  

                   <td><label>VENDEDOR:</label><label>&nbsp;{vendedor}</label></td>

                 </tr>
                 <tr><td><label>&nbsp;&nbsp;R.U.C.:</label> &nbsp; 
                  <input id="{id_doc}" onkeyup="igualarNombres()" class="sub" type="text" size="30" value="{doc}" /> </td>         
                 </td> <td><label>Int: &nbsp;{ref}&nbsp; </label>  </td>  </tr>
                 <tr>
				 <td>
				    <label>&nbsp;&nbsp;FECHA: </label>
					<input id="{id_fecha}" onkeyup="igualarFechas()" class="sub" type="text" size="50" value="{fecha}" />
				 </td> 
				 <td>
				 <label>CONDICI&Oacute;N DE VENTA:</label>&nbsp;
                   <label>CONTADO       </label><label style="border:solid 1px;">{contado}</label>&nbsp;&nbsp;

                   <label>CR&Eacute;DITO&nbsp;</label><label style="border:solid 1px;">{credito}</label>

                   </td>    </tr>
               </table>                
                
                
            </td>
        </tr>
    
</table>
<!-- end:   cabecera -->


 
<!-- begin: cabecera_detalle -->
<table  width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="curveb">
               <table  width="100%"  border="0" cellpadding="0" cellspacing="0">
                 <tr class="cab_det" style="text-align:center" >
                     <td style="width:50px;height:18px" class="der_ab">C&Oacute;DIGO</td>
                     <td style="width:40px;" class="der_ab">CANT.</td>
                     <td class="der_ab">DESCRIPCI&Oacute;N</td>
                     <td style="width:65px;" class="der_ab">PRECIO UNIT.</td>
                     <td style="width:50px;" class="der_ab">EXENTAS</td>
                     <td style="width:45px;" class="der_ab">5%</td>
                     <td style="width:60px;" class="ab">10%</td>
                 </tr>
<!-- end:   cabecera_detalle -->


<!-- begin: detalle -->

        <tr>
           <td class="item"  >&nbsp; {codigo} </td>
           <td class="item_num"  > {cantidad} </td>
           <td class="item"  > {descrip} </td>
           <td class="item_num"  > {precio} </td>
           <td class="item_num" style="text-align:center" > {subtotal_IVA_EXE} </td>
           <td class="item_num" style="text-align:{iva_5_align}" > {subtotal_IVA_5} </td>
           <td class="item_num" style="border:0px;text-align:{iva_10_align}" > {subtotal_IVA_10} </td>
        </tr>

<!-- end:   detalle -->

<!-- begin: detalle_vacio -->

        <tr>
           <td class="item"      style="text-align:center"  > / </td>
           <td class="item_num"  style="text-align:center" > / </td>
           <td class="item"      style="text-align:center" > / </td>
           <td class="item_num"  style="text-align:center" > / </td>
           <td class="item_num"  style="text-align:center" > / </td>
           <td class="item_num"  style="text-align:center" > / </td>
           <td class="item_num"  style="border:0px;text-align:center"  > / </td>
        </tr>

<!-- end:   detalle_vacio -->

<!-- begin: pie_detalle -->
               <tr>
                <td align="center" class="subtotal" ><label>SUBTOTAL</label></td>
                <td colspan="3" class="subtotal">&nbsp;</td>
                
                <td class="item_num" style="border-style:solid;border-width: 1px 1px 1px 0px;" >{totalexe}</td>
                <td class="item_num" style="border-style:solid;border-width: 1px 1px 1px 0px;">{total5}</td>
                <td class="item_num" style="border-style:solid;border-width: 1px 0px 1px 0px;">{total10}</td>
               </tr>
               <tr>
               <td colspan="5" style="height:30px;border-style:solid;border-width: 0px 0px 1px 0px;"><label>&nbsp;<b>TOTAL A PAGAR Gs.: </b>&nbsp;{total_letras}~~~~....................................</label> </td>
                <td align="center" colspan="2" style="border-style:solid;border-width: 0px 0px 1px 0px;"  >
                  <label style="float:right ;margin:1px 4px 1px 1px; font-weight:bolder;-moz-border-radius: 3px 3px 3px 3px; width: 7em; font-size: .7em; line-height: 2;border-style:solid;border-width: 1px 1px 1px 1px;"  >&nbsp;&nbsp;{total}&nbsp;Gs.&nbsp;&nbsp;&nbsp;</label> &nbsp;&nbsp;</td>
                </tr>
               <tr>
                <td colspan="2"  style="height:20px; padding-left:2px"> 
                    <label><b>TASA DEL IVA:</b>&nbsp;(5%)&nbsp;&nbsp;{iva_5}&nbsp;&nbsp;~~~~</label> 
                </td>
                <td align="left" > &nbsp;&nbsp;
                    <label style="width:230px;text-align:center;"><b>(10%)</b>&nbsp;&nbsp;{iva_10}&nbsp;&nbsp;~~~~</label>   &nbsp;&nbsp;&nbsp;&nbsp; 
                    <label><b>TOTAL IVA:</b>&nbsp;{total_iva}&nbsp;~~~~</label>  </td>
                    <td colspan="4" style="text-align:center;vertical-align:bottom; " ><label style=""> </label></td>
               </tr>
               </table>
            </td>
        </tr>
</table>
<!-- end:   pie_detalle -->



<!-- begin: intervalo -->
<div id="intervalo" class="config"  style="height:{intervalo};text-align: center"    > 
     
    <img class="arrow" src="../../../../images/arrow-left.png" onclick=setMargen("-","Left")  > <img class="arrow" src="../../../../images/arrow-right.png" onclick=setMargen("+","Left") >  
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img class="arrow" src="../../../../images/arrow-up.png"  onclick=setIntervalo("-") >    <img class="arrow" src="../../../../images/arrow-down.png"  onclick=setIntervalo("+")  > 
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <img class="arrow" src="../../../../images/arrow-left.png" onclick=setMargen("+","Right")> <img class="arrow" src="../../../../images/arrow-right.png" onclick=setMargen("-","Right")>
</div> 
<!-- end:   intervalo -->




<!-- begin: end_marco -->
</div>
<!-- end:   end_marco -->
