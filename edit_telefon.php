<?php


                $result ='';
                $search_query ='';
				$grp_array  ='';
                $servername = "localhost";
                $username = "telefonbuch";
                $DBpassword= "#telNbrs";
				
				/* Query  */	
			
        $link = mysql_connect($servername,$username,$DBpassword)
            or die("Unable to connect to MySQL");

        $selected = mysql_select_db("telefonbuch",$link)
            or die("Could not select examples");


		function getBereich() {
			$Bereich_query = "SELECT DISTINCT Bereich FROM neue_telefonbuch1 ";
			$Bereich_result = mysql_query($Bereich_query);
			$num = 0;
			while($row_Bereich = mysql_fetch_array($Bereich_result))
			{
				foreach($row_Bereich as $value)
				{
					$value_Bereich[$num] = $value;
				}
				$num = $num+1;
			}
			$value_Bereich = array_filter(array_map('trim', $value_Bereich));
			return $value_Bereich;
		}	
		
		$Abteilung2_query = "SELECT DISTINCT Abteilung2 FROM neue_telefonbuch1  ORDER BY Abteilung2";
        $Abteilung2_result = mysql_query($Abteilung2_query);
		while($row_Abteilung2 = mysql_fetch_array($Abteilung2_result))
		{
			foreach($row_Abteilung2 as $value)
			{
				$value_Abteilung2[$num] = $value;
			}
			$num = $num+1;
		}
		$num = 0;
		
		$Abteilung_query = "SELECT DISTINCT Abteilung FROM neue_telefonbuch1  ORDER BY Abteilung";
        $Abteilung_result = mysql_query($Abteilung_query);
		while($row_Abteilung = mysql_fetch_array($Abteilung_result))
		{
			foreach($row_Abteilung as $value)
			{
				$value_Abteilung[$num] = $value;
			}
			$num = $num+1;
		}
		$num = 0;
		
		$telefon_query = "DESCRIBE neue_telefonbuch1  ";
		$telefon_result = mysql_query($telefon_query)	;	
		while($row_telefon = mysql_fetch_array($telefon_result))
		{
			$value_telefon[$num] = $row_telefon[0];
			$num = $num+1;
		}
		$num = 0;

		$I_query = "SELECT DISTINCT I FROM neue_telefonbuch1  ORDER BY I";
        $I_result = mysql_query($I_query);		
		while($row_I = mysql_fetch_array($I_result))
		{
			foreach($row_I as $value)
			{
				$value_I[$num] = $value;
			}
			$num = $num+1;
		}
		$num = 0;


	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de-de" lang="de-de">

<head>
<meta http-equiv="X-UA-Compatible" content="text/html; charset=iso-8859-1" />
<title>Telefonverzeichnis PRO Klinik Holding GmbH</title>

<script src="jquery.js"></script>
<script src="edit_telefon_jquery.js"></script>

<!-- Sort slelect -->

<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body style="background:#fff;margin:0;padding:0;font-family:arial, helvetica, sans-serif;fontsize:11px;" onLoad="setSize(); document.getElementById('name').focus()" onResize="setSize()" >
<a name="top"></a>
<div id="allover" style="width:100%;margin-left:auto;margin-right:auto;">
    <div id="such_erg" style="width:896px; display:none; background-color:#cccccc; position:absolute; top:160px; border:2px solid #ff6666; margin-left: auto; margin-right: auto;">
    </div>
    <div id="header" style="float:left; width:100%; clear:both; height:160px; position:static; background:url(bilder/BG-Header.png) repeat-x center top #b50f1b; margin-bottom: 3px;">
        <a href="./"><div class="logo">          
                <span class="kontakt" title="Den Verantwortlichen f&uuml;r die Aktualisierung des Telefonbuchs erreichen Sie unter der Tel. 4667.">Kontakt und Pflege - Tel.: 4667</span></div></a>
               <div id="suche" style="width:100%; padding:135px 0 0 0;  position: absolute; left: 0;">
<?php        

?>    
        </div>      
        <div id="such_erg_tmp" style="width:896px; display:none; background-color:#cccccc; position:relative; border:2px solid #ff6666;">
        </div>
    </div>
	<!-- Content divided to left and main content -->
	
    <div id="content" style="overflow: auto; clear: both; margin:auto ;">
	
<?php
		if(($_POST['fname'] == "kunow" && $_POST['pname'] == "*Ncc1701" ) || ($_POST['fname'] == "telefonbuch" && $_POST['pname'] == "#telNbrs" ) || ($_COOKIE["fname"] == "kunow")|| ($_COOKIE['fname'] == "telefonbuch"))
		{	
			setcookie("fname","kunow",time()+(1000),"/");
			setcookie("fname","telefonbuch",time()+(1000),"/");

				
?>		
		<div id = "content-left" style="float: left; width: 226px; padding: 10px 0px 10px 3%;">

			<ul class = "operation" style= "list-style-type:none">
				<li class = "level2">	
					<div id = "level11" class="menu"><a href='./edit_telefon.php?level2=neintrag'class = "menu" >Neue Eintrag</a></div>
				</li>	
				
				<li class = "level3" >	
					<div id = "level11" class="menu"><a href='./edit_telefon.php?level3=nperson' class = "menu" >Bearbeiten Person</a></div>
				</li>				
							
				<li class = "level6" >	
					<div id = "level11" class="menu"><a href='./edit_telefon.php?level6=nabt' class = "menu" >Neue Abteilung</a></div>
				</li>
				
				<li class = "level8" >	
					<div id = "level11" class="menu"><a href='./edit_telefon.php?level8=nfirma' class = "menu" >Neue Firma</a></div>
				</li>	
				
				<li class = "level9" >	
					<div id = "level11" class="menu"><a href='./edit_telefon.php?level9=nbereich' class = "menu" >Neue Bereich</a></div>
				</li>
				
				<li class = "level5" >	
					<div id = "level11" class="menu"><a href='./edit_telefon.php?level5=babt'class = "menu" >Bearbeiten Abteilung </a></div>
				</li>
				
				<li class = "level7" >	
					<div id = "level11" class="menu" ><a href='./edit_telefon.php?level7=bfirma'class = "menu" >Bearbeiten Firma</a></div>
				</li>
				
				<li class = "level10" >	
					<div id = "level11" class="menu"><a href='./edit_telefon.php?level10=bbereich' class = "menu" >Bearbeiten Bereich</a></div>
				</li>
				
				<li class = "level4" >	
					<div id = "level11" class="menu"><a href='./edit_telefon.php?level4=tsort' class = "menu" >Tabelle sortieren</a></div>
				</li>
				<li class = "level11" >	
					<div id = "level11" class="menu"><a href='./export_telefonbuch.php?' class = "menu" >Exportieren</a></div>
				</li>				
			</ul>	
		</div>
		<!-- Main Content -->
		<div id = "content-main" style="overflow: auto; display: block; padding: 1% 10%">
<?php	
			if($_GET['level6']){
?>			
				<form action = "./edit_telefon.php?" method = "POST" style = "text-align: center">
					<table width = "100%" style = "border: 1px solid ;border-color:#ebebeb;">
						<tr >
							<p class = "text" style = "text-align: center">Neue Eintrag</p>
						</tr>
						<tr style = "background:#ebebeb">
							<th class = "insert">Neue Abteilung</th>
							<td><input name ="neue_abt" id = "neue_abt" type = "text" size="70"></td>
						</tr>
						<tr>
							<th class = "insert">Neue Unterabteilung</th>
							<td><input name ="neue_abt2" id = "neue_abt2" type = "text" size="70"></td>
						</tr>
					</table>
					<br>
					<input type = "submit" value = "Speichern" style = "text-align:center ; cursor:pointer">
				</form>	
<?php		}

			if (($_POST['neue_abt'] != "") OR ($_POST['neue_abt2'] != ""))
			{
				$sel_tempno = mysql_query("SELECT Temp_SNo FROM neue_telefonbuch1  ORDER BY Temp_SNo DESC LIMIT 1 ");
				if(mysql_num_rows($sel_tempno) > 0) 
				{	
					$temp_id = mysql_fetch_row($sel_tempno);
				}
				$neue_temp = $temp_id[0]+1;
				$insert_abt = "INSERT INTO neue_telefonbuch1 (I,Bereich,Adresse,Abteilung2,Abteilung,Bezeichnung,Telefon,Mobil,Titel,Vorname,Nachname,Name,EMail,Text,Temp_SNo)
					VALUES('','','','$_POST[neue_abt2]','$_POST[neue_abt]','','','','','','','','','',$neue_temp)
				";
				$result_abt = mysql_query($insert_abt);
				if ($result_abt == TRUE)
					echo "<p class = 'text' style = 'text-align:center'>Abteilung eingefügt</p>";
			}
		
			if($_GET['level9']) {
?>				
				<form action = "./edit_telefon.php?" method = "POST" style = "text-align: center">
					<table width = "100%" style = "border: 1px solid ;border-color:#ebebeb;">
						<tr >
							<p class = "text" style = "text-align: center">Neue Eintrag</p>
						</tr>
						<tr style = "background:#ebebeb">
							<th class = "insert">Neue Bereich</th>
							<td><input name ="neue_berich" id = "neue_berich" type = "text" size="70"></td>
						</tr>
					</table>
					<br>
					<input type = "submit" value = "Speichern" style = "text-align:center ; cursor:pointer">
				</form>	
<?php		}

			if (($_POST['neue_berich'] != ""))
			{
				$sel_tempno = mysql_query("SELECT Temp_SNo FROM neue_telefonbuch1  ORDER BY Temp_SNo DESC LIMIT 1 ");
				if(mysql_num_rows($sel_tempno) > 0) 
				{	
					$temp_id = mysql_fetch_row($sel_tempno);
				}
				$neue_temp = $temp_id[0]+1;
				$insert_abt = "INSERT INTO neue_telefonbuch1 (I,Bereich,Adresse,Abteilung2,Abteilung,Bezeichnung,Telefon,Mobil,Titel,Vorname,Nachname,Name,EMail,Text,Temp_SNo)
					VALUES('','$_POST[neue_berich]','','','','','','','','','','','','',$neue_temp)
				";
				$result_abt = mysql_query($insert_abt);
				if ($result_abt == TRUE)
					echo "<p class = 'text' style = 'text-align:center'>Bereich eingefügt</p>";
			}
		
			if($_GET['level8']) {
?>				
				<form action = "./edit_telefon.php?" method = "POST" style = "text-align: center">
					<table width = "100%" style = "border: 1px solid ;border-color:#ebebeb;">
						<tr >
							<p class = "text" style = "text-align: center">Neue Eintrag</p>
						</tr>
						<tr style = "background:#ebebeb">
							<th class = "insert">Neue Firma</th>
							<td><input name ="neue_I" id = "neue_I" type = "text" size="70"></td>
						</tr>
					</table>
					<br>
					<input type = "submit" value = "Speichern" style = "text-align:center ; cursor:pointer">
				</form>	
<?php		}

			if ($_POST['neue_I'] != "")
			{
				$sel_tempno = mysql_query("SELECT Temp_SNo FROM neue_telefonbuch1  ORDER BY Temp_SNo DESC LIMIT 1 ");
				if(mysql_num_rows($sel_tempno) > 0) 
				{	
					$temp_id = mysql_fetch_row($sel_tempno);
				}
				$neue_temp = $temp_id[0]+1;
				$insert_I = "INSERT INTO neue_telefonbuch1 (I,Bereich,Adresse,Abteilung2,Abteilung,Bezeichnung,Telefon,Mobil,Titel,Vorname,Nachname,Name,EMail,Text,Temp_SNo)
					VALUES('$_POST[neue_I]','','','','','','','','','','','','','',$neue_temp)
				";
				$result_I = mysql_query($insert_I);
				if ($result_I == TRUE)
					echo "<p class = 'text' style = 'text-align:center'>Firma eingefügt</p>";
					
			}

		if($_GET['level2']) { 	
?>			<form action = "./edit_telefon.php?" method = "POST" style = "text-align: center">
				<p class = "text" style = "text-align:center">Legen Sie den Wert</p>
				<table width = "100%" style = "border: 1px solid ;border-color:#ebebeb;">
						<tr style = "background:#ebebeb">
							<th class = "insert">Sortieren</th>
							<td><input name="Temp_SNo" id="Temp_SNo" type="text" size="50" required></td>
						</tr>
						<tr >
							<th class = "insert">Firma</th>
							<td>
								<select name = "I" class = "dropdown">
									<option> </option>
<?php
									for($j = 0; $j <= count($value_I) ; $j++)
									{
										if (strlen($value_I[$j]) > 0)					 
										echo "<option value = '$value_I[$j]' > $value_I[$j]  </option>";	
									}
?>																		
								</select>
							</td>
						</tr>
						<tr style = "background:#ebebeb">						
							<th class = "insert">Bereich</th>
							<td>
								<select name = "Bereich" class = "dropdown">
								<option> </option>
<?php
									$value_Bereich = getBereich();
									for($j = 0; $j <= count($value_Bereich) ; $j++)
									{
										if (strlen($value_Bereich[$j]) > 0)					 
										echo "<option value = '$value_Bereich[$j]' > $value_Bereich[$j]  </option>";	
									}
?>									
								</select>
							</td>
						</tr>
						<tr >	
							<th class = "insert">Adresse</th>
							<td><input name="Adresse" id="Adresse" type="text" size="100"></td>
						</tr>
						<tr style = "background:#ebebeb">
							<th class = "insert">Abteilung</th>
							<td>
								<select id = "Abteilung" name = "Abteilung" class = "dropdown">
								<option> </option>
<?php
									$value_Abteilung = array_filter(array_map('trim', $value_Abteilung));
									for($j = 0; $j <= count($value_Abteilung) ; $j++)
									{
										if (strlen($value_Abteilung[$j]) > 0)					 
										echo "<option value = '$value_Abteilung[$j]' > $value_Abteilung[$j]  </option>";	
									}
?>							</select>
							</td>
						</tr>
						<tr >	
							<th class = "insert">Unterabteilung</th>
							<td>
								<select name = "Abteilung2" class = "dropdown">
								<option> </option>
<?php
									$value_Abteilung2 = array_filter(array_map('trim', $value_Abteilung2));
									for($j = 0; $j <= count($value_Abteilung2) ; $j++)
									{
										if (strlen($value_Abteilung2[$j]) > 0)					 
										echo "<option value = '$value_Abteilung2[$j]' > $value_Abteilung2[$j]  </option>";	
									}
?>									
								</select>
							</td>
						</tr>						
						<tr style = "background:#ebebeb">
							<th class = "insert">Bezeichnung</th>
							<td><input name="Bezeichnung" id="Bezeichnung" type="text" size="100"></td>
						</tr>
						<tr>
							<th class = "insert">Telefon</th>
							<td><input name="Tele" id="Tele "type="text" size="100" required ></td>
						</tr>
						<tr style = "background:#ebebeb">
							<th class = "insert">Mobil</th>
							<td><input name="Mobil" id="Mobil" type="text" size="100"></td>
						</tr>
						<tr >
							<th class = "insert">Titel</th>
							<td><input name="Titel" id="Titel" type="text" size="100"></td>
						</tr>
						<tr style = "background:#ebebeb">
							<th class = "insert">Vorname</th>
							<td><input name="Vorname" id="Vorname" type="text"size="100" ></td>
						</tr>
						<tr>
							<th class = "insert">Nachname</th>
							<td><input name="Nachname" id="Nachname" type="text" size="100"></td>
						</tr>
						<tr style = "background:#ebebeb">
							<th class = "insert">Name</th>
							<td><input name="name" id="name" type="text" size="100"></td>
						</tr>
						<tr>
							<th class = "insert">EMail</th>
							<td><input name="EMail" id="EMail" type="text" size="100"></td>
						</tr>
						<tr style = "background:#ebebeb">
							<th class = "insert">Zusätzliche Suchbegriffe </th>
							<td><input name="Text" id="Text" type="text" size="100"></td>
						</tr>
					</table>
					<br>
					<input type = "submit" value = "Speichern" style = "text-align:center ; cursor:pointer">
				</form>		
<?php
		}	
				// POST-Methode erhalten Sie die Werte und setzen Sie den Wert im folgenden Abfrage
			    if ($_POST['Temp_SNo']!= 0 ){
					$insert_query = "INSERT INTO neue_telefonbuch1 (I,Bereich,Adresse,Abteilung2,Abteilung,Bezeichnung,Telefon,Mobil,Titel,Vorname,Nachname,Name,EMail,Text,Temp_SNo)
					VALUES('$_POST[I]','$_POST[Bereich]','$_POST[Adresse]','$_POST[Abteilung2]','$_POST[Abteilung]','$_POST[Bezeichnung]','$_POST[Tele]','$_POST[Mobil]','$_POST[Titel]','$_POST[Vorname]','$_POST[Nachname]','$_POST[Name]','$_POST[EMail]','$_POST[Text]','$_POST[Temp_SNo]')
				";
					$insert_result = mysql_query($insert_query);
					// Update des Temp_SNo (Sort-Nummer), wenn neue Wert eingefügt
					if($insert_result == TRUE) {
						$tel = $_POST["Tele"];
						$copy_query = " UPDATE  neue_telefonbuch1  SET Temp_SNo = Temp_SNo +1 WHERE Temp_SNo >= '$_POST[Temp_SNo]'
						AND Telefon NOT LIKE '$tel'";
			
						$copy_result = mysql_query($copy_query);   
						if ($copy_result == FALSE)
							die(mysql_error());
						else {
							echo "<p class = 'text' style = 'text-align:center'>Wert eingefügt</p>";
						}	

					// Delete Temp_SNo = 0
						$drop_query =  "'DELETE SNo FROM `neue_telefonbuch1 ` WHERE `neue_telefonbuch1 `.`Temp_SNo` = 0";
						$drop_result =  mysql_query($drop_query);

					}
				}	
				
		

			if($_GET['level3']) {
?>				
				<p class = "text" style = "text-align : center">Suchen Sie den zu bearbeiten Eintrag</p>
				<form action = "./edit_telefon.php?" method = "POST" style = "text-align : center">
				<input name ="suche_werte" id = "suche_werte" type = "text" size="70">
				<br>
				<br>
				<input type = "submit" style = " cursor:pointer">			
				<br><br>
				</form>			
<?php		}
			

				if($_GET['level5']) {
?>				
			
				<p class = "text" style = "text-align : center">Abteilungsnamen bearbeiten</p>
				<form action = "./edit_telefon.php?" method = "POST" style = "text-align : center">	
				<select name = "ander_abt" class = "dropdown">
				<option> </option>
<?php
				for($j = 0; $j <= count($value_Abteilung) ; $j++)
				{
					if (strlen($value_Abteilung[$j]) > 0)					 
					echo "<option value = '$value_Abteilung[$j]' > $value_Abteilung[$j]  </option>";	
				}
?>									
				<select>
				<p class = "text">Oder</p>
				<p class = "text">Unterabteilungsnamen bearbeiten</p>
				<form action = "./edit_telefon.php?" method = "POST" style = "text-align : center">	
				<select name = "ander_abt2" class = "dropdown">
				<option> </option>
<?php
				for($j = 0; $j <= count($value_Abteilung2) ; $j++)
				{
					if (strlen($value_Abteilung2[$j]) > 0)					 
					echo "<option value = '$value_Abteilung2[$j]' >$value_Abteilung2[$j]</option>";	
				}
?>									
				<select>				
<!--				
				<input name ="suche_abteilung" id = "suche_abteilung" type = "text" size="100">
-->				
				<br>
				<br>
				<input type = "submit" style = " cursor:pointer">			
				<br><br>				
				</form>	
							
<?php				
			}	
			

			if($_GET['level7']) {
?>				
				<p class = "text" style = "text-align : center">Firmennamen bearbeiten</p>
				<form action = "./edit_telefon.php?" method = "POST" style = "text-align : center">	
			
				
				<select name = "ander_I" class = "dropdown">
				<option> </option>
<?php
				for($j = 0; $j <= count($value_I) ; $j++)
				{
					if (strlen($value_I[$j]) > 0)					 
					echo "<option value = '$value_I[$j]' > $value_I[$j]  </option>";	
				}
?>				</select>
				<br>
				<br>
				<input type = "submit" style = " cursor:pointer">			
				<br><br>				
				</form>		
<?php
			}
		
			if($_GET['level10']){
?>				
				<p class = "text" style = "text-align : center">Bereich bearbeiten</p>
				<form action = "./edit_telefon.php?" method = "POST" style = "text-align : center">	
				<select name = "ander_Bereich" class = "dropdown">
				<option> </option>
<?php
					$value_Bereich = getBereich();
					for($j = 0; $j <= count($value_Bereich) ; $j++)
					{
						if (strlen($value_Bereich[$j]) > 0)					 
						echo "<option value = '$value_Bereich[$j]' > $value_Bereich[$j]  </option>";	
					}
?>				</select>
				<br>
				<br>
				<input type = "submit" style = " cursor:pointer">			
				<br><br>				
				</form>		
<?php 
			}
			
			if($_GET['level4']) {
?>			
				<form action = "./index.php?" method = "GET" style = "text-align : center">
					<p class = "text" > Sortieren die Tabelle </p>	
					<select name = "telefon" class = "dropdown">
						<option> </option>
						<option name = "abteilung" id ="abteilung" >Abteilung</option>
						<option name = "aufs_Abteilung">Aufsteigend Abteilung</option>
						<option name = "abs_Abteilung">Absteigend Abteilung</option>
					</select>
					<br>
					<br>
					<input type = "submit" style = " cursor:pointer">
				</form>	
<?php 		} 

?>		
			<div class= "log-msg">
<?php	

			// Update query 		
			if ($_POST['Temp_SNo_Steuerwert']!="") 
			{
				$update_query = 
					"UPDATE neue_telefonbuch1 
					SET 
					Temp_SNo = '$_POST[SNo_Steuerwert]',
					I = '$_POST[I_Steuerwert]',
					Bereich = '$_POST[Bereich_Steuerwert]',
					Adresse = '$_POST[Adresse_Steuerwert]',
					Abteilung2 = '$_POST[Abteilung2_Steuerwert]',
					Abteilung = '$_POST[Abteilung_Steuerwert]',
					Bezeichnung = '$_POST[Bezeichnung_Steuerwert]',
					Telefon = '$_POST[Telefon_Steuerwert]',
					Mobil = '$_POST[Mobil_Steuerwert]',
					Titel = '$_POST[Titel_Steuerwert]',
					Vorname = '$_POST[Vorname_Steuerwert]',
					Nachname = '$_POST[Nachname_Steuerwert]',
					Name = '$_POST[Name_Steuerwert]',
					EMail = '$_POST[EMail_Steuerwert]',
					Text = '$_POST[Text_Steuerwert]'
					WHERE Temp_SNo = '$_POST[Temp_SNo_Steuerwert]'";
					
				mysql_query("BEGIN");
				if ($_POST['SNo_Steuerwert'] != $_POST['Temp_SNo_Steuerwert'] )
				{
					if ($_POST['Temp_SNo_Steuerwert'] > $_POST['SNo_Steuerwert'] )
					{
					//	echo "$_POST['Temp_SNo_Steuerwert'] > $_POST['SNo_Steuerwert']";
						$update_TempSno_query = (" UPDATE  neue_telefonbuch1  SET Temp_SNo = Temp_SNo +1 WHERE Temp_SNo >= '$_POST[SNo_Steuerwert]' AND Telefon NOT LIKE '$_POST[Telefon_Steuerwert]' AND Temp_SNo < '$_POST[Temp_SNo_Steuerwert]-1' ");

					}
					else {
					//	echo "$_POST['Temp_SNo_Steuerwert'] < $_POST['SNo_Steuerwert']";
						$update_TempSno_query =(" UPDATE  neue_telefonbuch1  SET Temp_SNo = Temp_SNo -1 WHERE Temp_SNo <= '$_POST[SNo_Steuerwert]' AND Telefon NOT LIKE '$_POST[Telefon_Steuerwert]'  AND Temp_SNo >= '$_POST[Temp_SNo_Steuerwert]'+1");

					}	
					$update_result = mysql_query($update_query);
					if ($update_result == FALSE){
						die(mysql_error());
						mysql_query("ROLLBACK");
					} else {
						$update_temp_result = mysql_query($update_TempSno_query);
						if (!$update_TempSno_query)
							die(mysql_error);
						else {
							mysql_query("COMMIT");	
?>					
						<p class = "text" style = "text-align:center">Zeile aktualisiert </p>
								
<?php								
						}
					}		
				}else {
					$update_result = mysql_query($update_query);
					if ($update_result == FALSE){
						die(mysql_error());
						mysql_query("ROLLBACK");
					} else {
						mysql_query("COMMIT");								
?>					
						<p class = "text" style = "text-align:center">Zeile aktualisiert</p>
								
<?php		
					}
					
				}

			}	
?>				
			</div>
			<div class = "edit_log">
<?php	        // suchen anfrage für bearbeiten die wert
				if($_POST["suche_werte"]!= ""){
					$suchwert = $_POST["suche_werte"];
					$suchan_frage = "SELECT Temp_SNo, CONCAT(Titel,' ',Vorname,' ',Nachname ) As name, I, Bereich , Bezeichnung , Telefon, EMail,(EMail <> '')As mail, Abteilung FROM neue_telefonbuch1  WHERE 
					UPPER(I) LIKE UPPER('%" . $suchwert . "%')OR 
					UPPER(Bereich) LIKE UPPER('%" . $suchwert . "%')OR 
					UPPER(Abteilung2) LIKE UPPER('%" . $suchwert . "%')OR 
					UPPER(Abteilung) LIKE UPPER('%" . $suchwert . "%')OR 
					UPPER(Bezeichnung) LIKE UPPER('%" . $suchwert . "%')OR 
					Telefon LIKE '%" . $suchwert . "%'OR 
					Mobil LIKE '%" . $suchwert . "%'OR 
					UPPER(Titel) LIKE UPPER('%" . $suchwert . "%')OR
					UPPER(Vorname) LIKE UPPER('%" . $suchwert . "%')OR
					UPPER(Nachname) LIKE UPPER('%" .$suchwert. "%') OR
					UPPER(CONCAT_WS(Titel,' ',Nachname,' ',Vorname))LIKE UPPER('%" . $suchwert . "%')OR
					UPPER(CONCAT_WS(Titel,' ',Vorname,' ',Nachname))LIKE UPPER('%" . $suchwert . "%')OR
					UPPER(CONCAT_WS(' ',Vorname,' ',Nachname))LIKE UPPER('%" . $suchwert . "%')OR	
					UPPER(CONCAT_WS(' ',Nachname,' ',Vorname))LIKE UPPER('%" . $suchwert . "%')
					ORDER BY Temp_SNo
					LIMIT 0, 100 " ;
								
					if ($suchwert != "")
					{
						$suchergebnis = mysql_query($suchan_frage);	
						if($suchergebnis == FALSE)
							die(mysql_error());
?>							
						<p class = "text" style = "text-align:center">  Suchergebnis </p>
						<table width = '100%' style = 'border: 1px solid ;border-color:#ebebeb;'>
							<tr style = "background:#ebebeb">
								<th>Sortieren</th>
								<th>Bezeichnung</th>		
								<th>Telefon</th>									
								<th>Name</th>
								<th>Löschen</th>
								<th>Bearbeiten</th>
							</tr>
<?php									
						while($suche_row = mysql_fetch_array($suchergebnis))
						{
?>						
							<tr >
								<td><? echo $suche_row['Temp_SNo'] ?></td>
								<td><? echo $suche_row['Bezeichnung'] ?></td>
								<td><? echo $suche_row['Telefon'] ?></td>
								<td><? echo $suche_row['name'] ?></td>
								<td><a href='./edit_telefon.php?loschen=<?echo $suche_row['Temp_SNo'];?>'>löschen</td>
								<td><a href='./edit_telefon.php?modify=<?echo $suche_row['Temp_SNo'];?>'>Bearbeiten</td>
											
							</tr>
<?php								
						}
						echo "</table>";
					}
				}

				
				if($_POST['ander_I']!= "") 
				{
					$suchI = $_POST["ander_I"];
					$query_I = mysql_query("SELECT I FROM neue_telefonbuch1  WHERE I LIKE '$suchI' ");
				
                    if (mysql_num_rows($query_I) > 0)
					{		
						$sel_I = mysql_fetch_row($query_I);
					}
?>		
					<form action = "./edit_telefon.php?" method = "POST" style = "text-align : center">
						<table width = '100%' style = 'border: 1px solid ;border-color:#ebebeb;'>
							<tr>
								<p class = "text">Bearbeiten</p>
							</tr>
							<tr  style = "background:#ebebeb">	
								<th class = "insert"><?php echo $sel_I[0] ?></th>
								<td><input name = "modify_I" id = "modify_I" size="100" value = "<? echo $sel_I[0] ?>" ></td>
								<td><input name = "modify_I_hidden" id = "modify_I_hidden" size="100" value = "<? echo $sel_I[0] ?>" hidden ></td>
							</tr>
						</table>
						</br>
						<input type = "submit" value = "Speichern" style = "text-align:center ; cursor:pointer">	
					</form>						
<?php						
				}

				if ($_POST["modify_I"]!= "")	
				{
					$modifyI_query = "update neue_telefonbuch1  set I = '$_POST[modify_I]' WHERE I LIKE '$_POST[modify_I_hidden]'";
					$modifyI_result = mysql_query($modifyI_query);
					if ($modifyI_result == TRUE){
						echo "<p class = 'text' style = 'text-align:center'>Firma aktualisiert</p>";
					}	
					else 
						die(mysql_errno());
				}					

				if($_POST['ander_Bereich']!= "") 
				{
					$suchBereich = $_POST["ander_Bereich"];
					$query_Bereich = mysql_query("SELECT Bereich FROM neue_telefonbuch1  WHERE Bereich LIKE '$suchBereich' ");
                    if (mysql_num_rows($query_Bereich) > 0)
					{		
						$sel_Bereich = mysql_fetch_row($query_Bereich);
					}
?>		
					<form action = "./edit_telefon.php?" method = "POST" style = "text-align : center">
						<table width = '100%' style = 'border: 1px solid ;border-color:#ebebeb;'>
							<tr>
								<p class = "text">Bearbeiten</p>
							</tr>
							<tr  style = "background:#ebebeb">	
								<th class = "insert"><?php echo $sel_Bereich[0] ?></th>
								<td><input name = "modify_Bereich" id = "modify_Bereich" size="100" value = "<? echo $sel_Bereich[0] ?>" ></td>
								<td><input name = "modify_bereich_hidden" id = "modify_bereich_hidden" size="100" value = "<? echo $sel_Bereich[0] ?>" hidden ></td>
							</tr>
						</table>
						</br>
						<input type = "submit" value = "Speichern" style = "text-align:center ; cursor:pointer">	
					</form>						
<?php						
				}
		
				if ($_POST["modify_Bereich"]!= "")	
				{
					$modifyBereich_query = "update neue_telefonbuch1  set Bereich = '$_POST[modify_Bereich]' WHERE Bereich LIKE '$_POST[modify_bereich_hidden]'";
					$modifyBereich_result = mysql_query($modifyBereich_query);
					if ($modifyBereich_result == TRUE) {
						$check_abt1 = mysql_query("SELECT * FROM neue_telefonbuch1  WHERE Bereich LIKE '$_POST[modify_Bereich]'");
						if($check_abt1 == TRUE)	
							echo "<p class = 'text' style = 'text-align:center' >Bereich aktualisiert</p>";
							//echo "<script>setTimeout(function(){ location.reload(); }, 3000)</script>";
					}	
					else 
						die(mysql_errno());
				}			
				
				if($_POST['ander_abt']!= "") 
				{
					$suchabt = $_POST["ander_abt"];
					$sel = mysql_query("SELECT Abteilung FROM neue_telefonbuch1  WHERE Abteilung LIKE '$suchabt' ");
					
                    if (mysql_num_rows($sel) > 0)
					{		
						$sel_abt = mysql_fetch_row($sel);
					}

?>		
					<form action = "./edit_telefon.php?" method = "POST" style = "text-align : center">
						<table width = '100%' style = 'border: 1px solid ;border-color:#ebebeb;'>
							<tr>
								<p class = "text">Bearbeiten</p>
							</tr>
							<tr  style = "background:#ebebeb">	

								<th class = "insert"><?php echo $sel_abt[0] ?></th>
								<td><input name = "modify_abt1" id = "modify_abt1" size="70" value = "<? echo $sel_abt[0] ?>" ></td>
								<td><input name = "modify_abt1_hidden" id = "modify_abt1_hidden" size="100" value = "<? echo $sel_abt[0] ?>" hidden ></td>
							</tr>
						</table>
						</br>
						<input type = "submit" value = "Speichern" style = "text-align:center ; cursor:pointer">	
					</form>						
<?php						
				}

				if($_POST['ander_abt2']!= "") 
				{
					$suchabt2 = $_POST["ander_abt2"];
					$sel2 = mysql_query("SELECT Abteilung2 FROM neue_telefonbuch1  WHERE Abteilung2 LIKE '$suchabt2' ");
                    if (mysql_num_rows($sel2) > 0)
					{		
						$sel_abt2 = mysql_fetch_row($sel2);
					} 
?>		
					<form action = "./edit_telefon.php?" method = "POST" style = "text-align : center">
						<table width = '100%' style = 'border: 1px solid ;border-color:#ebebeb;'>
							<tr>
								<p class = "text">Bearbeiten</p>
							</tr>
							<tr  style = "background:#ebebeb">	
								<th class = "insert"><?php echo $sel_abt2[0] ?></th>
								<td><input name = "modify_abt2" id = "modify_abt2" size="70" value = "<? echo $sel_abt2[0] ?>" ></td>
								<td><input name = "modify_abt1_hidden2" id = "modify_abt2_hidden2" size = "100" value = "<? echo $sel_abt2[0] ?>" hidden ></td>
							</tr>
						</table>
						</br>
						<input type = "submit" value = "Speichern" style = "text-align:center ; cursor:pointer">	
					</form>						
<?php						
				}
?>

<?php				
				if ($_POST["modify_abt1"]!= "")	
				{
					$modifyabt_query = "update neue_telefonbuch1  set Abteilung = '$_POST[modify_abt1]' WHERE Abteilung LIKE '$_POST[modify_abt1_hidden]'";

					$modifyabt_result = mysql_query($modifyabt_query);
					if ($modifyabt_result == TRUE)
						echo "<p class = 'text' style = 'text-align:center'>Abteilung aktualisiert</p>";						
					else 
						die(mysql_errno());
				}	
?>						

<?php				
				if ($_POST["modify_abt2"]!= "")	
				{
					$modifyabt2_query = "update neue_telefonbuch1  set Abteilung2 = '$_POST[modify_abt2]' WHERE Abteilung2 LIKE '$_POST[modify_abt1_hidden2]'";
					$modifyabt2_result = mysql_query($modifyabt2_query);
					if ($modifyabt2_result == TRUE)
						echo "<p class = 'text' style = 'text-align:center'>Unterabteilung aktualisiert</p>";
					else 
						die(mysql_errno());
				}	
?>											

<?php					
				if($_GET['loschen']) {
					$lochen_id = $_GET['loschen'];
					$lochen_query = "DELETE FROM neue_telefonbuch1  WHERE Temp_SNo='$lochen_id'";
					$lochen_result = mysql_query($lochen_query);
					if ($lochen_result == FALSE)
						die(mysql_error());
					else {	
							
						if ($lochen_id)
					    $lochen_update = "Update neue_telefonbuch1  set Temp_SNo = Temp_SNo -1 WHERE Temp_SNo > $lochen_id ";
						$lochen_res= mysql_query($lochen_update);
						if ($lochen_res)
							echo "<p class = 'text' style = 'text-align:center'>Zeile gelöscht</p>";
					}
				}else if ($_GET['modify']) {
					$modify_id = $_GET['modify'];
					$modify_query = "SELECT * FROM neue_telefonbuch1  WHERE Temp_SNo = $modify_id";
					$modify_result = mysql_query($modify_query);
					if ($modify_result == FALSE)
						die(mysql_error());
					else{
?>					<form action = './edit_telefon.php?' method = "POST" style = "text-align:center">	
						<table width = '100%' style = 'border: 1px solid ;border-color:#ebebeb;'>
							<tr>
<?php
							// Änderung kann für Sortiernummer nicht getan werden
							while($row = mysql_fetch_array($modify_result))
							{
								$update_telefon = $row[Telefon];
?>								
								<tr style = "background:#ebebeb">
									<th class = "insert">Sortieren</th>
									<td><input name = "SNo_Steuerwert" id = "SNo_Steuerwert" size = "50" value = "<? echo $row['Temp_SNo']?>"  >
									<input type = "hidden" name = "Temp_SNo_Steuerwert" id = "Temp_SNo_Steuerwert" size = "50" value = "<? echo $row['Temp_SNo']?>"></td>
								</tr>
								<tr >
								<th class = "insert">Firma</th>
									
									<td>
										<select name = "I_Steuerwert" class = "dropdown">
										<option><? echo $row['I']?></option>
										<option></option>
<?php
									for($j = 0; $j <= count($value_I) ; $j++)
									{
										if (strlen($value_I[$j]) > 0)					 
										echo "<option value = '$value_I[$j]' >$value_I[$j]</option>";	
									}
?>									
								</select>
									</td>
								</tr>
							
								<tr style = "background:#ebebeb">	
								<th class = "insert">Bereich</th>

									<td>
										<select name = "Bereich_Steuerwert" class = "dropdown">
										<option><? echo $row['Bereich']?></option>
										<option></option>
<?php
									$value_Bereich = getBereich();
									for($j = 0; $j <= count($value_Bereich) ; $j++)
									{
										if (strlen($value_Bereich[$j]) > 0)					 
										echo "<option value = '$value_Bereich[$j]' >$value_Bereich[$j]</option>";	
									}
?>									
										</select>
										
									</td>
								</tr>	
								<tr>
								<th class = "insert">Adresse</th>

									<td><input name="Adresse_Steuerwert" id="Adresse_Steuerwert" type="text" size="100" value ="<? echo $row['Adresse']?>"> </td>
								</tr>	
								
								<tr style = "background:#ebebeb">
								<th class = "insert">Abteilung</th>

									<td>
										<select name = "Abteilung_Steuerwert" class = "dropdown">
										<option><? echo $row['Abteilung']?></option>
										<option></option>
<?php
									$value_Abteilung = array_filter(array_map('trim', $value_Abteilung));
									for($j = 0; $j <= count($value_Abteilung) ; $j++)
									{
										if (strlen($value_Abteilung[$j]) > 0)					 
										echo "<option value = '$value_Abteilung[$j]' >$value_Abteilung[$j]</option>";	
									}
?>									
										</select>
									</td>
								</tr>
								<tr >
								<th class = "insert">Unterabteilung</th>
							
									<td>
										<select name = "Abteilung2_Steuerwert" class = "dropdown">
										<option><? echo $row['Abteilung2']?></option>
										<option></option>
<?php
									$value_Abteilung2 = array_filter(array_map('trim', $value_Abteilung2));
									for($j = 0; $j <= count($value_Abteilung2) ; $j++)
									{
										if (strlen($value_Abteilung2[$j]) > 0)					 
										echo "<option value = '$value_Abteilung2[$j]' >$value_Abteilung2[$j]</option>";	
									}
?>									
										</select>
									</td>
								</tr>									
								<tr style = "background:#ebebeb">
								<th class = "insert">Bezeichnung</th>

									<td><input name="Bezeichnung_Steuerwert" id="Bezeichnung_Steuerwert" type="text" size="100" value ="<? echo $row['Bezeichnung']?>"></td> 
								</tr>
								<tr>
								<th class = "insert">Telefon</th>
									<td><input name = "Telefon_Steuerwert" id = "Telefon_Steuerwert" size="100" value = "<? echo $row['Telefon']?>"> </td>
								</tr>
								<tr style = "background:#ebebeb">							
								<th class = "insert">Mobil</th>
									<td><input name="Mobil_Steuerwert" id="Mobil_Steuerwert" type="text" size="100" value ="<? echo $row['Mobil']?>"></td>
								</tr>
								<tr>									
								<th class = "insert">Titel</th>
									<td><input name="Titel_Steuerwert" id="Titel_Steuerwert" type="text" size="100" value ="<? echo $row['Titel']?>"></td>
								</tr>
								<tr style = "background:#ebebeb">									
								<th class = "insert">Vorname</th>
									<td><input name = "Vorname_Steuerwert" size="100" type = "text" value = "<?echo $row['Vorname']?>" ></td>
								</tr>
								<tr>									
								<th class = "insert">Nachname</th>
									<td><input name = "Nachname_Steuerwert" size="100" type = "text" value = "<? echo $row['Nachname']?>" ></td>
								</tr>
								<tr style = "background:#ebebeb">
								<th class = "insert">Name</th>

									<td><input name="Name_Steuerwert" id="Name_Steuerwert" type="text" size="100" value ="<? echo $row['Name']?>"></td>
								</tr>
								<tr>
								<th class = "insert">EMail</th>
								
									<td><input name="EMail_Steuerwert" id="EMail_Steuerwert" type="text" size="100" value ="<? echo $row['EMail']?>"></td>
								</tr>
								<tr style = "background:#ebebeb">
								<th class = "insert">Zusätzliche Suchbegriffe</th>

									<td><input name="Text_Steuerwert" id="Text_Steuerwert" type="text" size="100" value ="<? echo $row['Text']?>"></td>
								</tr>	
<?php
							}
						echo "</tr>";
					echo "</table>";
					echo "<p><input type = 'submit' value = 'Speichern' style = 'text-align:center ; cursor: pointer'></p>";
					echo "</form>";
					}
				}					
?>					
			</div>
		</div>	
<?php
	} else {
		
?>	
	<div id = "content-login" style="width: 500px; overflow: auto; display: block; padding: 25px 150px;">
	
			<form name = "userlogin" method="post" action="./edit_telefon.php?"  style = "text-align:center; padding-left: 90px" >
				<table border="1" style = "text-align:center;"  >
					<tr style = "background : #ebebeb">
						<td><label class = "text">Benutzername</label></td>
						<td><input name = "fname" type="text" required  size = "30"></td>
					</tr>
					<tr>
						<td><label class = "text">Kennwort</label></td>
						<td><input name="pname" type="password" required  size = "30" ></input></td>
					</tr>
					<tr style = "background : #ebebeb">
						<td><input type="submit" value="Anmelden" />
						<td><input name = "reset" type="reset" value="Reset" />
					</tr>
				</table>
			</form>
	</div>
<?php	
	}
?>		
	</div>	
</div>
<div id="check"></div>
<div style="clear:both;"></div>
<script language="javascript" type="text/javascript">

</script>
</body>
</html>