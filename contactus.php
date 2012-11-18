
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Welcome to twitvote.co.uk - making meetings more engaging</title>
  <link rel="stylesheet" href="main.css" type="text/css" />
</head>
<body>
<?php
/* Program:  	Contact Us
 * Desc:      	
 *
 */
?>
<H1>twitvote.co.uk</H1>
<?php  
  include('lib1.php');
?> 
<H2>Contact us</H2>
<p>Please send an email to <a href= "mailto:support@twitvote.co.uk" >support@twitvote.co.uk</a></p>
<p>As this web site is developed in our spare time, responses will tend to be the evening following your note</p>
<h3>Improvements</h3>
<p>We welcome suggestions for improvements. The list of things we are working on are:</p> 
<p><ul>

  <li>On the question page, adding a button to see if anyone else is using a code at the moment.</li>
  <li>Am hoping to work with AbilityNet to check the accessibility of the site.</li>  
  <li>Creating some developer resources to share how we did some of the tricky bits - hopefully this will be helpful and maybe someone has a better way ....?</li>  
  <li>Creating an API - currently the results page uses GET so you can embed the parameters in URLs to distribute but would be nice to have an API</li>
  
</ul></p>
<p>The list of things we are thinking about for 2013 are:</p>
<p><ul>
  <li>Is it possible to hook twitvote directly into PowerPoint and / or Keynote?  How would that work and what would be the best way?</li>
  <li>Adding an optional email address to questions so that we can send people details of the questions and votes received at the end of each day.</li>
  <li>Supporting free text feedback questions e.g. give us your ideas how we could solve a problem.</li>
  <li>When we have a few common Qs, creating a FAQ</li>
  <li>Enhancing the twitter integration to use the REST API rather than the current integration using the search API (which is rate limited and only returns 100 tweets)/li>
</ul></p>
<p>Recent features added are:
  <ul>
    <li>Nov 2012 - Making the codes date specific to reduce the likelihood of a clash.  The code 'day' that is used in the example question has been left not date specific to find out what the world's favourite day is!!</li>
    <li>Nov 2012 - Adding CSS to make the whole thing look better.</li>
  </ul>
</p> 
</body>
</html>