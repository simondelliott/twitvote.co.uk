<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Welcome to twitvote.co.uk - making meetings more engaging</title>
    <link rel="stylesheet" href="main.css" type="text/css" />
</head>
<?php
/* Program:  	aboutus
 * Desc:      	
 *
 */
?>
<H1>twitvote.co.uk</H1>
<?php  
  include('lib1.php');
?> 
<H2>About us</H2>
<p>twitvote.co.uk is a Creative Space Learning project.</p>
<p>Creative Space Learning is a very small company that specialises in helping managers and directors to motivate and inspire their teams.
We have deliberately separated managers and directors, as the skills that both require to manage, motivate and inspire are not the same.</p>
<p>twitvote.co.uk is one of the tools that we have developed that can help.  twitvote helps you break up long presentations into short focused interactive sections. 
There is an old saying 'I hear and I forget, I see and I remember, I do and I understand'.  twitvote is positioned between 'see' and 'do'. 
Used well, it will both support you in getting people to understand your messages and also help you to understand how people feel about those messages.
You will learn and your audience will learn and remember.</p> 
<p>It's not the only tool and not always the best tool, but it helps and it's free!</p>
<h3>Examples of projects that Creative Space Learning have undertaken:</h3>
<p><ul>
  <li>Getting a group of individuals to start working together as a team (small company); </li>
  <li>Helping managers to understand how story telling techniques can enhance their presentations (FTSE 100 company);</li>
  <li>Supporting directors with voice skills to make staff briefings more engaging and memorable (FTSE 100 company);</li>
  <li>Running large (200 people) events to build engagement and commitment around a new business strategy (FTSE100 company); </li>
  <li>Designing online training and webinars to keep people interested and engaged (Fortune 500 company).</li> 
</ul></p>
<h2>Who are the people behind Creative Space Learning</h2>
<h3>Halina</h3> 
<p>I run Creative Space Learning.  I bring a rare blend of skills and experiences that I can draw on to help my clients:</p>
<p><ul>
  <li>Over 10 years experience as a counsellor and as a lecturer in counselling give me a strong empathy with people and an ability to work out what is motivational.</li>
  <li>Professional training as a actor and a part time lecturer with renowned schools such as Central School of Speech and Drama has helped me refine my understanding 
      of how to communicate so that people will remember and understand a message.</li>
  <li>Experience of running small and large projects for clients has allowed me to refine the tools and techniques to ensure they are effective.</li>
  <li>Graduate and post graduate qualifications that give a deep understanding of the theory - BSc in Social Administration, MA in Counselling, Diploma in Counselling Supervision</li>
  <li>A continuing desire to learn with clients and individually.  I am currently studying creative writing and writing my first novel.</li>
</ul></p>
<h3>David (Halina's husband)</h3> 
<p>I'm the techie geek (part time).  My day job is leading digital projects for large IT companies.  However,
I love tweeking around with technology, having started my career as a programmer (mostly Pascal fortran and assembler).  Getting twitvote up and running was a fun way to spend the 
Halloween half term of 2012 and helped me get a better insight of how quickly an experienced developer could integrate a social platform (twitter)
as well as a messaging platform (SMS) and how much that should cost. </p>
<p>I found it amazing how quickly one could get going with creating a reasonably functional web site.  My resources were:</p>
<p><ul>
  <li>two 'for dummies' books - PHP & MySQL for Dummies and HTML5 for Dummies</li>
  <li>the help of the social web (people who had put great 'how to' guides on youtube and other websites'</li>
  <li>fasthosts.com web hosting</li>
  <li>textlocal.com for SMS</li>
  <li>twitter for twitter</li>
  </ul></p> 
<p>All in all, I was able to go from not knowing php/mysql/apache/linux to getting this web site fully up and running within 7 days (about 50 hours).
The site cost less than £100.
The most expensive part was the 'for dummies' books - about £50.  Everything else was done for less than £50 - 
fasthosts hosting £2.99 a month (12 month contract) plus £7 for domain registration.
textlocal - £10 for the twitvote keyword forwarding (3 month contract). 
A big thank you to all the people who put lessons and tutorials online.  Without all of that help, I would have been toast.  My development schedule was:
</p>
<p><ul>
  <li>Sunday - get everything set up and do some design & security planning.  I strongly recommend the XAMPP application.  I use a Mac - installed it from the web 
  and it worked first time and totally reliable - brilliant!  I decided to use linux hosting as I haven't done that before.</li>
  <li>Monday - got the first version of the site working - worked out how to pass parameters between pages; store data into the MySQL database;
  get data out of the MySQL database; started learning CSS; played around with Google charts APIs so that I could do graphs - that looks complicated.</li>
  <li>Tuesday - got the full information architecture of the site set up and running.  Created the navigation.  Created the main question form.
  Restructured the code so that I had libraries to store re-usable functions, navigation etc.</li>
  <li>Wednesday - Got the site fully working with web voting and did a bit on CSS.</li>
  <li>Thursday - Got the site working with SMS voting but it was tricky - no time to do graphs.</li>
  <li>Friday - Went to legoland Windsor with my son - lots of fun, great fireworks, no coding.</li>
  <li>Saturday - Started twitter integration in the evening - major headache - the APIs are complex and had to work out what JSON was.  Very little intro code on the web.</li>
  <li>Sunday - Sorted twitter - found a great reference that had some sample code that gave me a clue about how to process twitter search results - http://snipplr.com/view/56994/ .</li>
</p></ul>
<p>I hope the above is helpful. and if you got to this paragraph, thanks for reading.</p>