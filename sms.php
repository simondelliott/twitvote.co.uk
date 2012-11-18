
<?php
include("init.php"); 
$debug = 0;
if ($debug == 1) 
  {echo "<p>1. In debug mode</p>";}
if ($debug == 1) 
  {
    $innumber = "inNumber";
    $sender = "sender";
    $keyword = "keyword";
    $content = "content";
    $email = "email";
    $credits = "credits";
    $refid = "refid1";
    
      }
else
  {
    $innumber = $_REQUEST["inNumber"];
    $sender = $_REQUEST["sender"];
    $keyword = $_REQUEST["keyword"];
    $content = $_REQUEST["content"];
    $email = $_REQUEST["email"];
    $credits = $_REQUEST["credits"];
    $refid = $_REQUEST["refid"];

  }
if ($debug == 1) {echo "<p>2. Vars set</p>";}
/* 
// Example: Writing to a file //
// File format: id, sender, content //
*/



$fp = fopen('sms.csv', 'a');
fwrite($fp, $innumber.", ");
fwrite($fp, $sender.", ");
fwrite($fp, $keyword.", ");
fwrite($fp, $content.", ");
fwrite($fp, $email.", ");
fwrite($fp, $credits.", ");
fwrite($fp, $refid."\r\n");
fclose($fp);

if ($debug == 1) {echo "<p>3. Written sms.csv</p>";}
/* 
// Example: Writing to a database //
if ($debug == 1) {echo "written sms.csv"}

*/
$ep = fopen('smserror.csv', 'a');
$cxn1 = mysqli_connect($dbh, $dbu, $dbp,"twitvote");
 fwrite($ep, "cxn1 ".mysqli_error($cxn1)."\r\n"); 
fclose($ep);

if ($debug == 1) {echo "<p>4. DB Connection open</p>";}

$sql  = "INSERT INTO sms (innumber, sender, keyword, content, email, credits, refid) ";
$sql .= "VALUES ('";
$sql .= mysql_real_escape_string($innumber)."', ";
$sql .= "'".mysql_real_escape_string($sender)."', ";
$sql .= "'".mysql_real_escape_string($keyword)."', ";
$sql .= "'".mysql_real_escape_string($content)."', ";
$sql .= "'".mysql_real_escape_string($email)."', ";
$sql .= "'".mysql_real_escape_string($credits)."', ";
$sql .= "'".mysql_real_escape_string($refid)."')";

$sql  = "INSERT INTO sms (innumber, sender, keyword, content, email, credits, refid) ";
$sql .= "VALUES ('";
$sql .= $innumber."', ";
$sql .= "'".$sender."', ";
$sql .= "'".$keyword."', ";
$sql .= "'".$content."', ";
$sql .= "'".$email."', ";
$sql .= "'".$credits."', ";
$sql .= "'".$refid."')";

if ($debug == 1) {echo "<p>5. SQL = ".$sql."</p>";}

$rp = fopen('smssql.csv', 'a');
fwrite($rp, $sql."\r\n");
fclose($rp);


$result=mysqli_query($cxn1,$sql);

$newfield = explode(" ",$content);
$vote_date = date("Y-m-d");
$sql = "insert into votes (vote_date,vote_detail,code,vote,source,user) values ('$vote_date','$newfield[0] $newfield[1] $newfield[2]','$newfield[1]',$newfield[2],'sms','$sender')";
$result=mysqli_query($cxn1,$sql);

     
/*fwrite($fp, $refid.", ".$sender.", ".$keyword.", ".$content.", ".$email", ".$credits.", ".$innumber."\r\n");*/
?>
