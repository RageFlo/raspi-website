<html>
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<title>shutdown</title>
<style type="text/css">
  body {
    color: #000000;
    background-color: #FFFFFF;
       }

  .logo {
    font-family: HelveticaNeue-CondensedBlack, Helvetica, sans-serif;
    color: #BBBBBB;
     }

  .shutdown {
    font-family: HelveticaNeue-CondensedBlack, Helvetica, sans-serif;
    color: #FF0000;
     }

  .station {
    font-family: HelveticaNeue-CondensedBlack, Helvetica, sans-serif;
    color: #000000;
     }

  .volume {
    font-family: HelveticaNeue-CondensedBlack, Helvetica, sans-serif;
    color: #AAAAAA;
     }

  .stationlinks {
    font-family: HelveticaNeue-CondensedBold, Helvetica, sans-serif;
    }

  .volcontrol {
   background: #64F0FF;
   font-family: HelveticaNeue-CondensedBlack, Helvetica, sans-serif;
   }

  .commands {
    background: #FFFF00;
    font-family: HelveticaNeue-CondensedBlack, Helvetica, sans-serif;
    }

  .footer {
    -webkit-text-size-adjust: 75%;
    background: #FFFFFF;
    font-family: HelveticaNeue-CondensedBold, Helvetica, sans-serif;
    }

</style>

</head>

<body>

<h1><span class="logo">PiRadio @blogmywiki</span><br/><span class="shutdown">
<?php
$com=$_GET['command'];
if ($com=="shutdown") {
    echo "PiRadio is shutting down.<br/></span></h1><h2><span class=station>Please wait a minute for your Raspberry Pi to tidy up before removing its power.<br/>Close this web page or your radio will shut down next time you turn it on!";
    shell_exec("sudo /sbin/shutdown -h now");
}
?>

</span>
</h2>
<span class="station">
<h1>Are you sure you want to shut down?<br/>
<a href="?command=shutdown">yes</a> | 
<a href="index.php">no</a></h1>
</span>
<br/><br/>
<span class="footer">
PiRadio web interface &copy;2014 <a href="http://www.suppertime.co.uk/blogmywiki/">Giles Booth</a> <a href="http://twitter.com/blogmywiki">@blogmywiki</a>
</span>

</body>
</html>
