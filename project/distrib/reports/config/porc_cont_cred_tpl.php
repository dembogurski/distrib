<!-- 
    Report Template File (porc_cont_cred)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
       
       <treset_page>
       <script src='include/jquery-1.11.1.js'></script>  
       <style>
           .numb{
               font-weight: bolder;
               font-size: 14px;
               text-align:right;
               padding-right:3px;
               padding-left:3px;
           }
           .contado { 
               background-color:#D2E5F3;
           }
           .credito { 
               background-color:#DED5F2;
           }
       </style>
       
       <script>
           // parseFloat($("#"+id).val().replace(/\./g, '').replace(/\,/g, '.'));
           
           $(document).ready(function(){               
              
             setTimeout("iniciar()",2500);
           });
           function iniciar(){ 
                    $('[class^=total_]').each(function(){  
                        var val = parseFloat($(this).text().replace(/\./g, '').replace(/\,/g, '.')); 
                        var hash = ($(this).attr('class').split(" ")[0]).substring(6,200);

                        $(".cont_"+hash).each(function(){
                            var valor_contado = parseFloat($(this).text().replace(/\./g, '').replace(/\,/g, '.'));
                            var porc_contado =  ((valor_contado * 100) / val).toFixed(2);
                            $(this).next().html(porc_contado+"%");

                            var valor_credito = parseFloat($(this).next().next().text().replace(/\./g, '').replace(/\,/g, '.'));
                            var porc_credito  =  ((valor_credito * 100) / val).toFixed(2);
                            $(this).next().next().next().html(porc_credito+"%");
                        });

                    });
             }
       </script>    
<!-- end:   general_header -->


<!-- begin: start_query0 -->
<table style="text-align: left; width: 99%;" border="1" cellpadding="0" cellspacing="0">
    <tbody>
    <thead>
<tr> <td colspan="50"> 
	<table style="text-align: left; width: 100%;" border="1"
	 cellpadding="0" cellspacing="0">
	  <tbody>
		<tr>
		  <td style="width: 20%;height:40px;"> </td>
		  <td style="text-align: center;width: 60%;">
			<b>{company}</br></td>
		  <td class="num">
			<tpage><b>Pag: </b></tpage></td>
		</tr>
		<tr>
		  <td  style="width: 20%;">
			<small><small>ycube plus RAD [1.2.31]</small></small>
		  </td>
		  <td style="text-align: center;"><big
			style="font-weight: bold;"><big>Ventas Contado vs Credito</big></td>
		  <td class="num">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>
                <tr><th colspan="3" style="text-align: center">Periodo: {desde} <--> {hasta} </th></tr>
	  </tbody>
	</table> 
</td></tr>
<!-- end:   start_query0 -->

<!-- begin: header0 -->
<tr class="titulo">
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Contado</th>
        <th>%Contado</th>
        <th>Financiado</th>
        <th>%Financiado</th>
    </tr>
</thead>
<tfoot>
	<tr><td colspan="50"><hr /></td></tr>
</tfoot>
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
         <tr>
            <td class="item">{query0_Cliente}</td>
            <td class="item">{query0_Fecha}</td>
            <td class="cont_{hash} num contado" >{query0_Contado}</td>
            <td class="cont_porc_{hash} num contado">Calc..<img src="images/loadingt.gif" height="14px" width="14px"></td>
            <td class="cred_{hash} num credito">{query0_Financiado}</td>
            <td class="porc_cred_{hash} num credito">Calc..<img src="images/loadingt.gif" height="14px" width="14px"></td>
         </tr>
<!-- end:    query0_data_row -->
<!-- begin: query0_total_row -->
        <tr>
            <td style="font-weight: bolder;" >Total General:</td>
            <td class="numb total_general" >{total0}</td>
            <td class="numb" >{total0_Contado}</td>
            <td class="numb">{porc_total_Contado}%</td>
            <td class="numb" >{total0_Financiado}</td>
            <td class="numb">{porc_total_Financiado}%</td>
        </tr>
<!-- end:    query0_total_row -->
<!-- begin: query0_subtotal_row -->
        <tr>
            <td style="font-weight: bolder;" >Totales:</td>
            <td class="total_{hash} numb">{subtotal0}</td>
            <td class="numb sub_cont_{hash}" >{subtotal0_Contado}</td>
            <td class="numb">{porc_Contado}%</td>
            <td class="numb sub_cred_{hash}" > {subtotal0_Financiado}</td>
            <td class="numb">{porc_Financiado}%</td>
        </tr>
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<!-- end:   end_query0 -->

