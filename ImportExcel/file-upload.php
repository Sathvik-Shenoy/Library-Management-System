<?php
include 'database.php';

$uploadfile=$_FILES['uploadfile']['tmp_name'];

require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$objExcel=PHPExcel_IOFactory::load($uploadfile);
foreach($objExcel->getWorksheetIterator() as $worksheet)
{
	$highestrow=$worksheet->getHighestRow();

	for($row=0;$row<=$highestrow;$row++)
	{
		$usn=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
		$name=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
		$dob=$worksheet->getCellByColumnAndRow(2,$row)->getValue();
		$branch=$worksheet->getCellByColumnAndRow(3,$row)->getValue();
		$sem=$worksheet->getCellByColumnAndRow(4,$row)->getValue();
		$email=$worksheet->getCellByColumnAndRow(5,$row)->getValue();
		$phone=$worksheet->getCellByColumnAndRow(6,$row)->getValue();
		$lib_id=$worksheet->getCellByColumnAndRow(7,$row)->getValue();
		$type=$worksheet->getCellByColumnAndRow(8,$row)->getValue();
		$colid=$worksheet->getCellByColumnAndRow(9,$row)->getValue();
		$pass=$worksheet->getCellByColumnAndRow(10,$row)->getValue();
		if($usn!='')
		{
			$insertqry1="INSERT INTO `Library_card_index` VALUES ('$lib_id','$usn',NULL,'$pass')";
			$insertres=mysqli_query($con,$insertqry1);
			$insertqry2="INSERT INTO `Students` VALUES ('$usn','$name',NULL,'$branch','$sem','$email','$phone','$lib_id','$type')";
			$insertres=mysqli_query($con,$insertqry2);
		}
	}
}
header('Location: index.php');
?>
