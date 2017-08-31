<!--
* Zeigen Sie alle Kontakte mit 'Bezeichnung  "," Telefon nummer' und 'name'.
* Dropdown für Bereich_I, Bereich_II, Bereich_III und Bereich_IV
* Suchfeld, um den Kontakt aus der Datenbank zu suchen.
* Kennzeichnen Sie die Rückgabesuchergebnisse zu den Kontakten auf der Seite
-->


<?php
                $result ='';
                $search_query ='';
				$grp_array  ='';
                $servername = "localhost";
                $username = "telefonbuch";
                $DBpassword= "#telNbrs";				
			
        $link = mysql_connect($servername,$username,$DBpassword)
            or die("Unable to connect to MySQL");

        $selected = mysql_select_db("telefonbuch",$link)
            or die("Could not select examples");
			
				$Bereich_num = 0;
				$array_abteil[]  = array();
		        $array_abteil2[] = array();
				$a_json = array();
                $a_json_row = array();
				$copy_result = '';
	         	$i = 0;
		        $j = 0;
				$flag = 0;
				$value_Bereich_Verwaltung = array();
				$Bereich_I = "Verwaltung / Sonstiges";
				$Bereich_II = "Medizinisches Zentrum I";
				$Bereich_IV = "Psychiatrisches Zentrum III";
				$Bereich_III = "Operatives Zentrum II";
				
				// Suchanfrage für name.
                $search_query = "SELECT CONCAT(Titel,' ',Vorname,' ',Nachname ) As name, Bezeichnung , Temp_SNo, CONCAT(`Bezeichnung`,`Telefon`,`Vorname`,`Nachname`)As list ,Telefon, EMail,(EMail <> '')As mail, Abteilung, Abteilung2 FROM neue_telefonbuch1 WHERE 
									UPPER(Abteilung2) LIKE UPPER('%" . $name . "%')OR 
									UPPER(Abteilung) LIKE UPPER('%" . $name . "%')OR 
									UPPER(Bezeichnung ) LIKE UPPER('%" . $name . "%')OR 
									Telefon LIKE '%" . $name . "%'OR 
									Mobil LIKE '%" . $name . "%'OR 
									UPPER(Titel) LIKE UPPER('%" . $name . "%')OR
									UPPER(Vorname) LIKE UPPER('%" . $name . "%')OR
									UPPER(Nachname) LIKE UPPER('%" .$name. "%') OR
									UPPER(Text) LIKE UPPER('%" .$name. "%') OR									
									UPPER(CONCAT_WS('',`Titel`,' ',`Vorname`,' ',`Nachname`))LIKE UPPER('%" . $name . "%')OR
									UPPER(CONCAT_WS('',`Titel`,' ',`Vorname`,' ',`Nachname`))LIKE UPPER('%" . $name . "%')OR
									UPPER(CONCAT_WS(' ',Vorname,' ',Nachname))LIKE UPPER('%" . $name . "%')OR	
									UPPER(CONCAT_WS(' ',Nachname,' ',Vorname))LIKE UPPER('%" . $name . "%') ORDER BY Temp_SNo";									
			
        // $ _GET ['Telefon "] aus edit_telefon.php zum Sortieren der Abteilung

		if($_GET['telefon'] == 'Abteilung' ) 
		{
			$select_abteilung = "SELECT DISTINCT(Abteilung) FROM neue_telefonbuch1 ORDER BY Temp_SNo ";	
						
		}else if ($_GET['telefon'] == 'Aufsteigend Abteilung' )
		{
			$select_abteilung = "SELECT DISTINCT(Abteilung) FROM neue_telefonbuch1 ORDER BY  Abteilung ASC";					
		}else if ($_GET['telefon'] == 'Absteigend Abteilung')
		{
			$select_abteilung = "SELECT DISTINCT(Abteilung) FROM neue_telefonbuch1 ORDER BY Abteilung DESC";
			
		}else {

			$select_abteilung = "SELECT DISTINCT(Abteilung) FROM neue_telefonbuch1 ORDER BY Temp_SNo ";
		}
		
        if($select_abteilung)
		   $res_abteilung   = mysql_query($select_abteilung);
		   	
		// sammeln die abteilung Namen zu Array 'array_abteil
		while ($temp = mysql_fetch_array($res_abteilung))
		{
		   $array_abteil[$i] = $temp[0];
		   $i = $i + 1;	  		   
		}
		
        if(strlen($name)!= 0) {
       	      $result = mysql_query($search_query); 
			  if ($result == FALSE)
			     die(mysql_error());
		}
		

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de-de" lang="de-de">

<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Telefonverzeichnis PRO Klinik Holding GmbH</title>

<script src="jquery.js"></script>
<script language="javascript" type="text/javascript" >
<!--

// Funktion, um die Suche auf den Vorschlägen (Kontakt) nach unten Funktion vorzunehmen
function fill(Value,num)
{  
	$("#name").val(Value);
	/*	
	if(Value != "")
	{
		$.ajax({
				type: "GET",		
				url: "#",
				data: "name="+ Value ,
				success: function(html){
					$("#allover").html(html).show();
					$("#allover").load(setSize());
				}
			});
	}	*/	
}

//Funktion zur Anzeige der Vorschläge im Suchfeld
$(document).ready(function(){
	$("#name").keyup(function() {
		var name = escape($('#name').val());
		if(name=="")
		{
			$("#dropdown_list").html("");
		}
        else if(name.length>=2)
		{
			$.ajax({
				type: "POST",
				url: "ajax1.php",
				data: "name="+ name ,
				success: function(html){
					$("#dropdown_list").html(html).show();
					
				}
			});
		}
	});
});
// Javascript for setting the size of the window.
function setSize() {
	//alert("setSize");
	var myWidth = 0, myHeight = 0;
	
	if( typeof( window.innerWidth ) == 'number' ) {
		//Non-IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
	} else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
		//IE 6+ in 'standards compliant mode'
		myWidth = document.documentElement.clientWidth;
		myHeight = document.documentElement.clientHeight;
	} else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
		//IE 4 compatible
		myWidth = document.body.clientWidth;
		myHeight = document.body.clientHeight;
	}
	//alert(myWidth+','+myHeight);
	//höhe des kopfbereichs
	kopfhoehe = document.getElementById('header').offsetHeight;
	document.getElementById('content').style.height = (myHeight - kopfhoehe - 4) + 'px';
	//linken rand für die suchergebnisauswahl setzen
	document.getElementById('such_erg').style.left = document.getElementById('content').offsetLeft + 'px';
}

function suchhilfe() {
   var such_datei = document.getElementById('name').value;
   if ((such_datei == "") || (such_datei == "0")){
      alert('Es wurde kein weiterer Eintrag gefunden.');
   } 
}

function ChangeId(id)
{
	if (id.value != "")
	{
		window.location.href='#'+id.value;
	}
}


-->
</script>
<link rel="stylesheet" href="styles1.css" type="text/css">

<link rel="shortcut icon" href="http://samba1.ruppiner-kliniken.de/Projekte/edv/telefonbuch/favicon.ico" type="image/x-icon" />
</head>

<body onLoad="setSize(); document.getElementById('name').focus()" onResize="setSize()" >
<a name="top"></a>
<div id="allover" style="width:100%;margin-left:auto;margin-right:auto;">
    <div id="such_erg" style="width:896px; display:none; background-color:#cccccc; position:absolute; top:160px; border:2px solid #ff6666; margin-left: auto; margin-right: auto;">
    </div>
    <div id="header" style="width:100%; clear:both; height:160px; position:static; background:url(bilder/BG-Header.png) repeat-x center top #b50f1b; margin-bottom: 3px;">
        <a href="./"><div class="logo">
                <span class="kontakt" title="Den Verantwortlichen f&uuml;r die Aktualisierung des Telefonbuchs erreichen Sie unter der Tel. 4667.">Kontakt und Pflege - Tel.: 4667</span></div></a>
               <div id="suche" style="width: 100%; padding: 115px 0px 0px; position: absolute; left: 0px; ">
				   	 <div class='Drucken'>
						<a href='./drucken.php?'>
							<img src='bilder/pdf-icon.png' width='30px' border='0'>
						</a>
					</div>		 
			  

<?php        
				// Abfrage für BereichI, BereichII, BereichIII und BereichIV
                $sort_Bereich_Verwaltung = "SELECT DISTINCT Abteilung FROM neue_telefonbuch1 where Bereich LIKE '%" .$Bereich_I. "%'";
				$sort_Bereich_Mediz_Zentrum_I = "SELECT DISTINCT Abteilung FROM neue_telefonbuch1 where Bereich LIKE '%" .$Bereich_II. "%'";
				$sort_Bereich_Psy_Zentrum_III = "SELECT DISTINCT Abteilung FROM neue_telefonbuch1 where Bereich LIKE '%" .$Bereich_IV. "%'";
				$sort_Bereich_III = "SELECT DISTINCT(Abteilung) FROM neue_telefonbuch1 where Bereich LIKE '%" .$Bereich_III. "%' ";
				
				// Führen Sie die oben genannten Abfragen
				$result_Bereich_Verwaltung       = mysql_query($sort_Bereich_Verwaltung);
				$result_Bereich_Mediz_Zentrum_I  = mysql_query($sort_Bereich_Mediz_Zentrum_I);
				$result_Bereich_III    = mysql_query($sort_Bereich_III);
				$result_Bereich_Psy_Zentrum_III  = mysql_query($sort_Bereich_Psy_Zentrum_III);
				
				// Sammeln Sie Ergebnisse BereichI in einem Array 
				while ( $row_Bereich_Verwaltung = mysql_fetch_array($result_Bereich_Verwaltung))
				{  				
				   foreach($row_Bereich_Verwaltung as $value)
				   {    
				      $value_Bereich_Verwaltung[$Bereich_num] = $value;
				   }
				   $Bereich_num = $Bereich_num+1;
				}
				$Bereich_num = 0;
				// Sammeln Sie Ergebnisse BereichII in einem Array 
				while ( $row_Bereich_Mediz_Zentrum_I = mysql_fetch_array($result_Bereich_Mediz_Zentrum_I))
				{  				
				   foreach($row_Bereich_Mediz_Zentrum_I as $value)
				   {    
				      $value_Bereich_Mediz_Zentrum_I[$Bereich_num] = $value;
				   }
				   $Bereich_num = $Bereich_num+1;
				}
				$Bereich_num = 0;
				// Sammeln Sie Ergebnisse BereichIII in einem Array 
				while ( $row_Bereich_III = mysql_fetch_array($result_Bereich_III))
				{  				
				   foreach($row_Bereich_III as $value)
				   {    
				      $value_Bereich_III[$Bereich_num] = $value;
				   }
				   $Bereich_num = $Bereich_num+1;
				}
				$Bereich_num = 0;		
				// Sammeln Sie Ergebnisse BereichIV in einem Array 
				while ( $row_Bereich_Psy_Zentrum_III = mysql_fetch_array($result_Bereich_Psy_Zentrum_III))
				{  				
				   foreach($row_Bereich_Psy_Zentrum_III as $value)
				   {    
				      $value_Bereich_Psy_Zentrum_III[$Bereich_num] = $value;
				   }
				   $Bereich_num = $Bereich_num+1;
				}
				
				
                echo "<div id = 'dropdown' style = 'text-align: center; margin-left: auto; margin-right: auto; width: 950px; padding-top: 20px;'>";
					 // Zeigen Sie die BerichI Ergebnisse auf HTML	
                     echo "<form name = 'dropdown' id = 'dropdown' action = '' style='display: inline; position: relative; ' >";			 
				     echo "<select name = 'Bereich_Verwaltung' class = 'select-bereich' onchange = 'ChangeId(this)'>";
					 echo "<option value = 'none' ; selected= '$Bereich_I'>$Bereich_I</option>";
                     for($j = 0; $j <= count($value_Bereich_Verwaltung) ; $j++)
				     {
                        if (strlen($value_Bereich_Verwaltung[$j]) > 0)					 
				           echo "<option value = '$value_Bereich_Verwaltung[$j]'> $value_Bereich_Verwaltung[$j]  </option>";	
					 }			
				     echo "</select>  ";
				     echo "</form>";

				echo "&nbsp;";
					// Zeigen Sie die BerichII Ergebnisse auf HTML
                     echo "<form name = 'dropdown1' id = 'dropdown1' action = ''   style='display: inline; position: relative; ' >";	
				     echo "<select name = 'Bereich_Mediz_Zentrum_I' class = 'select-bereich'  onchange = 'ChangeId(this)'>";
					 echo "<option value = 'none' ; selected= '$Bereich_II'>$Bereich_II</option>";				 
                     for($j = 0; $j <= count($value_Bereich_Mediz_Zentrum_I) ; $j++)
				     {
                        if (strlen($value_Bereich_Mediz_Zentrum_I[$j]) > 0)					 
				           echo "<option value = '$value_Bereich_Mediz_Zentrum_I[$j]'>$value_Bereich_Mediz_Zentrum_I[$j]</option>";
				     } 
				     echo "</select>  ";
			         echo "</form>";	

				echo "&nbsp;";				
					// Zeigen Sie die BerichIII Ergebnisse auf HTML
                     echo "<form name = 'dropdown2' id = 'dropdown2' action = ''   style='display: inline; position: relative;'>";	
				     echo "<select name = 'Bereich_Bereich_III' class = 'select-bereich'   onchange = 'ChangeId(this)'>";
					 echo "<option value = 'none' ; selected= '$Bereich_III'>$Bereich_III</option>";	
                     for($j = 0; $j <= count($value_Bereich_III) ; $j++)
				     {
                        if (strlen($value_Bereich_III[$j]) > 0)					 
				           echo "<option value = '$value_Bereich_III[$j]' >$value_Bereich_III[$j]</option>";
				     }
			         echo "</select>";
			         echo "</form>";		

				echo "&nbsp;";				
					// Zeigen Sie die BerichIV Ergebnisse auf HTML
                     echo "<form name = 'dropdown3' id = 'dropdown3' action = ''  style='display: inline; position: relative; '>";		
				     echo "<select name = 'Bereich_Psy_Zentrum_III' class = 'select-bereich'   onchange = 'ChangeId(this)'>";
					 echo "<option value = 'none' ; selected= '$Bereich_IV'>$Bereich_IV</option>";	 
                     for($j = 0; $j <= count($value_Bereich_Psy_Zentrum_III) ; $j++)
				     {
                        if (strlen($value_Bereich_Psy_Zentrum_III[$j]) > 0)					 
				           echo "<option value = '$value_Bereich_Psy_Zentrum_III[$j]' >$value_Bereich_Psy_Zentrum_III[$j]</option>";
				     }
			      	 echo "</select>";
				     echo "</form>";	
		
			    echo "</div>";
			
?>    			
               <br>
               <div class="TelefonSuche">
                   Telefonbuch durchsuchen<br>
				   <div class = "input_container">
					   <form name = "machine" action="index.php?" method="GET" style="">
							<input name="name" id="name" type="text" size="40" autocomplete="off" value="" style="">
							<input type="submit" class = "button" name = "submi5t" value="Suchen" style="">
							<div id = "dropdown_list" class="TelefonSucheBar"></div>
						</form> 
					 
				   </div>	  
               </div>	           
        </div>	
    </div>	
    <div id="content" style="overflow:auto;clear:both;width:950px;margin:0 auto;">

<?php
		//Funktion um die Suchergebnisse angezeigt werden
		function Resultat($result)
        {
		    echo "<table class='GrayTable'>";
		    if ((count($result) > 0 )) {
				echo "<tr>";
				// CSS zu Suchergebnis drucken
				echo "<th class='abteilung' colspan='4' style = 'text-align:center'>Suchergebnis</th>";
				echo "</tr>";                
					while ($row = mysql_fetch_array($result))
					{  
						if (($row[Abteilung]!="") && ($row[Abteilung2]==""))
						{
							$res_abteilung = $row[Abteilung];
							if(strlen($res_abteilung)>0) {
								if (strcmp($res_abteilung,$temp) != 0) {
									echo "<tr>";
									echo "<th colspan='4'><a href = '#$res_abteilung'><div class='abteilung'>$res_abteilung</div></a></th>";
									echo "</tr>";
									$temp = $res_abteilung;
								}	
								
							}	
							
							
							if(($row['list'])!= "") {
								echo "<tr class='bar'>";		
								// Drucken Kontakte in der Tabelle mit E-Mail-
								if (($row['mail'] == 1 )) {
									$email = trim($row['EMail'], " ");
									echo "<td class='zeileContent'><a class='rowEmail' title='{$email}' href = 'mailto:{$email}'><img src='bilder/email.gif' width='11px' border='0'></a>
									<a href = '#{$row['Temp_SNo']}'><div>{$row['Bezeichnung']}</div></a></td>";
									echo "<td class='zeileContent' hidden><a href = '#{$row['Temp_SNo']}'><div>{$row['Temp_SNo']}</div></a></td>";					
									echo "<td class='zeileContent'><a href = '#{$row['Temp_SNo']}'><div>{$row['Telefon']}</div></a></td>";
									echo "<td class='zeileContent noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['name']}</div></a></td>";
  
								}
								else {
									//Drucken Kontakte in der Tabelle mit keine Rohrpost
									if (!(strstr(($row['Bezeichnung']), "Rohrpost" ))){
										echo "<td class='zeileContent row2'><a href = '#{$row['Temp_SNo']}'><div>{$row['Bezeichnung']}</div></a></td>";
										echo "<td class='zeileContent' hidden><a href = '#{$row['Temp_SNo']}'><div>{$row['Temp_SNo']}</div></a></td>";									
										echo "<td class='zeileContent'><a href = '#{$row['Temp_SNo']}'><div>{$row['Telefon']}</div></a></td>";
										echo "<td class='zeileContent noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['name']}</div></a></td>";

									}else {
										//Drucken Kontakte in der Tabelle mit Rohrpost
										echo "<td class='zeileRohrpost row2'><a href = '#{$row['Temp_SNo']}'><div>{$row['Bezeichnung']}</div></a></td>";
										echo "<td class='zeileRohrpost' hidden><a href = '#{$row['Temp_SNo']}'><div>{$row['Temp_SNo']}</div></a></td>";
										echo "<td class='zeileRohrpost'><a href = '#{$row['Temp_SNo']}'><div>{$row['Telefon']}</div></a></td>";
										echo "<td class='zeileRohrpost noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['name']}</div></a></td>";
									}					   
								};	
							}	
						}else if (($row[Abteilung2]!=""))
						{
							$res_abteilung2 = $row[Abteilung2];
							if(strlen($res_abteilung2)>0) {
								if (strcmp($res_abteilung2,$temp2) != 0) {
									echo "<tr>";
									echo "<th colspan='4' align ='left'><a href = '#$res_abteilung2' ><div class = 'abteilung2'>$res_abteilung2</div></a></th>";
									echo "</tr>";
									$temp2 = $res_abteilung2;
								}	
								
							}	
							
							if(($row['list'])!= "") {
								echo "<tr class='bar'>";		
								// Drucken Kontakte in der Tabelle mit E-Mail-
								if (($row['mail'] == 1 )) {
									$email = trim($row['EMail'], " ");
									echo "<td class='zeileContent'><a class='rowEmail' title='{$email}' href = 'mailto:{$email}'><img src='bilder/email.gif' width='11px' border='0'></a>
									<a href = '#{$row['Temp_SNo']}'><div>{$row['Bezeichnung']}</div></a></td>";
									echo "<td class='zeileContent' hidden><a href = '#{$row['Temp_SNo']}'><div>{$row['Temp_SNo']}</div></a></td>";									
									echo "<td class='zeileContent'><a href = '#{$row['Temp_SNo']}'><div>{$row['Telefon']}</div></a></td>";
									echo "<td class='zeileContent noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['name']}</div></a></td>";
  
								}
								else {
									//Drucken Kontakte in der Tabelle mit keine Rohrpost
									if (!(strstr(($row['Bezeichnung']), "Rohrpost" ))){
										echo "<td class='zeileContent row2'><a href = '#{$row['Temp_SNo']}'><div>{$row['Bezeichnung']}</div></a></td>";
										echo "<td class='zeileContent' hidden><a href = '#{$row['Temp_SNo']}'><div>{$row['Temp_SNo']}</div></a></td>";									
										echo "<td class='zeileContent'><a href = '#{$row['Temp_SNo']}'><div>{$row['Telefon']}</div></a></td>";
										echo "<td class='zeileContent noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['name']}</div></a></td>";

									}else {
										//Drucken Kontakte in der Tabelle mit Rohrpost
										echo "<td class='zeileRohrpost row2'><a href = '#{$row['Temp_SNo']}'><div>{$row['Bezeichnung']}</div></a></td>";	
										echo "<td class='zeileRohrpost' hidden><a href = '#{$row['Temp_SNo']}'><div>{$row['Temp_SNo']}</div></a></td>";
										echo "<td class='zeileRohrpost'><a href = '#{$row['Temp_SNo']}'><div>{$row['Telefon']}</div></a></td>";
										echo "<td class='zeileRohrpost noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['name']}</div></a></td>";
									}					   
								};	
							}
						
						}
						echo "</tr>";
					}
            }		
				
		    echo "</table>";
			echo "<br>";
			echo "<br>";
    	}	 
		 
		 // Funktion, um Werte für BereichI, BereichII, BereichIII und BereichIV Anzeigen
		function gruppe_Bereich($abteilung_name)
		{

			echo "<table class='GrayTable'>";
			if(strlen($abteilung_name)>0) {
				// Abfrage für abteilung Namen im Bereich
				$search_Bereich = "SELECT CONCAT(Titel,' ',Vorname,' ',Nachname ) As name, Temp_SNo, CONCAT(`Bezeichnung`,`Telefon`,`Vorname`,`Nachname`)As list ,Bezeichnung , Telefon, EMail ,(EMail <> '')As mail ,Abteilung2 ,(Abteilung2 <> '')As ab2 FROM neue_telefonbuch1 WHERE Abteilung LIKE '%" . $abteilung_name . "%' ORDER BY Temp_SNo" ;
				$res_Bereich = mysql_query($search_Bereich);
				//Drucken abteilung Namen
				if ($abteilung_name != "EDV")
				{
					echo "<tr>";
					echo "<th colspan='4'><a href = '#$abteilung_name' ><div class = 'abteilung'>$abteilung_name</div></a></th>";
					echo "</tr>";
				}
				// wenn Bereich Name ist EDV-Display Anmeldeseite
				else if($abteilung_name == "EDV")	
				{ 
					echo "<tr>";
					echo "<th colspan='4' class='abteilung'>$abteilung_name<div class='EDVlogin'><a href='edit_telefon.php'>Login</a></div></th>";
					echo "</tr>";				
				}
			
				while ($row = mysql_fetch_array($res_Bereich))
				{ 
					if(($row['list'])!= "") {
						// Anzeige Kontakte nur für abteilung
						if ($row['ab2'] == 0) { 
							echo "<tr class='bar'>";
							if (($row['mail'] == 1 )) {
								// Drucken Kontakte in der Tabelle mit E-Mail
								$email = trim($row['EMail'], " ");
								echo "<td class='zeileContent'><a class='rowEmail' title='{$email}' href = 'mailto:{$email}'><img src='bilder/email.gif' width='11px' border='0'></a>
                               <a href = '#{$row['Temp_SNo']}'><div>{$row['Bezeichnung']}</div></a></td>";
								echo "<td class='zeileContent' hidden><a href = '#{$row['Temp_SNo']}'><div class = 'hidetemp'>{$row['Temp_SNo']}</div></a></td>";
								echo "<td class='zeileContent noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['Telefon']}</div></a></td>";
								echo "<td class='zeileContent noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['name']}</div></a></td>";
	   
							}else{
								//Drucken Kontakte in der Tabelle mit  keine Rohrpost
								if (!(strstr(($row['Bezeichnung']), "Rohrpost" )))
								{
									echo "<td class='zeileContent row2'><a href = '#{$row['Temp_SNo']}'><div>{$row['Bezeichnung']}</div></a></td>";
								echo "<td class='zeileContent' hidden><a href = '#{$row['Temp_SNo']}'><div class = 'hidetemp'>{$row['Temp_SNo']}</div></a></td>";
									echo "<td class='zeileContent noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['Telefon']}</div></a></td>";
									echo "<td class='zeileContent noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['name']}</div></a></td>";
	
								}else {
									//Drucken Kontakte in der Tabelle mit Rohrpost
									echo "<td class='zeileRohrpost row2'><a href = '#{$row['Temp_SNo']}'><div>{$row['Bezeichnung']}</div></a></td>";
								echo "<td class='zeileRohrpost' hidden><a href = '#{$row['Temp_SNo']}'><div class = 'hidetemp'>{$row['Temp_SNo']}</div></a></td>";
									echo "<td class='zeileRohrpost noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['Telefon']}</div></a></td>";
									echo "<td class='zeileRohrpost noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['name']}</div></a></td>";

								}					   
							}
							echo "</tr>";
						} else {
							// Anzeige Kontakte nur für abteilung
							// Drucken Sie das unter abteilung Namen
							$row['Abteilung2'] = rtrim($row['Abteilung2']);							
							if (strcmp ($row['Abteilung2'], $temp_str_ab2) != 0) {
								echo "<tr>";
								echo "<th align ='left' colspan = '4'><a href = '#{$row['Abteilung2']}' ><div class = 'abteilung2'>{$row['Abteilung2']}</div></a></th>";
								echo "</tr>";
								$temp_ab2 = 0;
							}
							$temp_str_ab2 = $row['Abteilung2'];
							echo "<tr class='bar'>";
							if (($row['mail'] == 1 )) {
								// Drucken Kontakte in der Tabelle mit E-Mail
								$email = trim($row['EMail'], " ");	
								echo "<td class='zeileContent'><a 		class='rowEmail' title='{$email}' href = 'mailto:{$email}'><img src='bilder/email.gif' width='11px' border='0'></a>
                               <a href = '#{$row['Temp_SNo']}'><div>{$row['Bezeichnung']}</div></a></td>";
								echo "<td class='zeileContent' hidden><a href = '#{$row['Temp_SNo']}'><div class = 'hidetemp'>{$row['Temp_SNo']}</div></a></td>";
								echo "<td class='zeileContent noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['Telefon']}</div></a></td>";
								echo "<td class='zeileContent noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['name']}</div></a></td>";
		
							}else{
								//Drucken Kontakte in der Tabelle mit keine Rohrpost
								if (!(strstr(($row['Bezeichnung']), "Rohrpost" )))
								{
									echo "<td class='zeileContent row2'><a href = '#{$row['Temp_SNo']}'><div>{$row['Bezeichnung']}</div></a></td>";
									echo "<td class='zeileContent' hidden><a href = '#{$row['Temp_SNo']}'><div class = 'hidetemp'>{$row['Temp_SNo']}</div></a></td>";
									echo "<td class='zeileContent noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['Telefon']}</div></a></td>";
									echo "<td class='zeileContent noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['name']}</div></a></td>";

								}
								//Drucken Kontakte in der Tabelle mit Rohrpost
								else {
									echo "<td class='zeileRohrpost row2'><a href = '#{$row['Temp_SNo']}'><div>{$row['Bezeichnung']}</div></a></td>";
									echo "<td class='zeileRohrpost' hidden><a href = '#{$row['Temp_SNo']}'><div class = 'hidetemp'>{$row['Temp_SNo']}</div></a></td>";
									echo "<td class='zeileRohrpost noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['Telefon']}</div></a></td>";
									echo "<td class='zeileRohrpost noWrap'><a href = '#{$row['Temp_SNo']}'><div>{$row['name']}</div></a></td>";
	
								}					   
							}
							echo "</tr>";						
						}
					}	
				}	
			}
			echo "</table>";  
			echo "<br>";
			echo "<br>";		
		}
		   
		   

		// Spalte für die Erholung der Säulen (Abteilung und Abteilung2).
        function gruppe($array_abt1)
		{  
			echo "<table width = '100%' style= 'border: medium solid rgb(235, 235, 235);'>";
			// Entfernen Sie leere Räume oder Werte haben 0
			$array_abt1 = array_filter(array_map('trim', $array_abt1));
			if(count($array_abt1) > 0)
			{
				// Drucken Sie das abteilung Namen
				for($i = 0; $i< count($array_abt1); $i++)
				{		
					$search_query1 = "SELECT CONCAT(Titel,' ',Vorname,' ',Nachname ) As name, Temp_SNo, CONCAT(`Bezeichnung`,`Telefon`,`Vorname`,`Nachname`)As list ,Bezeichnung , Telefon, EMail ,(EMail <> '')As mail, Abteilung2, (Abteilung2 <> '')As ab2 FROM neue_telefonbuch1 WHERE Abteilung LIKE '%" . $array_abt1[$i] . "%' AND Temp_SNo > 0  ORDER BY Temp_SNo " ;

					$res_abtilung1 = mysql_query($search_query1);

					if ($res_abtilung1 == FALSE)
						die(mysql_error());
					else {

				if ((strlen($array_abt1[$i])>0) ) {
				if ($array_abt1[$i] != "EDV")
				{
					echo "<tr>";
					echo "<th colspan='4' name  = '$array_abt1[$i]' id = '$array_abt1[$i]' ><div class = 'abteilung'>$array_abt1[$i]</div></th>";
					echo "</tr>";
				}
				// wenn Bereich Name ist EDV-Display Anmeldeseite
				else if($array_abt1[$i] == "EDV")	
				{ 
					echo "<tr>";
					echo "<th colspan='4' class='abteilung' name  = '$array_abt1[$i]' id = '$array_abt1[$i]'>$array_abt1[$i]<div class='EDVlogin'><a href='edit_telefon.php'>Login</a></div></th>";
					echo "</tr>";				
				}	
				 
							while ($row = mysql_fetch_array($res_abtilung1))
							{
								if(($row['list'])!= "") {
									if($row['ab2'] == 0) {
										echo "<tr class='bar2'>";
										// Drucken Kontakte in der Tabelle mit E-Mail
										if (($row['mail'] == 1 )) {
											$email = trim($row['EMail'], " ");									
											echo "<td class='zeileContent'><div class='rowEmail'><a title='{$email}' href = 'mailto:{$email}'><img src='bilder/email.gif' width='11px' border='0'></a></div>{$row['Bezeichnung']}</td>";
											echo "<td class='zeileContent' name='{$row['Temp_SNo']}' id='{$row['Temp_SNo']}' ><div class = 'hidetemp'>{$row['Temp_SNo']}</div></td>";
											echo "<td class='zeileContent noWrap'>{$row['Telefon']}</td>";
											echo "<td class='zeileContent noWrap'>{$row['name']}</td>";

										} else {
											//Drucken Kontakte in der Tabelle mit keine Rohrpost
											if (!(strstr(($row['Bezeichnung']), "Rohrpost" )))
											{
												echo "<td class='zeileContent row2'>{$row['Bezeichnung']}</td>";
												echo "<td class='zeileContent' name='{$row['Temp_SNo']}' id='{$row['Temp_SNo']}' ><div class = 'hidetemp'>{$row['Temp_SNo']}</div></td>";
												echo "<td class='zeileContent noWrap' >{$row['Telefon']}</td>";
												echo "<td class='zeileContent noWrap'>{$row['name']}</td>";

											}//Drucken Kontakte in der Tabelle mit Rohrpost
											else {
												echo "<td class='zeileRohrpost row2'>{$row['Bezeichnung']}</td>";
												echo "<td class='zeileRohrpost' name='{$row['Temp_SNo']}' id='{$row['Temp_SNo']}' ><div class = 'hidetemp'>{$row['Temp_SNo']}</div></td>";
												echo "<td class='zeileRohrpost noWrap' >{$row['Telefon']}</td>";
												echo "<td class='zeileRohrpost noWrap'>{$row['name']}</td>";
											}					   
										}
									}else {
										$row['Abteilung2'] = rtrim($row['Abteilung2']);	
										if (strcmp($row['Abteilung2'],$temp_str_ab2)!= 0){
											echo "<tr>";
											echo "<th class='abteilung2' align ='left' colspan = '4' name = '{$row['Abteilung2']}' id ='{$row['Abteilung2']}'>{$row['Abteilung2']}</th>";
											echo "</tr>";		
										} 
										$temp_str_ab2 = $row['Abteilung2'];
										echo "<tr class='bar2'>";
										// Drucken Kontakte in der Tabelle mit E-Mail
										if (($row['mail'] == 1 )) {
											$email = trim($row['EMail'], " ");
											echo "<td class='zeileContent'><a class='rowEmail' title='{$email}' href = 'mailto:{$email }'><img src='bilder/email.gif' width='11px' border='0'></a>{$row['Bezeichnung']}</td>";
											echo "<td class='zeileContent' name='{$row['Temp_SNo']}' id='{$row['Temp_SNo']}' ><div class = 'hidetemp'>{$row['Temp_SNo']}</div></td>";
											echo "<td class='zeileContent noWrap' >{$row['Telefon']}</td>";
											echo "<td class='zeileContent noWrap'>{$row['name']}</td>";

										} else{
											//Drucken Kontakte in der Tabelle mit keine 'Rohrpost'
											if (!(strstr(($row['Bezeichnung']), "Rohrpost" )))
											{
												echo "<td class='zeileContent row2'>{$row['Bezeichnung']}</td>";
												echo "<td class='zeileContent'  name='{$row['Temp_SNo']}' id='{$row['Temp_SNo']}'><div class = 'hidetemp'>{$row['Temp_SNo']}</div></td>";
												echo "<td class='zeileContent noWrap' >{$row['Telefon']}</td>";
												echo "<td class='zeileContent noWrap'>{$row['name']}</td>";

											} //Drucken Kontakte in der Tabelle mit 'Rohrpost'
											else {
												echo "<td class='zeileRohrpost row2'>{$row['Bezeichnung']}</td>";
												echo "<td class='zeileRohrpost' name='{$row['Temp_SNo']}' id='{$row['Temp_SNo']}'><div class = 'hidetemp'>{$row['Temp_SNo']}</div></td>";
												echo "<td class='zeileRohrpost noWrap'>{$row['Telefon']}</td>";
												echo "<td class='zeileRohrpost noWrap'>{$row['name']}</td>";

											}					   
										}
									}			
								}	
							}
						echo"</tr>";
					}					
                 }
			 }			 
		  }
        $grp_array = '';
		echo "</table>";		
		}
		   
		if(isset($_POST['Bereich_Verwaltung'])){
		  // Drucken Sie die BereichIV 		
		  gruppe_Bereich($_POST['Bereich_Verwaltung']);
	    }else if (isset($_POST['Bereich_Mediz_Zentrum_I'])){  
		  // Drucken Sie die BereichII		
		  gruppe_Bereich($_POST['Bereich_Mediz_Zentrum_I']);
        }else if (isset($_POST['Bereich_Bereich_III'])){  
		  // Drucken Sie die BereichIII		
		  gruppe_Bereich($_POST['Bereich_Bereich_III']);
        }else if (isset($_POST['Bereich_Psy_Zentrum_III'])){ 
		  // Drucken Sie die BereichIV 
		  gruppe_Bereich($_POST['Bereich_Psy_Zentrum_III']);
        }else if((!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬]/', $_GET['name'])) && ($_GET['name'] != " ") 
		          && ($_GET['name'] != '') && (!empty($_GET['name'])) ){
          // Drucken Sie die Suchergebnisse   
		  Resultat($result);
        }
		// Drucken Sie alle Kontakte
		gruppe($array_abteil);       
?>
         </table>

        <div id="check"></div>
    </div>
</div>
<div style="clear:both;"></div>
<script language="javascript" type="text/javascript">

</script>
</body>
</html>


