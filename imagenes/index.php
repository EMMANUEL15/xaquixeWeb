<?php
	$nombreVariable = 100;

	echo "<b>Hola</b>";
	echo "<table border = '1'>
		<th> pruaba
			<td>columna1</td>
			<td>columna2</td>
			<td>columna3</td>
		</th>
	</table>";
?>
<?php echo "hola <br> mundo" ?>

<?php 
	for($i=0; $i<10; $i++){
		echo $i;
	}
	echo "<br>";
	$j=0;
	while ( $j<=10) {
		echo $j;
		$j++;
	}
		echo "<br>";
		$data =[1,2,3,4,5,6];
	foreach ($data as $key) {
		echo "<br> el numero es".$key;
		if($key==5){
			echo " cinco";
		}
	}
	echo "<br>";
 ?>