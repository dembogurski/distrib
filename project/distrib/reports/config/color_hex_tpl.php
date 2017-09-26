<!-- 
    Report Template File (color_hex)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
       
       
       
        <link  rel="stylesheet" href="colorpicker/css/colorpicker.css" type="text/css" />
        <link rel="stylesheet" media="screen" type="text/css" href="colorpicker/css/layout.css" />
         
        <script type="text/javascript" src="colorpicker/js/jquery.js"></script>
        <script type="text/javascript" src="colorpicker/js/colorpicker.js"></script>
        <script type="text/javascript" src="colorpicker/js/eye.js"></script>
        <script type="text/javascript" src="colorpicker/js/utils.js"></script>
        <script type="text/javascript" src="scolorpicker/js/layout.js?ver=1.0.2"></script>
	<treset_page>
 
            <script>
       $(document).ready(function(){
            var actual = window.opener.document.getElementById("hex").value;
            $('#tmp_hexa').val('#' +actual);
            $('#hexa').ColorPicker({
			flat: true,
			color: '#'+actual,
			onChange: function(hsb, hex, rgb) {
				$('#tmp_hexa').css('backgroundColor', '#' + hex);
                                $('#tmp_hexa').val(hex);
                                window.opener.document.getElementById("hex").value =hex;
                                window.opener.document.getElementById("hbox_hex").setAttribute("style","background:#"+hex+""); 
			}
		});
                     
       });         
          
            
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
			<b>{company}</b></td>
		  <td style="text-align: right;">
			<tpage><b>Pag: </b></tpage></td>
		</tr>
		<tr>
		  <td  style="width: 20%;">
			<small><small>ycube plus RAD [1.2.31]</small></small>
		  </td>
		  <td style="text-align: center;"><big
			style="font-weight: bold;"><big>Capturar Codigo Hexadecimal</big></td>
		  <td style="text-align: right;">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>
	  </tbody>
	</table><hr />
</td></tr>
<!-- end:   start_query0 -->

<!-- begin: header0 -->
    <tr>
        <th>Codigo Hexadecimal</th>
    </tr>
</thead>
<tfoot>
	<tr><td colspan="50"><hr /></td></tr>
</tfoot>
<!-- end:   header0 -->

<!-- begin: query0_data_row noeval -->
         <tr>
             <td>
                 
                <p id="hexa">         </p>
                <pre>
                    
                </pre>                 
             </td>
         </tr>
<!-- end:    query0_data_row -->
<!-- begin: query0_total_row -->
        <tr>
            <td><b>Codigo Hexadecimal:</b><input type="text" id="tmp_hexa" size="8" style="text-align: center;font-size: 18px"> 
                <input type="button" onclick="javascript:self.close()" value="Aceptar" style="text-align: center;font-size: 16px"></td>
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

