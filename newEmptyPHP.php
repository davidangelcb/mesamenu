<script type="text/javascript" src="../js/jquery.js"></script>
<script>
$(document).ready(function(){
	$("#selectB").change(function(){
	 var select = $("#selectB").val();
		$.post("inc/user/asincrono.php", { valor: select },
		function(data){
		 $("#contenedor").html(data);
		});
	});

});
$(document).ready(function(){
        $("#selectC").change(function(){
         var select = $("#selectC").val();
                $.post("inc/user/asincronoC.php", { valor: select },
                function(dataC){
                 $("#contenedorC").html(dataC);
                });
        });

});
</script>
<?php
include ("../../conexion/conecta-report.php");

if(!valid()){forcenoaccess();};

	$slid 				= 	$_REQUEST['slid'];
	$date 				=	date("Y-m-d");
	
switch ($op)
{
    case "user_outgoing":
	if(!$page){$page = 1;}
	if(!$nav){$nav = 1;}
	
	$line_per_page = 25;
	$max_nav = 15;
               
	$widthRow = 20;
	$contentAdd="";
	$HeaderAdd="";
	if((int)$uid==553){
		$HeaderAdd='<th align=left width=$widthRow%>Descarga</th>';
		$widthRow = 17;
	}     
			   
	//agregando reporte general
	$content = "
	<h2>Total</h2>	
	<table width=\"100%\">
                <tr>
                        <td>
                      	<h2>Elige Fecha:</h2>
                        </td>
                        <td>
                                <select id=\"selectC\">
                                        <option value=\"-1\">Seleccionar</option>
                                        <option value=\"4\">Fechas</option>
                                </select>
                        </td>
                </tr>
                <tr>
                        <td colspan=\"2\">
                        <form action=\"\" method=\"post\" name=\"formol\">
                                <div id=\"contenedorC\"></div>
                        </form>
                        </td>
                </tr>
        </table>
	<form name=\"fm_outgoing_01\">
            <table width=100% cellpadding=1 cellspacing=2 border=0 class=\"sortable\">
        <thead>
            <tr>
              <th align=left width=4>*</th>
	      <th align=left width=$widthRow%>"._('Fecha')."</th>
<!--	      <th align=left width=20%>"._('Entregados')."</th>-->
              <th align=left width=20%>"._('Enviados')."</th>
              <th align=left width=$widthRow%>"._('Fallados')."</th>
              <th align=left width=$widthRow%>"._('Pendiente')."</th>
              $HeaderAdd    
            </tr>
        </thead>
        <tbody>
	";
	
	$db_query1 = "SELECT count(*) as count FROM "._DB_PREF_."_tblSMSOutgoing WHERE uid='$uid' AND p_status in (1,3)";
	$db_query1.="AND DATE(p_datetime) BETWEEN DATE('".$_REQUEST["f_fecha_desde_total"]."') AND DATE('".$_REQUEST["f_fecha_hasta_total"]."')";
	$db_result = dba_query($db_query1);
        $db_row = dba_fetch_array($db_result);
	$sms_delivered = $db_row['count'];
	$db_query = "SELECT count(*) as count FROM "._DB_PREF_."_tblSMSOutgoing WHERE uid='$uid' AND p_status='0' ";
	$db_query.="AND DATE(p_datetime) BETWEEN DATE('".$_REQUEST["f_fecha_desde_total"]."') AND DATE('".$_REQUEST["f_fecha_hasta_total"]."')";
        $db_result = dba_query($db_query);
        $db_row = dba_fetch_array($db_result);
        $sms_pending = $db_row['count'];
	$db_query = "SELECT count(*) as count FROM "._DB_PREF_."_tblSMSOutgoing WHERE uid='$uid' AND p_status='2' ";
	$db_query.="AND DATE(p_datetime) BETWEEN DATE('".$_REQUEST["f_fecha_desde_total"]."') AND DATE('".$_REQUEST["f_fecha_hasta_total"]."')";
        $db_result = dba_query($db_query);
        $db_row = dba_fetch_array($db_result);
        $sms_failed = $db_row['count'];
	$db_query = "SELECT count(*) as count FROM "._DB_PREF_."_tblSMSOutgoing,"._DB_PREF_."_tblBilling WHERE "._DB_PREF_."_tblSMSOutgoing.uid='$uid' AND "._DB_PREF_."_tblSMSOutgoing.smslog_id="._DB_PREF_."_tblBilling.smslog_id and "._DB_PREF_."_tblBilling.status='2'";
	$db_query.="AND DATE("._DB_PREF_."_tblSMSOutgoing.p_datetime) BETWEEN DATE('".$_REQUEST["f_fecha_desde_total"]."') AND DATE('".$_REQUEST["f_fecha_hasta_total"]."')";
        $db_result = dba_query($db_query);
        $db_row = dba_fetch_array($db_result);
        $sms_refunded = $db_row['count'];
	$sms_total_sent = $sms_delivered;
        $sms_total = $sms_total_sent + $sms_failed + $sms_pending;

	$desde = $_REQUEST["f_fecha_desde_total"];
	$hasta = $_REQUEST["f_fecha_hasta_total"];
        
        
    // agregando link para reporte
	if((int)$uid==553){
		$contentAdd="<td valign=top class=$td_class align=right width=12%><a href='../getCsvByFecha.php?f_fecha_desde_total=$desde&f_fecha_hasta_total=$hasta' style=''>[D]<img src='/csv_icon.png' border='0'/></a></td>";
	}     
	$content .= "
                <tr>
                  <td valign=top class=$td_class align=left width=4>Total:$sms_total SMS</td>
                  <td valign=top class=$td_class align=right width=$widthRow%>$desde::$hasta</td>
                  <td valign=top class=$td_class align=right width=20%>$sms_total_sent</td>
       <!--           <td valign=top class=$td_class align=right width=20%>$sms_sent</td>-->
                  <td valign=top class=$td_class align=right width=$widthRow%>$sms_failed</td>
                  <td valign=top class=$td_class align=right width=$widthRow%>$sms_pending</td>
                  $contentAdd
                </tr>

	</form>
	";
	//termina reporte mensual
	$content .= "
	<br><br>
	<table width=\"100%\">
		<tr>
			<td> 
			<h2>	Buscar por:</h2>
			</td>
			<td>
				<select id=\"selectB\">
					<option value=\"-1\">Seleccionar</option>
					<option value=\"0\">Fechas</option>
					<option value=\"1\">Destinatario</option>
					<option value=\"2\">Estado</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan=\"2\">
			<form action=\"\" method=\"post\" name=\"formol\">
				<div id=\"contenedor\"></div>
			</form>
			</td>
		</tr>
	</table>";
	$url = "";
	$db_query = "SELECT count(*) as count FROM "._DB_PREF_."_tblSMSOutgoing WHERE uid='$uid' AND flag_deleted='0' ";
	if(isset($_REQUEST["f_fecha_desde"]) and isset($_REQUEST["f_fecha_hasta"]))
	{
		$url= "&buscar=yugi&f_fecha_desde=".$_REQUEST["f_fecha_desde"]."&f_fecha_hasta=".$_REQUEST["f_fecha_hasta"];
		$db_query.="AND DATE(p_datetime) BETWEEN DATE('".$_REQUEST["f_fecha_desde"]."') AND DATE('".$_REQUEST["f_fecha_hasta"]."')";
	}
	elseif(isset($_REQUEST["destinatario"]))
	{
		$url = "&buscar=yugi&destinatario=".$_REQUEST["destinatario"];
		//$db_query.="AND p_dst = '".$_REQUEST["destinatario"]."'";
		//$dest = '%'.$_REQUEST["destinatario"].'%';
		$db_query.="AND p_dst like '%".$_REQUEST["destinatario"]."%'";
	}
	elseif(isset($_REQUEST["estado"]))
	{
		$url = "&buscar=yugi&estado=".$_REQUEST["estado"];
		$db_query.="AND p_status = '".$_REQUEST["estado"]."'";
	}

	$db_result = dba_query($db_query);
	$db_row = dba_fetch_array($db_result);
	$num_rows = $db_row['count'];
	//echo $num_rows;

	$pages = ceil($num_rows/$line_per_page);
	$nav_pages = themes_navbar($pages, $nav, $max_nav, "index.php?app=menu&inc=user_outgoing&op=user_outgoing".$url, $page);
	$limit = ($page-1)*$line_per_page;
	//echo "(".$page."-1)*".$line_per_page."<br><br>";
	//die($limit."asdasdfsethdfy");
if(isset($_REQUEST['buscar']))
{

	$db_query2 = "
	SELECT 
		*
	FROM 
		"._DB_PREF_."_tblSMSOutgoing 
	WHERE 
		uid='$uid'
	AND 
		flag_deleted='0' 
	AND ";
		if(isset($_REQUEST["f_fecha_desde"]) and isset($_REQUEST["f_fecha_desde"]))
		{
			$db_query2.="DATE(p_datetime) BETWEEN DATE";
			$db_query2.="('".$_REQUEST["f_fecha_desde"]."') AND DATE('".$_REQUEST["f_fecha_hasta"]."')";
		}
		elseif(isset($_REQUEST["destinatario"]))
		{
			//$db_query2.="p_dst = '".$_REQUEST["destinatario"]."'";
			
			$db_query2.="p_dst like '%".$_REQUEST["destinatario"]."%'";
		}
		elseif(isset($_REQUEST["estado"]))
		{
			$db_query2.="p_status = '".$_REQUEST["estado"]."'";
		}
	$db_query2.=" ORDER BY smslog_id DESC LIMIT $limit,$line_per_page";
	//echo $db_query2;
}
else
{
	//die("asdasd");
	$db_query2 = "
	SELECT 
		* 
	FROM 
		"._DB_PREF_."_tblSMSOutgoing 
	WHERE 
		uid='$uid' 
	AND 
		flag_deleted='0' 
	ORDER BY smslog_id DESC LIMIT $limit,$line_per_page";
}
	$content .= "
	    <p>$nav_pages</p>
	    <form name=\"fm_outgoing\">
	    <table width=100% cellpadding=1 cellspacing=2 border=0 class=\"sortable\">
        <thead>
	    <tr>
	      <th align=center width=4>*</th>
	      <th align=center width=20%>"._('Fecha')."</th>
	      <th align=center width=10%>"._('Destino')."</th>
	      <th align=center width=40%>"._('Mensaje')."</th>
	      <th align=center width=10%>"._('Estado')."</th>
	      <th align=center width=4>"._('Grupo')."</th>
	    </tr>
        </thead>
        <tbody>
	";


	//echo $db_query2;
	$db_result = dba_query($db_query2);
	$i = ($num_rows-($line_per_page*($page-1)))+1;
	$j=0;
	while ($db_row = dba_fetch_array($db_result))
	{
	    $j++;
	    $current_slid = $db_row['smslog_id'];
	    $p_dst = $db_row['p_dst'];
	    $p_desc = phonebook_number2name($p_dst);
	    $current_p_dst = $p_dst;
	    if ($p_desc) 
	    {
			$current_p_dst = "$p_dst<br>($p_desc)";
	    }
	    $hide_p_dst = $p_dst;
	    if ($p_desc) 
	    {
			$hide_p_dst = "$p_dst ($p_desc)";
	    }
	    $p_sms_type = $db_row['p_sms_type'];
	    $hide_p_dst = str_replace("\'","",$hide_p_dst);
	    $hide_p_dst = str_replace("\"","",$hide_p_dst);
	    $p_msg = core_display_text($db_row['p_msg'], 25);
	    //deshabilitar footer added to message
	    //if (($p_footer = $db_row['p_footer']) && (($p_sms_type == "text") || ($p_sms_type == "flash")))
	   // {
			$p_msg = $p_msg." $p_footer";
	    //}
	    //end
	    $p_datetime = $db_row['p_datetime'];
	    $p_update = $db_row['p_update'];
	    $p_status = $db_row['p_status'];
	    $p_gpid = $db_row['p_gpid'];
	    // 0 = pending
	    // 1 = sent
	    // 2 = failed
	    // 3 = delivered
	    if ($p_status == "1") 
	    { 
			$p_status = "<p><font color=green>"._('Enviado')."</font></p>"; 
	    } 
	    else if ($p_status == "2")
	    { 
			$p_status = "<p><font color=red>"._('Fall&oacute;')."</font></p>"; 
	    }
	    else if ($p_status == "3")
	    {
			$p_status = "<p><font color=green>"._('Enviado')."</font></p>"; 
	    }
	    else
	    { 
			$p_status = "<p><font color=orange>"._('Pendiente')."</font></p>"; 
	    }
	    if ($p_gpid) 
	    { 
			$p_gpcode = strtoupper(phonebook_groupid2code($p_gpid));
	    }
	    else
	    {
			$p_gpcode = "&nbsp;";
	    }
	    $i--;
	    $td_class = ($i % 2) ? "box_text_odd" : "box_text_even";	    
	    $content .= "
		<tr>
	          <td valign=top class=$td_class align=left width=4>$i.</td>
	          <td valign=top class=$td_class align=center width=10%>$p_update</td>
	          <td valign=top class=$td_class align=center width=20%>$current_p_dst</td>
	          <td valign=top class=$td_class align=left width=60%>$p_msg</td>
	          <td valign=top class=$td_class align=center width=10%>$p_status</td>
	          <td valign=top class=$td_class align=center width=4>$p_gpcode</td>
		</tr>
	    ";
	}
	
	$content_if_i_0 = "
		<form name=\"fm_outgoing\">
            <table width=100% cellpadding=1 cellspacing=2 border=0 class=\"sortable\">
        <thead>
            <tr>
              <th align=center width=4>*</th>
              <th align=center width=20%>"._('Fecha')."</th>
              <th align=center width=10%>"._('Destino')."</th>
              <th align=center width=40%>"._('Mensaje')."</th>
              <th align=center width=10%>"._('Estado')."</th>
              <th align=center width=4>"._('Grupo')."</th>
            </tr>
        </thead>
        </form>
        ";

	
	
	//$item_count = $j;
	$content .= "
	</tbody></table>
	</form>
	<p>$nav_pages</p>
	";
	if ($err)
	{
	    echo "<div class=error_string>$err</div><br><br>";
	}
	echo $content;
	break;
}
//mysql_close($cn);
?>
