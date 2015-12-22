<!DOCTYPE  html>
<html>
	<head>
		<title>Private Raspberry Internet Radio</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	</head>
    
   <?php
$stn=$_GET['station'];
exec("mpc play $stn");
$com=$_GET['command'];
exec("mpc $com");
$status = shell_exec('mpc'); // get mpc status
$newlinepos = strpos($status , "\n"); // find line break in status
$volumepos = strpos($status, "volume");


if ($volumepos == 0) {
   // echo "paused";
} else {
    $stnname = substr($status, 0, $newlinepos); // get station name
    //echo $stnname; // display station name
}
?>

	<body>
        <header>
			<h1>Internet Radio Maike 1.0</h1>
		</header>
        <p class="header-sep"></p>
        <div id="wrap">
      <?php
            $counter = 0;
            
            for ($counter = 1 ; $counter <= 4; $counter++){
                $activeClass = "box";
                if($counter==$stn){
                    $activeClass = "box aktive";
                }
                echo <<<END
                <div id="box" class="$activeClass"><a href="?station=$counter" class="stationlinks"> <div id="innerContent">
                <img  class="stationlinks" src="pics/sender-$counter.png" alt="sender$counter" vertical-align="button"> 
                </div></a></div>
END;
            }
        ?>
        </div>
        <footer>

        </footer>
    </body>
</html>

