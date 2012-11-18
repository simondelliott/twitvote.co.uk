<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>twitvote.co.uk - making meetings more engaging</title>
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
  include('lib1.php');
  echo "<p></p>";
?>  
<?php
/* Program:  	page44.php - mysql_test.php in the book
 * Desc:      	Connects to MySql Server and outputs settings
 *


echo "now includes init file";
 */
$debuginfo = 0;
include("init.php");  

$host = $dbh;
$user = $dbu;
$password = $dbp;
unset ($dbh,$dbu, $dbp);
?>

<form action="processform.php" method="POST">
  <p><input type="text" name="newvote" value = "twitvote " size="40" class="InputClass"/>
  <input type="submit" value="Click to Vote now" class="InputClass"/> </p>
</form>


<p> Enter your vote in the format:  <b>twitvote question_code answer_number </b> where:<p>

<p><ul>
  <li><b><em>twitvote</em></b> - all votes must begin with this word.  It's how the web site works out which messages are votes and which are not.</li>
  <li><b><em>question_code</em></b> - this is the code for the question you are voting on.  The person asking you the question will give you this code.
  <em>IMPORTANT: If you are testing this system for the first time, please make sure that you Create a Question before voting otherwise twitvote will 
      not know what question you are voting for.</em>
  </li>
  <li><b><em>answer_number</em></b> - this is the number of the answer you wish to vote for - typically a number from 1 to 10</li> 
</ul></p>
<h3>Show me an example</h3>

      <p>Suppose we have the following question:</p>
      <p>Question: What is your favourite day of the week?</p>
      <p>Question Code: day</p> 
      <p>Possible answers</p>
       <ul>
        <li> 1 = Monday </li>
        <li> 2 = Tuesday </li>
        <li> 3 = Wednesday </li>
        <li> 4 = Thursday</li>
        <li> 5 = Friday</li>
        <li> 6 = Saturday</li>
        <li> 7 = Sunday</li>
      </ul></p>
      <p>To vote for Tuesday, you would enter:</p>
       <ul>
        <li> twitvote day 2 </li>
   

<?php

if ($debuginfo == 1)
{ 
$cxn = mysqli_connect($host,$user,$password,"twitvote");
$sql = "select ID,vote_detail,code,vote from votes";
$result=mysqli_query($cxn,$sql);
if ($result == False)
  {echo "<h4>Error: ".mysqli_error($cxn)."</h4>";}
else
  {if (mysqli_num_rows($result) < 1)
    {echo "<p>No current databases</p>";}
   else
   {echo "<b><p> Starting New" ;
   while ($row = mysqli_fetch_row($result))
     { echo "<p>"; 
       echo $row[0]; 
       echo $row[1]; 
       echo $row[2]; 
       echo $row[3];
       echo "</p>";
     }
     
   echo "</b></p>";
   }
 }
 }
 
?>

</body></html>