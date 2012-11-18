<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Welcome to twitvote.co.uk - making meetings more engaging</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
<script type="text/javascript">
function show_tweet($item) {
  var $itemid = document.getElementById($item);
  if ($itemid.style.display == 'none')
    $itemid.style.display = 'block';
  else
    $itemid.style.display = 'none';
  }
</script>

</head>
<body>
<h1>twitvote.co.uk</h1>

<?php
$debug = 0;
include('lib1.php');
include("init.php");  
echo "<p></p>";
$cxn = mysqli_connect($dbh,$dbu,$dbp,"twitvote") or die("Couldn't connect to twitvote database");
?>

<div id="container" style="width:550px;margin-left:auto;margin-right:auto;">
</div>

<div id="search">
  <p>This form is used as a quick way of searching twitter.  It will also add any correctly formatted tweets to the twitvote database.</p>
<form action="" method="get">
  <label style="color:#FFFFFF">
  <strong>Search twitter : </strong>
  <input type="text" name="query" id="searchbox" value = "twitvote day"/>
  <input type="submit" name="submit" id="submit" value="Search" />
  </label>
</form>
</div>
<?php

//Search API Script
$searchtag=$_GET['query'];
if ($debug==1) 
{echo "<P>Searcht =".$searchtag."=</p>";}

if (strlen($searchtag)==0) 
/*if($_GET['query']=='')*/

  {
    $searchtag = 'twitvote day';
  }
/*$searchtag = "twitvote";  */ 
$request = "http://search.twitter.com/search.json?q=".urlencode($searchtag).";rpp=100";
$response = file_get_contents($request);
/* echo "<p>Response:".$response.":</p>";*/

$jsonobj = json_decode($response);

$numtweets = 0; 
if($jsonobj != null){
  
	foreach($jsonobj->results as $item){	  
	  $numtweets++;
  	  echo "<a onclick=\"show_tweet('tweet".$numtweets."');\"><p style=\"color:#3366ff \"><b><u>";
  	  echo $item->text;
      echo "</p></b></u></a><div id=\"tweet".$numtweets."\" style=display:none;>";

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
             echo "<p>Processing Twitvote vote</p>"; 
             $result=mysqli_query($cxn,"SELECT COUNT( * ) FROM  `twitter` WHERE tweet_id =  '$id_str'");
             $row = mysqli_fetch_row($result); 
             if ($row[0]==0)
             { echo "<p>tweet not in database</p>";
               $result=mysqli_query($cxn,$sql);
               $sql = "insert into votes (vote_date, vote_detail,code,vote,source,user) values ('$mysqldate','$newfield[0] $newfield[1] $newfield[2]','$newfield[1]',$newfield[2],'twitter','$from_user_id_str')";
               echo "<p>".$sql."</p>";
               $result=mysqli_query($cxn,$sql);
             }            
             else
             {echo "<p>tweet already in database</p>";}
          }
        if ($debug == 0) {
          echo "<p>created_at:".$created_at.":</p>";
          echo "<p>mysqldate:".$mysqldate.":</p>";
          echo "<p>from_user:".$from_user.":</p>";
          echo "<p>from_user_id:".$from_user_id.":</p>";
          echo "<p>from_user_id_str:".$from_user_id_str.":</p>";
/*          echo "<p>geo:".$geo.":</p>"; */
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
          echo "<p>to_user_name:".$to_user_name.":</p>";
          echo "</div>";
        }           
    }
 if ($numtweets == 0) {echo "<p> No results returned:".$response.":</p>" ;}
 else {echo "<p>Total tweets processed is:".$numtweets."</p>";}
}
else
  {echo "<P>No search results.</p>";}
?>

</body>
</html>
