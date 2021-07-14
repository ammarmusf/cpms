<?php
//this script will retrieve the password when given the username and phone number attached to them.
  include("config.php");
    session_start();
    $pwd="";
    if($_SERVER["REQUEST_METHOD"] == "POST") {


    $uname=mysqli_real_escape_string($db,$_POST['l_uname']);
    $phoneno=mysqli_real_escape_string($db,$_POST['l_phno']);
    
    $sql="select password from users where username in (select username from author where username='$uname' and Phone_Number= '$phoneno')";
    $sql2="select password from users where username in (select username from reviewer where username='$uname' and Phone_Number= '$phoneno')";

      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows($result);
      
      $result2 = mysqli_query($db,$sql2);
      $count2 = mysqli_num_rows($result2);
      
      //if the data inserted by the user was valid, it will give out the password linked to the username and phone number provided.
      if($count == 1 || $count2 == 1 ){
          
          if($count ==1){
              $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
              $pwd= "Password is: ". $row['password'];
          }else{
              $row = mysqli_fetch_array($result2,MYSQLI_ASSOC);
              $pwd= "Password is: ". $row['password'];
          }
          
      }else{
          $pwd="INVALID USER and Phone Number";
      }
  }
?>
 
<div class="container">   
  <!DOCTYPE html 
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
      background: linear-gradient(90deg, rgba(1,1,1,1) 5%, rgb(119, 93, 139) 81%, rgb(150, 96, 165) 100%);
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
        h2 {
      color: #FF0000;
      }
      underline {
      text-decoration: underline;
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
      legendstyle {
      font-size: 2rem;
      line-height: 1.5;
      color: #fbfbfb;
      }

      form2 {
      font-size: 1.2rem;
      line-height: 0.5;
      color: #fbfbfb;
      }
      .button { 
      height: 25px; 
      width: 75px; 
      }
      forgotpass {
      color: #f6d84e 
      }
    </style>
  </head>

  <header>
    <h1>CCSC - Consortium for Computing Sciences</h1>
  </header>

  <main>
      <fieldset>
          <legend><legendstyle>Forgot Password</legendstyle></legend>
                <form action = "" method = "post">
        <table>
                  <tr>
                    <td><label for="username"><form2>Enter Username :</form2></label></td>
                    <td><input id="Username1" placeholder="Username" type="text" name="l_uname" required/></td>
                  </tr>
                  <tr>
                    <td><label for="username"><form2>Enter registered phone number :</form2></label></td>
                    <td><input placeholder="Phone number" type="text" name="l_phno" required/></td>
                  </tr>
                  <tr>
                    <td><input type="submit" class="button" value="Submit" /></td>
                  </tr>
                  <tr>
                      <td>  <a href="logout.php">Login Page</a> </td>
                  </tr>
                  <tr>
                  <td>  <form2>  <?php echo $pwd ?></form2></td>
                  </tr>
              </table> 
        </form>
      </fieldset> <br><br><br> 
  </html> 
</div>