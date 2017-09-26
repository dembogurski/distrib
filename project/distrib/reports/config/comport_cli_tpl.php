<!-- 
    Report Template File (comport_cli)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
	<treset_page>
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
		  <td class="itemc">
			<tpage><b>Pag: </b></tpage></td>
		</tr>
		<tr>
		  <td  style="width: 20%;">
			<small><small>ycube plus RAD [1.2.31]</small></small>
		  </td>
		  <td style="text-align: center;"><big
			style="font-weight: bold;"><big>Reporte de Comportamiento de Cliente</big></td>
		  <td class="itemc">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>
                <tr><td style="text-align: center" colspan="3"><b>Periodo:</b>&nbsp;{desde}&nbsp;<->&nbsp;{hasta}</td></tr>
	  </tbody>
	</table><hr />
</td></tr>
<!-- end:   start_query0 -->

<!-- begin: header0 -->
    <tr>
        <th class="itemc">Articulo \ Precio Venta</th>
        <th class="itemc">0-30</th>
        <th class="itemc">30-60</th>
        <th class="itemc">60-90</th>
        <th class="itemc">90-120</th>
        <th class="itemc">120-150</th>
        <th class="itemc">150-200</th>
        <th class="itemc">200-250</th>
        <th class="itemc">250-300</th>
        <th class="itemc">300-INFINITO</th>
    </tr>
</thead>
<tfoot>
	<tr><td colspan="50"><hr /></td></tr>
</tfoot>
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
         <tr>
            <td class="item">{query0_Articulo}</td>
            <td class="num">{query0_0_30}</td>
            <td class="num">{query0_30_60}</td>
            <td class="num">{query0_60_90}</td>
            <td class="num">{query0_90_120}</td>
            <td class="num">{query0_120_150}</td>
            <td class="num">{query0_150_200}</td>
            <td class="num">{query0_200_250}</td>
            <td class="num">{query0_250_300}</td>
            <td class="num">{query0_300_INFINITO}</td>
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
        </tr>
<!-- end:    query0_total_row -->
<!-- begin: query0_subtotal_row -->
        <tr>
            <td></td>
            <td class="num"><b>{subtotal0_0_30}</b></td>
            <td class="num"><b>{subtotal0_30_60}</b></td>
            <td class="num"><b>{subtotal0_60_90}</b></td>
            <td class="num"><b>{subtotal0_90_120}</b></td>
            <td class="num"><b>{subtotal0_120_150}</b></td>
            <td class="num"><b>{subtotal0_150_200}</b></td>
            <td class="num"><b>{subtotal0_200_250}</b></td>
            <td class="num"><b>{subtotal0_250_300}</b></td>
            <td class="num"><b>{subtotal0_300_INFINITO}</b></td>
        </tr>
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<!-- end:   end_query0 -->

