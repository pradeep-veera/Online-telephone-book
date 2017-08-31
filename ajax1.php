<!--
* Frage an die VorschlÃ¤ge in das Suchfeld zu bekommen.
* Renditen Array der abgerufenen Suchergebnis zu "fÃ¼llen" Funktion.
-->

<?php
	$link=mysql_connect("localhost","telefonbuch","#telNbrs"); 
	mysql_select_db("telefonbuch",$link); 
	$droplist =  array();
	$list_num = array();
?>

<style>

ul {
   list-style: none;
   margin: 0px;
   padding: 0;
   background:white;
   font-size:11px;
   height: 18px
   text-align: left;
   color: black;
   width:270px;
}
.yeshover {background-color:#dcdcdc}
.nohover {border-bottom: none}
</style>
<link rel="stylesheet" href="styles.css" type="text/css">	
<script language="JavaScript" type="text/JavaScript">
function dateiMouseOver(element) {
    element.setAttribute('class', 'yeshover');
}
function dateiMouseOut(element) {
    element.setAttribute('class', 'nohover');
	
$(document).ready(function(){
	$( "#name" ).click(function() {
		$("from").submit();
	});
});	
</script>
<?php	

    //  Holen Sie sich das 'name' vom Suchfeld
	if(isset($_POST['name']))
	{
		$name=($_POST['name']);
		$name = str_replace(' ','',$name);
		// Abfrage für die Suche Bezeichnung 
       $sort_Bezeichnung  = "SELECT DISTINCT Bezeichnung, Temp_SNo FROM neue_telefonbuch1 where UPPER(Bezeichnung) LIKE UPPER('%" .$name. "%') ORDER BY Temp_SNo Limit 3";
		// Abfrage für die Suche telefon nummer
		$sort_Telefon = "SELECT DISTINCT Telefon, Temp_SNo FROM neue_telefonbuch1 where UPPER(Telefon) LIKE UPPER('%" .$name. "%') ORDER BY Temp_SNo Limit 3";
		// Abfrage für die Suche Namen
		$sort_name = "SELECT DISTINCT CONCAT(Titel,' ',Vorname,' ',Nachname ) As lame, Temp_SNo  FROM neue_telefonbuch1 where 
						UPPER(Vorname) LIKE UPPER('%" . $name . "%')OR
						UPPER(Nachname) LIKE UPPER('%" .$name. "%') OR
						UPPER(CONCAT_WS('',`Titel`,' ',`Vorname`,' ',`Nachname`))LIKE UPPER('%" . $name . "%')OR
						UPPER(CONCAT_WS('',`Titel`,' ',`Vorname`,' ',`Nachname`))LIKE UPPER('%" . $name . "%')OR
						UPPER(CONCAT_WS(Vorname,' ',Nachname))LIKE UPPER('%" . $name . "%')OR	
						UPPER(CONCAT_WS(Nachname,' ',Vorname))LIKE UPPER('%" . $name . "%') ORDER BY Temp_SNo Limit 3" ;
					
		   
		$droplist_Bezeichnung = mysql_query($sort_Bezeichnung);
		$droplist_Telefon= mysql_query($sort_Telefon);
		$droplist_name= mysql_query($sort_name);
	

echo "<ul>";

		while($Bezeichnung_row = mysql_fetch_array($droplist_Bezeichnung))
        {	
			if ($Bezeichnung_row['Bezeichnung']!= "") {
?>
					<li class = "bar" onclick='fill(<?php echo $Bezeichnung_row['Bezeichnung']; ?>,<?php echo $Bezeichnung_row['Temp_SNo'];?>)'>
					<a href = '#<?php echo $Bezeichnung_row['Temp_SNo']; ?>'><?php echo $Bezeichnung_row['Bezeichnung']; ?></a></li>
<?php				
            }
			
		} 	


		// machen Abfrageergebnis ('Telefon') auf ein Array.
        while($telefon_row = mysql_fetch_array($droplist_Telefon))
        {	
			if ($telefon_row['Telefon']!= "") {
?>
					<li class = "bar" onclick='fill('<?php echo $telefon_row['Telefon']; ?>','<?php echo $telefon_row['Temp_SNo'];?>)'>
					<a href = '#<?php echo $telefon_row['Temp_SNo']; ?>'><?php echo $telefon_row['Telefon']; ?></a></li>
<?php				
            }
			
		} 


		
		// machen Abfrageergebnis ('name') auf ein Array.
        while($name_row = mysql_fetch_array($droplist_name))
        {	
			if ($name_row['lame']!= "") {

?>
					<li class = "bar" onclick='fill(<?php echo $name_row['lame'];?>,<?php echo $name_row['Temp_SNo'];?>)'>
					<a href = '#<?php echo $name_row['Temp_SNo']; ?>'><?php echo $name_row['lame']; ?></a></li>
<?php			
				
            }
			
		}
	
		// Das Ergebnis in einem Array "$ Droplist 

echo "</ul>"; 	
}	
?>


