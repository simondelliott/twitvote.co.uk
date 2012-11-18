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

    <script type="text/javascript">
    function showdayofweek()
    {
     document.getElementsByName("tv_question")[0].value = "What is your favourite day of the week?";
     document.getElementsByName("tv_code")[0].value = "day";
     document.getElementsByName("tv_answer1")[0].value = "Monday";
     document.getElementsByName("tv_answer2")[0].value = "Tuesday";
     document.getElementsByName("tv_answer3")[0].value = "Wednesday";
     document.getElementsByName("tv_answer4")[0].value = "Thursday";
     document.getElementsByName("tv_answer5")[0].value = "Friday";
     document.getElementsByName("tv_answer6")[0].value = "Saturday";
     document.getElementsByName("tv_answer7")[0].value = "Sunday";
      
    }
    </script>
</head>    
<body>
  <h1>twitvote.co.uk</h1>
<?php  
  include('lib1.php');
?>  
  <h2>Enter the question and answers that people can vote for:</h2>

   <form action="results.php" method="POST">
   <p> Question: <input type="text" name="tv_question" size="80" class="InputClass"  /><br></p>
    <p>Question code: <input type="text" name="tv_code" size="20" class="InputClass" /><br></p>
    <p><em>Question code is a unique code that you make up for this question e.g. my_code_01.  To allow for codes to be re-used, question codes are valid for 1 day (i.e. today) </em> Click the 'show day of week example' button below to see an example.</p>
    <p>Answers that people can vote for:<br>
    1 = <input type="text" name="tv_answer1" size="50" class="InputClass"/><br>
    2 = <input type="text" name="tv_answer2" size="50" class="InputClass"/><br>
    3 = <input type="text" name="tv_answer3" size="50" class="InputClass"/><br>
    4 = <input type="text" name="tv_answer4" size="50" class="InputClass"/><br>
    5 = <input type="text" name="tv_answer5" size="50" class="InputClass"/><br>
    6 = <input type="text" name="tv_answer6" size="50" class="InputClass"/><br>
    7 = <input type="text" name="tv_answer7" size="50" class="InputClass"/><br>
    8 = <input type="text" name="tv_answer8" size="50" class="InputClass"/><br>
    9 = <input type="text" name="tv_answer9" size="50" class="InputClass"/><br>
    10 = <input type="text" name="tv_answer10" size="50" class="InputClass"/> <br></p>
    <p><input type="submit" value="Save Question and Start Voting" class="InputClass"/> 
    <input type="button" value="Show day of week example" onclick = "showdayofweek()" class="InputClass"/> 
    <input type="reset" value="Clear question fields" class="InputClass"/></p>
    
  </form>

</body></html>