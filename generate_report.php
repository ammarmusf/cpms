<?php
   include('config.php');
   session_start();

?>
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
      p {
      font-size: 1.2rem;
      line-height: 1.5;
      color: #fbfbfb;
      }
      p2 {
      font-size: 1.2rem;
      line-height: 1.5;
      color: yellow;
      }
      login {
      font-size: 2rem;
      line-height: 1.5;
      color: #fbfbfb;
      }
      form {
      font-size: 1.2rem;
      line-height: 1.5;
      color: #fbfbfb;
      }
      .button { 
      height: 25px; 
      width: 75px; 
      } 
      forgotpass {
      color: #0645AD
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
  <?php //script that will control the toolbar
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


  <main>
    <p style="text-align:center">
      CCSC Papers 
      <br>
      <p2>Find any information about Papers in the table below</p2>
    </p>
    <br>
    
  <table>
    <tr>
      <th>Allow submission/reviews</th>
      <th><select name="s_action">
        <option>Yes</option>
        <option>No</option>
      </select>
      <input type="submit" name="action_btn" value="Submit"></th>
    <tr>
  </table>
  <br><br>

  <table>
    <tr>
      <th>Paper ID</th>
      <th>Title</th>
      <th>Author</th>
      <th>Submission Date</th>
      <th>Topic</th>
      <th>Review Status</th>
      <th>Overall Rating (1-5)</th>
      <th>Report</th>
      <th>Action</th>
    </tr>

<?php //table has been created above. Below, we will retrieve the data from the database and display them accordingly.
    $sql_Paper="select * from Paper";
    $result = mysqli_query($db,$sql_Paper);
    

    while($row = mysqli_fetch_assoc($result)) {
      
          $ppId=mysqli_real_escape_string($db,  $row['paperid']);
          $auth_id=mysqli_real_escape_string($db,  $row['authorid']);
        
        $sql_review="select * from review where paperId='$ppId' LIMIT 1";
      $result2 = mysqli_query($db,$sql_review);
      $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
      
      $sql_author_name="select * from author where author_id='$auth_id'";
          $result_author_name = mysqli_query($db,$sql_author_name);
      $row_author_name = mysqli_fetch_array($result_author_name,MYSQLI_ASSOC);
      
    echo '<tr><td>'.$ppId.'</td>';
    echo '<td>'.$row['title'].'</td>';
    echo '<td>'.$row_author_name['username'].'</td>';
    echo '<td>'.$row['date'].'</td>';
    echo '<td>'.$row['topic'].'</td>';
      if(strcasecmp($row['status'],"Y") == 0) {       
      $sts="Completed";
      }else{
        $sts="Pending";
      }
    echo '<td>'.$sts.'</td>';
    echo '<td>'.number_format($row2['overallRating'],1).'</td>'; //this will throw a warning when data is not there. (when testing phpmyadmin only)
    
    //this will retrieve the report from the folder in the database.
    echo '<td><form name="rep_gen" action="report.php" method="POST" >
    <input type="hidden" name="h_ppid" value='.$ppId.'>
    <input type="submit" name="gen_report" value="Generate Report"></form></td>';

    echo '<td><form name="paper_action"  action="admin_action.php" method="POST">

      <input type="hidden" name="h_ppid" value='.$ppId.'>
      <input type="submit" name="s_action" value="delete">
      
      </form></td>  </tr>';
    }
	?>


  </table>
    
  </main>
   <div class="footer">
    <footer><b><br>Contact us ---- +1 813-666-666 ---- r.astley@usf.com</footer>
  </div>  
</div>