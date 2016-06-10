<?php
		error_reporting(E_ALL);
		require ("sentinel_functions.php"); 
    require ("sentinel_visual_functions.php");
	    //a URL you want to retrieve
		header('Refresh: 60'); 
    	$url1 = 'http://192.168.0.3:61220';
    	$url2 = 'http://192.168.0.5:61220';
 		$rezultat1 = sentinel_data($url1);
 		$rezultat2 = sentinel_data($url2);
		$parametri = array("", "", "Uptime: ", "Time: ");	
    $kolone = array("Partition", "Name", "Temp", "Health");			
 		
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="sentineldata.css">
  </head>
<body>
  <table class= "header">
      	<?php 
          
          for ($i = 0; $i < count($parametri); $i++){
      		  echo '<th>' . $parametri[$i] . $rezultat1[0][$i] . '</th>';
          }
      	?>    	
  </table>
  <table class = "table">
    <tr>
      <?php 
        for ($i = 0; $i < count($kolone); $i++){
          echo '<th>' . $kolone[$i] . '</th>';
        }
      ?>
    </tr>
        
    <?php for ($i=0; $i < count($rezultat1[1]); $i++){
      echo '<tr><td>' . $rezultat1[1][$i][0] . '</td>';
      echo '<td>' . $rezultat1[1][$i][1] . '</td>';
      echo '<td id="temp" ';
      if ((tempstring_to_int($rezultat1[1][$i][2]) > 38) && (tempstring_to_int($rezultat1[1][$i][2]) < 43)) {
        echo 'class = "yellow" ';
      } elseif (tempstring_to_int($rezultat1[1][$i][2]) > 42) {
        echo 'class = "red" ';
      } else {
        echo 'class = "green" ';
      }

      echo '>' . substr($rezultat1[1][$i][2], 0, 5) . '</td>';
      echo '<td id="health" '; 
      if (healthstring_to_int($rezultat1[1][$i][3]) < 100) {
        echo 'class = "red" '; 
      } else {
        echo 'class = "green" ';
      }
        echo '>' . $rezultat1[1][$i][3] . '</td></tr>';
      } ?>

	</table>
	<table class = "header">
   	<?php 
      for ($i = 0; $i < count($parametri); $i++){
        echo '<th>' . $parametri[$i] . $rezultat2[0][$i] . '</th>';
      }
    ?>
  </table>
  <table class = "table">
    <tr>
      <?php 
        for ($i = 0; $i < count($kolone); $i++){
          echo '<th>' . $kolone[$i] . '</th>';
        }
      ?>
    </tr>
    <?php for ($i=0; $i < count($rezultat2[1]); $i++){
      echo '<tr><td>' . $rezultat2[1][$i][0] . '</td>';
      echo '<td>' . $rezultat2[1][$i][1] . '</td>';
      echo '<td id="temp" ';
      if ((tempstring_to_int($rezultat2[1][$i][2]) > 38) && (tempstring_to_int($rezultat2[1][$i][2]) < 43)) {
        echo 'class = "yellow" ';
      } elseif (tempstring_to_int($rezultat2[1][$i][2]) > 42) {
        echo 'class = "red" ';
      } else {
        echo 'class = "green" ';
      }
      echo '>' . $rezultat2[1][$i][2] . '</td>';
      echo '<td id="health" '; 
      if (healthstring_to_int($rezultat2[1][$i][3]) < 100) {
        echo 'class = "red" '; 
      } else {
        echo 'class = "green" ';
      }
        echo '>' . $rezultat2[1][$i][3] . '</td></tr>';
      } ?>
  </table>	
</body>
</html>
