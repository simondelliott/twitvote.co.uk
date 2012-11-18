

  <html>
  <head><title>Process Form Checker for data forms </title>
    <link rel="stylesheet" href="main.css" type="text/css" />
  </head>
  <body>
  <h1>twitvote.co.uk</h1>
<?php
include("init.php");  
include("lib1.php");
echo "<p></p>";
$debuginfo = 0;
$cxn = mysqli_connect($dbh,$dbu,$dbp,"twitvote") or die("Couldn't connect");
/*unset ($dbh,$dbu, $dbp)*/;


foreach ($_POST as $field => $value)
  {

     $newfield = explode(" ",$value);
     if ($debuginfo == 1)
     { 
       echo "$field = $value<br />\n";
       echo "$newfield[0]<br />\n";
       echo "$newfield[1]<br />\n";
       echo "$newfield[2]<br />\n";
     }
     $vote_date = date("Y-m-d");
     $sql = "insert into votes (vote_date, vote_detail,code,vote,source) values ('$vote_date','$newfield[0] $newfield[1] $newfield[2]','$newfield[1]',$newfield[2],'web')";
     
     if ($debuginfo == 1)
     {  echo "$sql<br />\n";
     }
     $result=mysqli_query($cxn,$sql);
     if ($result==false)
     { 
       die('Error Inserting - die: ' . mysqli_error($cxn));
     }
     echo "<p>Your vote was successfully recorded</p>"; 
     echo "<p>Your vote was for $newfield[2] </p>";
 /*    unset($newfield); Do not destroy to preserve the code to calc stats to date */
     
  }
  
/* Calculate the stats for each value */ 
  $sql = "select vote, count(vote) as numvotes from votes where (code = '$newfield[1]') group by vote";
  if ($debuginfo == 1)
  { 
    echo "$sql<br />\n";
  }
  $result=mysqli_query($cxn,$sql);
  if ($result == False)
    {echo "<h4>Error: ".mysqli_error($cxn)."</h4>";}
  else
    {if (mysqli_num_rows($result) < 1)
      {echo "<p>No current databases or rows in the table</p>";}
     else
     {echo "<b><p>Current results" ;
       while ($row = mysqli_fetch_row($result))
       { echo "<p>"; 
         echo "Answer $row[0] has "; 
         echo "$row[1] votes"; 
         echo "</p>";
       }
     echo "</b></p>";
     }
   }
echo "<p></p>";
echo "<p></p>";
?>
</body></html>