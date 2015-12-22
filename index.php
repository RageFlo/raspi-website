<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN">
<html xmlns>
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<title>Siggi's Internetradio</title>

<?php

// added this function to replace em dashes in last.fm tracklistings
function convert_dash($string)
{
	$string = preg_replace( '/[^[:print:]][^[:print:]][^[:print:]]/', '-',$string);
	return $string;
}


function lastfm($lastfmuser)
{
    
    require_once('/usr/share/nginx/www/php/autoloader.php');
 
    // We'll process this feed with all of the default options.
    $feed = new SimplePie();
 
    // Set which feed to process.
    $feedurl = "http://ws.audioscrobbler.com/2.0/user/$lastfmuser/recenttracks.rss?limit=3";
    
    //added to ensure it gets fresh copy
    $feed->set_cache_duration(120);
    
    $feed->set_feed_url($feedurl);
 
    // Run SimplePie.
    $feed->init();
 
    // This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
    $feed->handle_content_type();

	echo "<hr><div class=\"tracklistheader\">";
    echo "<a href=\"";
    echo $feed->get_permalink();
    echo "\">";
    echo $feed->get_title();
    echo "</a>";
	echo "</div>";
	 
	/*
	Here, we'll loop through all of the items in the feed, and $item represents the current item in the loop.
	*/
	foreach ($feed->get_items() as $item):
 
		echo "<div class=\"tracklistsong\">";
		echo "<a href=\"";
		echo $item->get_permalink();
		echo "\">";
		echo convert_dash($item->get_title());
		echo "</a></div>";
		echo "<div class=\"tracklistdate\">";
		echo $item->get_date('j F Y | g:i a');
		echo "</div>";
 
	endforeach; 
 
}

?>


<style type="text/css">


a:link {
    text-decoration: none;
}

a:visited {
    text-decoration: none;
}

a:hover {
    text-decoration: none;
}

a:active {
    text-decoration: none;
}

  body {
    color: #000000;
    background-color: #FFFFFF;
    font-family: AvenirNextCondensed-DemiBold, Helvetica, sans-serif;
/*    font-family: HelveticaNeue-CondensedBlack, Helvetica, sans-serif; */
       }

  .logo {
    font-family: AvenirNextCondensed-Bold, Helvetica, sans-serif;
    color: #FFFFFF;
    background-color: #7EA76B;
    -webkit-text-size-adjust: 150%;   
    -moz-border-radius: 7px;
 	border-radius: 7px;
    padding:2px;
     }

  .station {
    font-family: AvenirNextCondensed-Bold, Helvetica, sans-serif;
    color: #000000;
    -webkit-text-size-adjust: 200%;   

     }

  .volume {
    color: #AAAAFF;
     }

   a.stationlinks:link {
    color: #000000;
    font-family: AvenirNextCondensed-Bold, Helvetica, sans-serif;
}

   a.stationlinks:visited {
    color: #000000;
}

   a.stationlinks:active {
    background-color: #FF0000;
}

   a.stationlinks:hover {
    background-color: #FF0000;
}


  .stationlinks {
    -moz-border-radius: 5px;
 	border-radius: 5px;
    padding:5px;
    background: #A8E099;
    font-family: AvenirNextCondensed-Bold, Helvetica, sans-serif;
}

img.stationslinks  {
    width: 2em;
    max-width: 200px;
    visibility: hidden;
}
    

   a.volcontrol:link {
    color: #000000;
}

   a.volcontrol:visited {
    color: #000000;
}

   a.volcontrol:active {
    background-color: #FF0000;
}

   a.volcontrol:hover {
    background-color: #FF0000;
}


  .volcontrol {
    font-family: AvenirNextCondensed-Bold, Helvetica, sans-serif;
    background: #C6DEEA;
    -moz-border-radius: 5px;
 	border-radius: 5px;
    padding:0px;

   }

  .commands {
    background: #FFFF00;
    -moz-border-radius: 5px;
 	border-radius: 5px;
    padding:0px;
    }
    
  .tracklistheader {
    font-family: AvenirNextCondensed-Bold, Helvetica, sans-serif;

   }

  .tracklistsong {
   }
   
   .tracklistdate {
    -webkit-text-size-adjust: 75%;   
      }
   
  .footer {
    font-family: AvenirNextCondensed-UltraLight, Helvetica, sans-serif;
    -webkit-text-size-adjust: 75%;
    background: #FFFFFF;
    }

</style>

</head>

<body>

<span class="logo">MaikePi</span><br/><span class="station">
<?php
$stn=$_GET['station'];
exec("mpc play $stn");
$com=$_GET['command'];
exec("mpc $com");
$status = shell_exec('mpc'); // get mpc status
$newlinepos = strpos($status , "\n"); // find line break in status
$volumepos = strpos($status, "volume");


if ($volumepos == 0) {
    echo "paused";
} else {
    $stnname = substr($status, 0, $newlinepos); // get station name
    echo $stnname; // display station name
}
echo "</span>";
?>

</span>
<br/>
<span class="stationlinks">
<a href="?station=1" class="stationlinks"><img  class="stationlinks" src="1live.jpg" width=200em ></a>  
<a href="?station=2" class="stationlinks"><img  class="stationlinks" src="swr3.png" width=200em></a>   
<a href="?station=3" class="stationlinks"><img  class="stationlinks" src="bigfm.png" width=200em></a>  
<a href="?station=4" class="stationlinks"><img  class="stationlinks"src="rpr1.png" width=200em></a> 
<br/>
<a href="?command=volume -3" class="volcontrol">< volume down</a>&nbsp;&nbsp;
<a href="?command=volume 90" class="volcontrol">normal</a>&nbsp;&nbsp;
<a href="?command=volume %2B3" class="volcontrol">volume up ></a>&nbsp;&nbsp; 
</span>
<span class=volume>
<?php
echo substr($status, $volumepos+7, 4); // display current volume
?>
</span>

<br/>

<a href="?command=stop" class="commands">&#x1F507pause</a>  
<a href="?command=play" class="commands">&#x25B6;play</a> 
<a href="?command=record" class="commands">&#x1F534;record</a> 
<a href="." class="commands">refresh</a>

<br/>


<?php

// if station is fip, embed their track now playing tweet
if (strpos($stnname, 'Fip') !== false OR strpos($stnname, 'fip') !== false) {
     echo "<a class=\"twitter-timeline\" data-dnt=\"true\" href=\"https://twitter.com/FipNowPlays\" data-tweet-limit=\"3\" data-widget-id=\"500685229732794369\">Tweets by @FipNowPlays</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\"://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>";
}

if (strpos($stnname, 'Radio 1') !== false) {
lastfm("bbcradio1");
}


if (strpos($stnname, 'Radio 2') !== false) {
lastfm("bbcradio2");
}


if (strpos($stnname, '6Music') !== false) {
lastfm("bbc6music");
}


?>




<br/><br/>
<span class="footer">
<b>MaikePi</b> web interface &copy;2015 
<br />
<a href="http://www.suppertime.co.uk/blogmywiki/">Credis</a>
</span>

</body>
</html>
