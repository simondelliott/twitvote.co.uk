<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>twitvote - vote results</title>
    <link rel="stylesheet" href="main.css" type="text/css" />
    <style type="text/css">
    .InputClass {
      font-family:Arial, Helvetica, sans-serif;
      font-size:18px; 
      }
    </style>

  </head>
  <body>
  <h1>twitvote.co.uk</h1>
<?php

/*INITIALISATIONS*/
  include("init.php");  
  include("lib1.php");
  echo "<p></p>";
  $debuginfo = 0;				/*Set to 1 to include debug output, set to 0 to stop debug output*/ 
  $totalvotes = 0;			    /*Used to test for no votes received so far for a particular question*/
  For ($i=1;$i<=12;$i++)
  {$numvotes[$i]=0;} 		    /*Ensure that numvotes variable used to store the votes for each choice is set to zero to initialise*/
/*END INITIALISATIONS*/
?>

<div id="headercontainer">
<div id="left_div" style = "float:left; width:400px; height:200px; border-radius:1em;  border:solid blue 1px;">
<?php
$cxn = mysqli_connect($dbh,$dbu,$dbp,"twitvote") or die("Couldn't connect to twitvote database");
/*unset ($dbh,$dbu, $dbp)*/

/*If the form was called from question.php, process the parameters passed in the POST array*/
$i=1;
foreach ($_POST as $field => $value)
  {
     if ($debuginfo == 1)
     { 
       echo "$field = $value<br />\n";
     }
    $newfield[$i] = $value ;
    $i++ ;
    if($i==3){$vote_code = $value;}
  }

  
/*If the form was called by itself, process the parameters in the GET array*/  
if(strlen($newfield[1]) == 0 )
  {
   $newfield[2] = $_GET["vote_code"];
   $vote_code = $_GET["vote_code"];
   $sql = "select * from questions where (vote_code='".$_GET["vote_code"]."' and vote_date = '".$_GET["vote_date"]."')";
   $result=mysqli_query($cxn,$sql);
   $row = mysqli_fetch_row($result);

   For ($i=1;$i<=12;$i++)
   {
     $newfield[$i]=$row[$i-1];
   }
  }
else 
{

      /*Check if the question has been entered in the question database.  If it has update it.  If it hasn't add it.*/
        $sql = "delete from questions where (vote_code='".$newfield[2]."' and vote_date = '".date("Y-m-d")."')";
        $result=mysqli_query($cxn,$sql);
        $sql = "insert into questions (question,vote_code,answer1,answer2,answer3,answer4,answer5,answer6,answer7,answer8,answer9,answer10,vote_date)". 
               " values ('".$newfield[1]."','".$newfield[2]."','".$newfield[3]."','".$newfield[4]."','".$newfield[5]."','".$newfield[6]. 
               "','".$newfield[7]."','".$newfield[8]."','".$newfield[9]."','".$newfield[10]."','".$newfield[11]."','".$newfield[12]."','".date("Y-m-d")."')";  
        $result=mysqli_query($cxn,$sql);
}
 
?>



<form action="" method="get">
    <?php  echo "<p>Question code <br> <input type=\"text\" name=\"vote_code\" id=\"vote_code\" value = \"".$vote_code."\" class=\"InputClass\" /> <br>";?>
    <?php  echo "Vote date <br> <input type=\"text\" name=\"vote_date\" id=\"vote_date\" value =\"".date('Y-m-d')."\" class=\"InputClass\" /><br>"; ?>
    <input type="submit" name="submit" id="submit" value="Click to update vote results" class="InputClass" /> <br>
   </p> 
</form>
</div>
  <div id="right_div" style="width: 380px; height:200px; float:right; border-radius:1em;  border:solid blue 1px;">
   <p>You can vote using:</p>
   <?php
     echo "<ul><li>Twitter</li>";
     echo "<li> or text to +44 7786 200 690</li>";
     echo "<li>or go to www.twitvote.co.uk</li></ul>";   
     echo "<p>Use the message format</p>";
     echo "<p><ul><li>twitvote $vote_code <em>answer_number</em></ul></li></p>";
     
   ?>
  </div>
</div>
<p>&nbsp</p>
<div id="resultscontainer" style="float:left; margin-top:1cm; width: 800px; height:400; border-radius:1em;  border:solid blue 1px;">


<script type="text/javascript">
      window.document.title = "twitvote - vote results - <?php echo $vote_code; ?> ";
</script>
    
<?php      

/* Calculate the stats for each value */ 
  if ($newfield[2] == "day") 
       {$sql = "select vote, count(vote) as numvotes from votes where (code = '$newfield[2]') group by vote";
        $sql1 = "select count(vote) as numvotes from votes where (code = '$newfield[2]')";
       }
  else
    { if (!isset($_GET["vote_date"])) 
        {/* only called on insert of new code so result should be zero votes found*/ 
         $sql1 = "select count(vote) as numvotes from votes where (code = '$newfield[2]' and vote_date = '".$_GET["vote_date"]."')";}
      else
        {$sql = "select vote, count(vote) as numvotes from votes where (code = '$newfield[2]' and vote_date = '".$_GET["vote_date"]."') group by vote";
         $sql1 = "select count(vote) as numvotes from votes where (code = '$newfield[2]' and vote_date = '".$_GET["vote_date"]."')";
        }  
    }  
  if ($debuginfo == 1)
  { 
    echo "$sql<br />\n";
    echo "$sql1<br />\n";
  }
  $totalvotes = 0;

  $result=mysqli_query($cxn,$sql1);
  if ($result == False)
    {echo "<h4>Database error: ".mysqli_error($cxn)."</h4>";}
  else 
    {$row = mysqli_fetch_row($result);

     $totalvotes = $row[0];

    } 

  $result=mysqli_query($cxn,$sql);
  if ($result == False)
    {echo "<h4>Database error: ".mysqli_error($cxn)."</h4>";}
  elseif ($totalvotes ==0)
    {echo "<p>There are no votes for the code '<b>$vote_code</b>' so far<p>";
     For ($i=3;$i<=12;$i++)
       {  if (strlen($newfield[$i])>0) /* Only output result if there was a valid answer entered*/
         {
           echo "<p margin:0 0 0 0;><b>".($i-2)." = "; 
           echo $newfield[$i]."</b> has <b>"; 
           echo "0</b> votes"; 
           echo "</p>";
         } 
       }
    }
  else
    { 
      /* Query executed OK but check if any rows were returned (i.e. have there been any votes?*/
    
      if ($totalvotes==0)
      {
        echo "<p>There are no votes for the code <b>$newfield[2]</b> so far<p>";
        $totalvotes = 0;
      }
     else
     { 
       $numvotes[$row[0]]=$row[1];
       echo "<div id = \"title\" style=\"float:left; width:800px; height:30;\">";


       echo "<p><h2 margin:0 0 0 0;>".$newfield[1]."</h2></p>";
       echo "</div>";
       echo "<div id = \"results\" style = \"float:left; width:300px; height:400; \"> ";
       echo "<p>$totalvotes votes found</p>";
     /*  echo "<p> twitvote code = ".$newfield[2]."</p>";
       echo "<b><p>Results:</p></b>" ; */
       For ($i=1;$i<=12;$i++){$numvotes[$i]=0; /* initialise the array*/}
       while ($row = mysqli_fetch_row($result))
       {
         $numvotes[$row[0]]=$row[1];
       }

       $i=3;
       For ($i=3;$i<=12;$i++)
       { if (strlen($newfield[$i])>0) /* Only output result if there was a valid answer entered*/
         {  echo "<p margin:0 0 0 0;><b>".($i-2)." = "; 
           echo $newfield[$i]."</b> - <b>"; 
           echo $numvotes[$i-2]."</b> votes"; 
           $totalvotes += $numvotes[$i-2];
           echo "</p>";
         } 
       }
     echo "</b></p>";
     }
   }
/* echo "<p>Results pie chart</p>"; */
if($totalvotes==0){echo "</div></body></html>"; die('');}
?>
        
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
<?php     echo "data.addColumn('string', 'Employee Name');"; 
          echo "data.addColumn('number', 'Count');"; 
          echo "data.addRows(10);";
          For ($i=3;$i<=12;$i++) {
            echo "data.setCell(".($i-3).",0,'".$newfield[$i]."');";
            echo "data.setCell(".($i-3).",1,".($numvotes[$i-2]+0).");";
          }  
?>
        var options = {
          title: ''
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
 </div>
    
 <div id="chart_div" style="width: 480px; height:400; float:right;  "></div>

</div>

<div id="twitter_results" style="width: 800px; float:left; margin-top:1cm; border-radius:1em;  border:solid blue 1px;" >
<?php
  /*Process twitter feed*/
  $request = "http://search.twitter.com/search.json?q=twitvote+".urlencode($vote_code).";rpp=100";
  $response = file_get_contents($request);
  $jsonobj = json_decode($response);
  $numtweets = 0; 
  echo "<p>Procesing Twitter - searching for twitvote+".urlencode($vote_code)."</p>";
  if($jsonobj != null)
  {
    foreach($jsonobj->results as $item)
	  {
	    $numtweets++;

        /* extract all the items from each result into variables */
  	    $created_at = $item->created_at;
	    $from_user = $item->from_user;
		$from_user_id = $item->from_user_id;
		$from_user_id_str = $item->from_user_id_str;
		$from_user_name = $item->from_user_name;
		$geo=$item->geo; 								/* Note this attribute is and object but is being depricated */
		$id = $item->id;
		$id_str = $item->id_str;
		$iso_language_code = $item->iso_language_code;		
		$result_type = $item->metadata->result_type;
		$profile_image_url=$item->profile_image_url;
		$profile_image_url_https=$item->profile_image_url_https;
		$source = $item->source;
		$text = $item->text;
		$to_user = $item->to_user;
		$to_user_id = $item->to_user_id;
		$to_user_id_str = $item->to_user_id_str;
		$to_user_name = $item->to_user_name;
      /* Convert variables into a format usable by MySQL (where necessary) */
		$created_at_time = strtotime($created_at);
		$mysqldate = date('Y-m-d H:i:s',$created_at_time);
		$mysqldate = date('Y-m-d',$created_at_time);
		
		if($to_user_id==""){ $to_user_id = 0; }
        $newfield = explode(" ",$text);
        $sql = "insert into twitter (tweet_id, tweet_date,content,user,user_id_str) values ('$id_str','$mysqldate','$newfield[0] $newfield[1] $newfield[2]','$from_user','$from_user_id_str')";
        if (strtolower($newfield[0])=="twitvote")
          {
             echo "<p>".$text.":";
             $result=mysqli_query($cxn,"SELECT COUNT( * ) FROM  `twitter` WHERE tweet_id =  '$id_str'");
             $row = mysqli_fetch_row($result); 
             if ($row[0]==0)
             { echo "tweet has been added</p>";
               $result=mysqli_query($cxn,$sql);
               $sql = "insert into votes (vote_date, vote_detail,code,vote,source,user) values ('$mysqldate','$newfield[0] $newfield[1] $newfield[2]','$newfield[1]',$newfield[2],'twitter','$from_user_id_str')";
               /*echo "<p>".$sql."</p>";*/
               $result=mysqli_query($cxn,$sql);
             }            
             else
             {echo "tweet has been counted</p>";}
          }
/*          echo "<p>created_at:".$created_at.":</p>";
          echo "<p>mysqldate:".$mysqldate.":</p>";
          echo "<p>from_user:".$from_user.":</p>";
          echo "<p>from_user_id:".$from_user_id.":</p>";
          echo "<p>from_user_id_str:".$from_user_id_str.":</p>";
          echo "<p>id:".$id.":</p>";
          echo "<p>id_str:".$id_str.":</p>";
          echo "<p>iso_language_code:".$iso_language_code.":</p>";
          echo "<p>result_type:".$result_type.":</p>";
          echo "<p>profile_image_url:".$profile_image_url.":</p>";
          echo "<p>profile_image_url_https:".$profile_image_url_https.":</p>";
          echo "<p>source:".$source.":</p>"; 
          echo "<p>text:".$text.":</p>";
          echo "<p>to_user:".$to_user.":</p>";
          echo "<p>to_user_id:".$to_user_id.":</p>";
          echo "<p>to_user_id_str:".$to_user_id_str.":</p>";
          echo "<p>to_user_name:".$to_user_name.":</p>";*/
      }     
   }
  
?>

</div>
</body></html>