<?php
   include("config.php");
   session_start();
?>


<div class="container">    
  <head>
    <!-- Below is styling -->
    <style>
      .container {
      background: linear-gradient(90deg, rgba(1,1,1,1) 5%, rgba(199,147,241,1) 81%, rgba(180,124,195,1) 100%);
      }
      body {
      background-color: #bfc4ff;
      font-family: Lato, sans-serif;
      height: 100%;
      margin: 0;
      background-repeat: no-repeat;
      background-attachment: fixed;
      }


      header {
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #bfc4ef;
      box-sizing: border-box;
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;

      font-family: Poppins, sans-serif;
      color: #222;
      }
      h2 {
      font-size: 2rem;
      color: #fbfbfb;
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
      form2{
        color: blue;
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
    color: #dddddd;
    font-weight: bold;
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
    }
    
    th{
      font-size: 20px;
      background-color: #222;
    }
   
    tr:nth-child(odd) {
    background-color: #3E3E3E;
    }
    tr:nth-child(even) {
    background-color: #999999;
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
    //this script will check the roles of the users to determine what to show on the tool bar.
    $role=$_SESSION['role'] ;
    //if author, it will show submit paper tab.
    if(strcasecmp($role,"author") == 0) {       
        echo "<li><a href=paper_submission_form.php>Submit Paper</a></li>";
    }
      //if admin, it will show manage submission tab.
      if(strcasecmp($role,"admin") == 0) {       
        echo "<li><a href=generate_report.php> Manage Submission </a></li>";
    }
      //if admin it will show admin reports tab.
      if(strcasecmp($role,"admin") == 0) {       
        echo "<li><a href=admin_reports.php> Admin reports </a></li>";
    }
      //if not admin, it will show profile tab.
      if(!strcasecmp($role,"admin") == 0) {       
        echo "<li><a href=Profile.php> Profile </a></li>";
    }
    ?>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
   
  </header>
  
  
<br><br><br><br><br><br><br><br>

<?php
  //this will show all the authors that have signed up to the system.
  echo '<h2>Authors:</h2><br>';
    $sql="select * from author";
    $result = mysqli_query($db,$sql);
    $all_property = array();  

  //creating the table that will display all the information
  echo '<table class="data-table">
          <tr class="data-heading">';  
  while ($property = mysqli_fetch_field($result)) {
      echo '<th>' . $property->name . '</th>'; 
      array_push($all_property, $property->name); 
  }
  echo '</tr>'; 

  //inserting the data from database that will go in the table.
  while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      foreach ($all_property as $item) {
          echo '<td>' . $row[$item] . '</td>'; 
      }
      echo '</tr>';
  }
  echo "</table>";
?>

<?php
  //this will show all the reviewers that have signed up to the system.
  echo '<br><br><br><h2>Reviewers:</h2><br>';
    $sql="select * from reviewer";
    $result = mysqli_query($db,$sql);
    
    $all_property = array();  

  //creating the table that will display all the information
  echo '<table class="data-table">
          <tr class="data-heading">';  
  while ($property = mysqli_fetch_field($result)) {
      echo '<th>' . $property->name . '</th>'; 
      array_push($all_property, $property->name); 
  }
  echo '</tr>'; 

  //inserting the data from database that will go in the table.
  while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      foreach ($all_property as $item) {
          echo '<td>' . $row[$item] . '</td>'; 
      }
      echo '</tr>';
  }
  echo "</table>";
?>

<?php
  //this will show all the users that have signed up to the system.
  echo '<br><br><br><h2>All Users:</h2><br>';
    $sql="select USERNAME,ROLE,STATUS from users";
    $result = mysqli_query($db,$sql);
    
    $all_property = array();  

  //creating the table that will display all the information
  echo '<table class="data-table">
          <tr class="data-heading">';  
  while ($property = mysqli_fetch_field($result)) {
    echo '<th>' . $property->name . '</th>'; 
      array_push($all_property, $property->name); 
  }
  echo '</tr>'; 

  //inserting the data from database that will go in the table.
  while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      foreach ($all_property as $item) {
          echo '<td>' . $row[$item] . '</td>'; 
      }
      echo '</tr>';
  }
  echo "</table>";
?>


<?php
  //this will show all the paperts that have been submitted into the system.
  echo '<br><br><br><h2>All Submitted Paper Report:</h2><br>';
    $sql="select * from Paper";
    $result = mysqli_query($db,$sql);
    
    $all_property = array();  

  //creating the table that will display all the information
  echo '<table class="data-table">
          <tr class="data-heading">';  
  while ($property = mysqli_fetch_field($result)) {
    echo '<th>' . $property->name . '</th>'; 
      array_push($all_property, $property->name); 
  }
  echo '</tr>'; 

  //inserting the data from database that will go in the table.
  while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      foreach ($all_property as $item) {
          echo '<td>' . $row[$item] . '</td>'; 
      }
      echo '</tr>';
  }
  echo "</table>";
?>

  </main>
     <div class="footer">
    <footer><b><br>Contact us ---- +1 813-666-666 ---- r.astley@usf.com</footer> 
      
</div>