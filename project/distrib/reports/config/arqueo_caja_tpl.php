<!-- 
    Report Template File (arqueo_caja)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
	<treset_page>
            <style>
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
            </style>           
<!-- end:   general_header -->


<!-- begin: start_query0 -->
<table class="cheques" style="text-align: left; width: 99%;" border="1" cellpadding="0" cellspacing="0">
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
			style="font-weight: bold;"><big>Arqueo de Caja</big></td>
		  <td style="text-align: right;">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>
	  </tbody>
	</table><hr />
</td></tr>
<!-- end:   start_query0 -->

<!-- begin: header0 -->
    <tr >
       <th>*</th> <th>Moneda</th> <th>Saldo</th>
    </tr>
</thead>
<tfoot>
	<tr><td colspan="50"> </td></tr>
</tfoot>
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
         <tr>
             <td class="itemc" ><img height="24px" width="30px" src="images/{img_moneda}"></td>  <td class="itemc" >{query0_Moneda}</td> <td class="num">{total_Moneda}</td><td style="width: 60%"></td>
         </tr>
<!-- end:    query0_data_row -->
<!-- begin: query0_total_row -->
  
<!-- end:    query0_total_row -->
<!-- begin: query0_subtotal_row -->
   
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<br><br>
<!-- end:   end_query0 -->

