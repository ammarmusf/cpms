<?php
   include('config.php');
   session_start();
   
   //we are retrieving the file and information of the paper from the databse if it exists.
   if(!empty($_GET['file'])){
        $filename=mysqli_real_escape_string($db,basename($_GET['file']));
      

        $pid=basename($_GET['pid']);
        $revid=basename($_GET['revid']);
        $authid=mysqli_real_escape_string($db,basename($_GET['auth']));
        $topic=basename($_GET['topic']);
        $dte=basename($_GET['date']);

        //retrieve the author first name from the DB
        $sql_auth="select * from author where author_id='$authid'";
        $result = mysqli_query($db,$sql_auth);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $auth=mysqli_real_escape_string($db,  $row['first_name']);
   }

?>
<html>
<div class="container">    
  <head>
    <!-- Below is styling -->
    <style>
      body {
      background-color: #fff;
      font-family: Lato, sans-serif;
      }
      .container {
      background: linear-gradient(90deg, rgba(1,1,1,1) 5%, rgba(199,147,241,1) 81%, rgba(180,124,195,1) 100%);
      }
      .text-center {
      text-align: center;
      left: 50%;
      height: 20px;
      }
      .button { 
      height: 50px; 
      width: 200px; 
      } 
      #comments
      {
          height:100px;
          font-size:14pt;
      }
      header {
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #bfc4ff;
      box-sizing: border-box;
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;

      font-family: Poppins, sans-serif;
      color: #222;
      }
      h1 {
      font-size: 2rem;
      }
      underline {
      text-decoration: underline;
      }
      li {
      display: inline-block;
      margin: 0 10px;
      font-size: 1rem;
      font-weight: 700;
      text-transform: uppercase;
      }
      main {
      min-height: 1200px;
      max-width: 90vw;  
      margin: 120px auto;
      padding-top: 40px;
      }
      p{
      font-size: 1.2rem;
      line-height: 1.5;
      color: #fbfbfb;
      }
      p2 {
      font-size: 1.2rem;
      line-height: 1.5;
      color: yellow;
      }
      p3 {
      font-size: 1.2rem;
      line-height: 1.3;
      color: #fbfbfb;
      }
      form {
      font-size: 1.2rem;
      line-height: 1.5;
      color: #fbfbfb;
      }
     table {
     font-family: arial, sans-serif;
     border-collapse: collapse;
     width: 100%;
    }

    
    td, th {
    color: #fbfbfb;
    font-weight: bold;
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
    }
    
    th{
      font-size: 20px;
      background-color: #222;
    }
   
    tr:nth-child(even) {
    background-color: #808080;
    }
    
    footer {
      left: 0;
      bottom: 0;
      height: 50px;
      width: 100%;
      background-color: #bfc4ff;
      color: #000000;
      text-align: center;
      }

    </style>
  </head>

    <header>
    <h1>CCSC - Consortium for Computing Sciences</h1>
    <nav>
      <ul>
               <li><a href="Homepage.php">Home</a></li>
  <?php  
    $role=$_SESSION['role'] ;
    if(strcasecmp($role,"author") == 0) {       
        echo "<li><a href=paper_submission_form.php>Submit Paper</a></li>";
    }
    
      if(strcasecmp($role,"admin") == 0) {       
        echo "<li><a href=generate_report.php> Manage Submission </a></li>";
    }
    
      if(strcasecmp($role,"admin") == 0) {       
        echo "<li><a href=admin_reports.php> Admin reports </a></li>";
    }
    
      if(!strcasecmp($role,"admin") == 0) {       
        echo "<li><a href=Profile.php> Profile </a></li>";
    }
  ?>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>


<form action = "update_review.php" method = "post">
  <main>
    <p style="text-align:center">
      CCSC Paper Review
      <br><p2><b>Please grade the following paper fairly and accordingly in compliance with the CCSC grading standards</b></p2>
    </p>
      <?php
      echo '<p3> Paper ID:'.$pid.' </p3><br>';
      echo '<p3> Author:'.$auth.' </p3><br>';
      echo '<p3> Submission Date:'.$dte.' </p3><br>';
      echo '<p3> Topic:'.$topic.' </p3><br>';
      echo  '<p3> file:'. $filename.' </p3><br>';
      echo '<p3> <a href="download.php?file='.$filename.'">Download the file </a></p3><br>';
    ?>
    <br>
    
    <p style="text-align:center">
      Content
    </p>
      <table>
        <tr>
          <th>Appropriateness of Topic</th>
          <th>Timeliness of Topic</th>
          <th>Supportive Evidence</th>
          <th>Technical Quality</th>
          <th>Scope of Coverage</th>
          <th>Citation of Previous Work</th>
          <th>Originality</th>
          <th>Comments</th>
        </tr>
        <tr>
          <td>
            <select name="Appropriateness_of_Topic" >
            <option value="1">Poor</option>
            <option value="2">Fair</option> 
            <option value="3">Good</option> 
            <option value="4">Average</option> 
            <option value="5">Excellent</option> 
            </select></td>
          <td>
            <select name="Timeliness_of_Topic" >
            <option value="1">Poor</option>
            <option value="2">Fair</option> 
            <option value="3">Good</option> 
            <option value="4">Average</option> 
            <option value="5">Excellent</option> 
            </select></td>
          <td>
            <select name="Supportive_Evidence" >
            <option value="1">Poor</option>
            <option value="2">Fair</option> 
            <option value="3">Good</option> 
            <option value="4">Average</option> 
            <option value="5">Excellent</option> 
            </select></td>
          <td>
            <select name="Technical_Quality" >
            <option value="1">Poor</option>
            <option value="2">Fair</option> 
            <option value="3">Good</option> 
            <option value="4">Average</option> 
            <option value="5">Excellent</option> 
            </select></td>
          <td>
            <select name="Scope_of_Coverage" >
            <option value="1">Poor</option>
            <option value="2">Fair</option> 
            <option value="3">Good</option> 
            <option value="4">Average</option> 
            <option value="5">Excellent</option> 
            </select></td>
          <td>
            <select name="Citation_of_Previous_Work" >
            <option value="1">Poor</option>
            <option value="2">Fair</option> 
            <option value="3">Good</option> 
            <option value="4">Average</option> 
            <option value="5">Excellent</option> 
            </select></td>
          <td>
            <select name="Originality" >
            <option value="1">Poor</option>
            <option value="2">Fair</option> 
            <option value="3">Good</option> 
            <option value="4">Average</option> 
            <option value="5">Excellent</option> 
            </select></td>
          <td>
            <input type="text"  placeholder="Comments" name="content_comments"></td>
        </tr>
      </table>
    
    
    
      <p style="text-align:center"><br><br>
      Written Document
    </p>
      <table>
        <tr>
          <th>Organization of Paper</th>
          <th>Clarity of Main Message</th>
          <th>Mechanics (grammar,etc)</th>
          <th>Comments</th>
        </tr>
        <tr>
          <td>
            <select name="Organization_of_Paper" >
            <option value="1">Poor</option>
            <option value="2">Fair</option> 
            <option value="3">Good</option> 
            <option value="4">Average</option> 
            <option value="5">Excellent</option> 
            </select></td>
          <td>
            <select name="Clarity_of_Main_Message" >
            <option value="1">Poor</option>
            <option value="2">Fair</option> 
            <option value="3">Good</option> 
            <option value="4">Average</option> 
            <option value="5">Excellent</option> 
            </select></td>
          <td>
            <select name="Mechanics" >
            <option value="1">Poor</option>
            <option value="2">Fair</option> 
            <option value="3">Good</option> 
            <option value="4">Average</option> 
            <option value="5">Excellent</option> 
            </select></td>
          <td>
            <input type="text"  placeholder="Comments" name="wd_comments">
              
          </td>
        </tr>
      </table>
    

      <p style="text-align:center"><br><br>
      Potential for Oral Presentation
    </p>
      <table>
        <tr>
          <th>Suitability for Presentation</th>
          <th>Potential Interest in Topic</th>
          <th>Comments</th>
        </tr>
        <tr>
          <td>
            <select name="Suitability_for_Presentation" >
            <option value="1">Poor</option>
            <option value="2">Fair</option> 
            <option value="3">Good</option> 
            <option value="4">Average</option> 
            <option value="5">Excellent</option> 
            </select></td>
          <td>
            <select name="Potential_Interest_in_Topic" >
            <option value="1">Poor</option>
            <option value="2">Fair</option> 
            <option value="3">Good</option> 
            <option value="4">Average</option> 
            <option value="5">Excellent</option> 
            </select></td>
          <td>
            <input type="text"  placeholder="Comments" name="op_comments">
              
          </td>
        </tr>
      </table>


      <p style="text-align:center"><br><br>
        Overall Rating
    </p>
      <table>
        <tr>
          <th>Overall Rating</th>
          <th>Comments</th>
        </tr>
        <tr>
          <td>
            <select name="Overall_Rating" >
            <option value="1">Definitly Should Not Accept Paper</option>
            <option value="2">Probably should Not Accept Paper</option> 
            <option value="3">Uncertain About Acceptance of Paper</option> 
            <option value="4">Probably Should Accept Paper</option> 
            <option value="5">Definitly Should Accept Paper</option> 
            </select></td>
          <td>
            <input type="text"  placeholder="Comments" name="comments">
              
          </td>
        </tr>
      </table>
    
    <br><br>

  <?php
    echo '<input type="hidden" name="h_pid" value='.$pid.'> ';
	  echo '<input type="hidden" name="h_revid" value='.$revid.'> ';
	?>
    <input type="submit" name="b_submit" class="button" value="Submit Review" />
</form>
  </main>
  <div class="footer">
    <footer><b><br>Contact us ---- +1 813-666-666 ---- r.astley@usf.com</footer>  
  </div> 
 
</div>
</html>