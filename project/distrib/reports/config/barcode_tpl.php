<!-- 
    Report Template File (barcode)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval --> 
       <script type="text/javascript" src="include/jquery-1.3.2.js"></script>
	<treset_page>
<style type="text/css">
    body{
        margin-left:0px;
        margin-top: 4px;
    }
    .descrip{
        font-family: Arial;
        font-size: 12px;
        heigth:60px;    
    } 
    .codigo{
        font-weight: bolder;
        font-family: arial;
        text-align: center
    } 
 
    .texto{
        width: 100%;
        border:solid 0px white; 
        font-size:11px;
        text-align: right
    } 
    .anchorTitle {
                /* border radius */
                -moz-border-radius: 0px 8px 8px 8px;
                -webkit-border-radius: 8px;
                border-radius: 0px 8px 8px 8px;
                /* box shadow */
                -moz-box-shadow: 2px 2px 3px #e6e6e6;
                -webkit-box-shadow: 2px 2px 3px #e6e6e6;
                box-shadow: 2px 2px 3px #e6e6e6;
                /* other settings */
                background-color: #fff;
                border: solid 3px orange;
                color: #333;
                display: none;
                font-family: Helvetica, Arial, sans-serif;
                font-size: 12px;
				margin-left:20px;
                line-height: 1.3;
                max-width: 500px;
                padding: 5px 7px;
                position: absolute;
                margin-top: -3px;
            }

</style> 

<script language="javascript">
$(document).ready(function() {

                $('body').append('<div id="anchorTitle" class="anchorTitle"></div>');

                $('[title!=""]').each(function() {

                    var a = $(this);

                    a.hover(
                        function() {
                            showAnchorTitle(a, a.data('title'));
                        },
                        function() {
                            hideAnchorTitle();
                        }
                    )
                    .data('title', a.attr('title'))
                    .removeAttr('title');
                });

            

            });

            function showAnchorTitle(element, text) {

                var offset = element.offset();

                $('#anchorTitle') .css({
                    'top'  : (offset.top + element.outerHeight() + 4) + 'px',
                    'left' : offset.left + 'px'
                }).html(text).show();

            }

            function hideAnchorTitle() {
                $('#anchorTitle').hide();
            } 
</script>
          
<!-- end:   general_header -->


<!-- begin: start_query0 -->

<!-- end:   start_query0 -->

<!-- begin: header0 -->
 
 
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
<div style="height:6px">&nbsp;</div>
<table style="text-align: left; width: {code_bar_label_width}px;margin-left: {code_bar_left};font-family: arial" border="0" cellpadding="0" cellspacing="0" title="Presione Ctrol + P para Imprimir" > 
       <tr>   
           <td  class="descrip"> <b>Descrip:</b>&nbsp;{descrip} </td> 
       </tr>
       <tr> <td class="descrip" style="height:22px"><b>Precio:</b>&nbsp;{query0_precio} Gs.&nbsp;Stock:<b>{stock}</b>&nbsp;{um}</td> </tr>
       <tr><td class="codigo" ><img border="0" src="{codigo_barras}" width="{code_bar_width}px" height="{code_bar_height}px" align="middle" ></td></tr> 
       <tr>
            <td class="codigo">{query0_codigo}</td>
       <tr>     
</table>      
<div style="height:{code_bar_interval}px">&nbsp;</div>
<!-- end:    query0_data_row -->
 
<!-- begin: end_query0 -->

<!-- end:   end_query0 -->

