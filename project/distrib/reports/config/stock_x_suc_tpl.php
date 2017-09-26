<!-- 
    Report Template File (stock_x_suc)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
       <script src='include/jquery-1.11.1.js'></script>  
	<treset_page>
            <script language="javascript">
                function calcCant(id){
                    var cantidad = parseFloat($("#cant_"+id).attr("data-cant"));
                    var mult = parseFloat($("#"+id).val());
                    var convert_cant = cantidad /  mult;
                    $("#cant_"+id).html(convert_cant);
                     
                }
            </script>   
            <style>
                .cant_th th{
                    font-size: 18px                        
                }
                .cant{
                    font-size: 18px
                }
            </style>
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
			<b>{company}</b></td>
		  <td style="text-align: right;">
			<tpage><b>Pag: </b></tpage></td>
		</tr>
		<tr>
		  <td  style="width: 20%;">
			<small><small>ycube plus RAD [1.2.31]</small></small>
		  </td>
		  <td style="text-align: center;"><big
			style="font-weight: bold;"><big>Cantidades</big></td>
		  <td style="text-align: right;">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>
	  </tbody>
          <tr>
              <td colspan="3">{sup_codigo} - {sup_p_descrip}</td>
          </tr>
	</table> 
</td></tr>
<!-- end:   start_query0 -->

<!-- begin: header0 -->
    
</thead>
<tfoot>
	 
</tfoot>
    </tbody>
</table>

<table border="1">
    <tr class="cant_th">       
        <th>Suc</th>
        <th>UM</th>       
        <th>Cantidad</th>
    </tr>
<!-- end:   header0 -->

<!-- begin: query0_data_row -->

<tr class="cant">            
            <td>{query0_Suc}</td>
            <td>
                <select id="{query0_Codigo}_{query0_Suc}" onchange="calcCant(this.id)" >
                  {query0_UM}
                </select>
            </td>            
            <td  id="cant_{query0_Codigo}_{query0_Suc}" data-cant="{query0_Cantidad}" style="text-align: right;margin-right: 4px"  >{query0_Cantidad}</td>
         </tr>
        
<!-- end:    query0_data_row -->
<!-- begin: query0_total_row -->
 
<!-- end:    query0_total_row -->
<!-- begin: query0_subtotal_row -->
 
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
</table> 
<!-- end:   end_query0 -->

