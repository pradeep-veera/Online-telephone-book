<?php
require('fpdf/fpdf.php');
                $servername = "localhost";
                $username = "telefonbuch";
                $DBpassword= "#telNbrs";

//Connect to database
$link = mysql_connect($servername,$username,$DBpassword)
        or die("Unable to connect to MySQL");

$selected = mysql_select_db("telefonbuch",$link)
       or die("Could not select examples");

	   $select_abteilung = "SELECT DISTINCT(Abteilung) FROM neue_telefonbuch1 ORDER BY Temp_SNo ";  
	   $result = mysql_query("SELECT CONCAT(Titel,' ',Vorname,' ',Nachname ) As name, Telefon, Abteilung FROM neue_telefonbuch1 ORDER BY Temp_Sno ");

		$pdf = new FPDF('P','mm',array(210,297));
		$pdf->AddPage();
		$pdf->SetTextColor(194,8,8);
		$pdf->SetFont('Arial','B',20);
		$pdf->Line(10,8,200,8);
		$pdf->Cell(165,10, "Telefonbuch" ,0,1,'R');	
		$pdf->SetFont('Arial','',14);	
		$pdf->Cell(190,10, "- PRO Klinik Holding GmbH" ,0,1,'R');	
		$pdf->Image("bilder/Logo1.jpg",10,9,33,20);
		$pdf->Line(10,31,200,31);				
		$pdf->Cell(10,20,"",0,0,"");
	   
		if($select_abteilung)
		   $res_abteilung   = mysql_query($select_abteilung);	   
		   	
		// sammeln die abteilung Namen zu Array 'array_abteil
		while ($temp = mysql_fetch_array($res_abteilung))
		{
			$i = $i + 1;	
		   $array_abteil[$i] = $temp[0]; 
		}	 
		
		if(count($array_abteil) > 0)
		{
			// Drucken Sie das abteilung Namen
			for($i = 0; $i< count($array_abteil); $i++)
			{
				$abt_trim = trim($array_abteil[$i], " ");
				$search_query1 = "SELECT CONCAT(Titel,' ',Vorname,' ',Nachname ) As name,Bezeichnung , Telefon, Abteilung2, (Abteilung2 <> '')As ab2 FROM neue_telefonbuch1 WHERE Abteilung LIKE '%" .$abt_trim. "%'   ORDER BY Temp_SNo " ;
				$res_abtilung1 = mysql_query($search_query1);			
				if ($res_abtilung1 == FALSE) {
					die(mysql_error());
				}	
				else
				{
					if ((strlen($abt_trim)>0) ) 
					{
					// Drucken Sie das abeteilung Namen
						$pdf->Ln();
						$pdf->SetTextColor(194,8,8);
						$pdf->SetFont('Arial','B',9);
						// print Abteilung Name
						$pdf->Cell(200,6, $abt_trim ,0,1,'C');		
						while ($row = mysql_fetch_array($res_abtilung1))
						{  
							$Bezeichnung = trim($row[Bezeichnung], " ");
							$Telefon = trim($row[Telefon], " ");
							$name = trim($row[name], " ");
							if($row['ab2'] == 0) {		// Check for abteilung2 
								// Print the contents if no abteilung2
								$pdf->SetFont('Arial','',7);
								$pdf->SetTextColor(0);
								if (strlen($Bezeichnung)>0 || strlen($Telefon)>0  || strlen($name)>0 ) {
									$pdf->Cell(90,6, $Bezeichnung ,1,0,'L');
									$pdf->Cell(50,6, $Telefon,1 ,0,'C');
									$pdf->Cell(50,6, $name ,1,0,'L');
								}
								$pdf->Ln();
							}
							else {
								$abt2_trim = trim($row[Abteilung2], " ");
								if (($abt2_trim != $temp_str_ab2)&&($abt2_trim != $abt_trim))
								{
									// New Abteilung 2 Name
									echo "\n";
									$pdf->Ln();
									$pdf->SetTextColor(194,8,8);
									$pdf->SetFont('Arial','B',9);
									$pdf->Cell(200,6, $abt2_trim,0 ,0,'C');	
									$pdf->Ln();
								}
								// Abteilung Name is already printed and proceed with printing the contents of Abteilung
								$temp_str_ab2 = $abt2_trim;
								$pdf->SetFont('Arial','',7);
								$pdf->SetTextColor(0);
								if (strlen($Bezeichnung)>0 || strlen($Telefon)>0  || strlen($name)>0 ) {
									$pdf->Cell(90,6, $Bezeichnung ,1,0,'L');
									$pdf->Cell(50,6, $Telefon,1 ,0,'C');
									$pdf->Cell(50,6, $name ,1,0,'L');
								}
								$pdf->Ln();				
							}	
						}
						$pdf->Ln();
					}						
                 }
			 }
		}
	$pdf->Line(10,290,200,290);		
$pdf->Output();
?>
	
			