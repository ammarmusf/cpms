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
      <!-- styling for for ALL text fields -->
      input{
        display: inline-block;
        margin: 25px;
        width: 200px;
        text-align: left;
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
      .footer {
      left: 0;
      bottom: 0;
      height: 50px;
      width: 100%;
      background-color: #bfc4ff;
      color: #000000;
      text-align: center;
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
      li2 {
      display: inline-block;
      margin: 0 10px;
      font-size: 1rem;
      font-weight: 700;
      text-transform: uppercase;
      color:white;
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
      p3 {
      font-size: 1.2rem;
      line-height: 1.5;
      color: #1167b1;
      }
      login {
      font-size: 2rem;
      line-height: 1.5;
      color: #fbfbfb;
      }
      form {
      font-size: 1.2rem;
      line-height: 2;
      color: #fbfbfb;
      }
      form2 {
      font-size: 1.2rem;
      line-height: 0.5;
      color: #blue;
      }
      .button { 
      height: 25px; 
      width: 75px; 
      } 
      forgotpass {
      color: #f6d84e 
      }
      signup {
      font-size: 2rem;
      line-height: 1;
      color: #fbfbfb;
      }
      ul.a{
      list-style-type: circle;
      }
    </style>
  </head>

   <header>
    <h1>CCSC - Consortium for Computing Sciences</h1>
    <nav>
      <ul>
               <li><a href="Homepage.php">Home</a></li>

<?php  //script that will display the toolbar according to the role of the user.
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
    <p>
      <b>Welcome to the <underline>Conference paper management system</underline> webpage for the <underline>Consortium for Computing Sciences!</underline></b> <br><br>
      
      The Consortium for Computing Sciences in Colleges (CCSC) is a non-profit organization focused on promoting quality computing curricula and the effective use of computing in colleges and universities. The CCSC encourages the sharing of research, effective curricula, teaching expertise, and efficient technological applications in the classroom.
      <br><br>
      The conference paper management system (CPMS) is designed to provide a hastle free, paperless and efficient solution for authors/reviewers to partake in the Consortium for Computing Sciences in Colleges
      
      <br><br><br> You are logged in as <underline><?php echo  $_SESSION['user_name'] ?></underline></b><br><br></p>
 <?php  
 $role=$_SESSION['role'] ;

 //if the user logged in is a reviewer, it will display the submitted papers that are pending review.
  if(strcasecmp($role,"reviewer") == 0) {
	 
    $username = mysqli_real_escape_string($db, $_SESSION['user_name']);
    $sql_rev="select * from reviewer where username='$username' and active='Y'";
    $result = mysqli_query($db,$sql_rev);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    //the papers will be displayed according to the interests that the reviewer has. if they are similar to the author, it will display.
    //then select papers with reviewer interests similar to paper topic to query.
    $int1=mysqli_real_escape_string($db,  $row['interest_1']);
    $int2=mysqli_real_escape_string($db,  $row['interest_2']);
    $int3=mysqli_real_escape_string($db,  $row['interest_3']);
    
    $revid=mysqli_real_escape_string($db,  $row['reviewer_id']);

    $sql=" select * from Paper where topic in ('$int1','$int2','$int3') and status='N'";  
    $result2 = mysqli_query($db,$sql);
    $count = mysqli_num_rows($result2);
    
    echo  '<p2><underline>'.$count.' Papers Pending reviews</underline> :</underline><p2>';
    $cnt=0;
    while($row2 = mysqli_fetch_assoc($result2)) {
      $cnt=$cnt+1;
      
      $flname=mysqli_real_escape_string($db,  $row2['filename']);
      
      $p_id=mysqli_real_escape_string($db,  $row2['paperid']);
      $p_auth=mysqli_real_escape_string($db,  $row2['authorid']);
      $p_tpc=mysqli_real_escape_string($db,  $row2['topic']);
      $p_dte=mysqli_real_escape_string($db,  $row2['date']);
      
      $fltitle=mysqli_real_escape_string($db,  $row2['title']);
      
    echo '<p><p3><underline>Paper '.$cnt.': <a href="Paper_review.php?file='.$flname.'&pid='.$p_id.'&auth='.$p_auth.'&topic='.$p_tpc.'&date='.$p_dte.'&revid='.$revid.' " > '.$fltitle.'</a> <br></p3></p>';
    }
  }
?>
      

</main>      
  <div class="footer">
    <footer><b><br>Contact us ---- +1 813-666-666 ---- r.astley@usf.com</footer>
  </div>    
</div>