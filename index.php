<?php session_start(); ?>
<?php include 'header.php'; ?>
<style type="text/css">
.login-logo{
font-weight: bolder;
 border-bottom-left-radius:10px;
  border-top-left-radius:10px;
 font-size: 12px;
  margin-left: 60%;
    background-color:#78e83259;
}.login-logo #date{
  font-size:12px;
  background-color:#78e83259;
}.login-header{
  margin-top: 20%;
  background-color: white;
  line-height:40px;
  margin-bottom: -15px;
  color: green;
  font-weight: bolder;
  border-bottom: 3px dashed  #78e83259;
}.login-logos{
/*  border-bottom-right-radius: 10px;
  border-top-right-radius:10px;*/
 font-size: 20px;
  margin-right: 40%;
  font-weight: bolder;
 background-color:#78e83259;
}.login-logos .login-box-msg{
  font-weight: bolder;
   background-color:#78e83259;
   text-align: center;
   margin-top: 10px;
}.btn-primarys{
  background-color:  #70e60f80;
  font-weight: bolder;
  color: green;
} .has-feedback input  {
  border: 1px  solid #8dce314f !important;
}.has-feedback input:focus{
  border: 3px  solid #8dce314f !important;
}


</style>
<body class="hold-transition login-page">
<div class="login-box">
               <br>
  <div class="login-header">
     <div class="login-logos">
     <h4 class="login-box-msg">Welcome&nbsp;back&nbsp;</h4>
    </div>
 
    <div class="login-logo">
      <p id="date"></p>
      <p id="time" class="bold"></p>
    </div>
   </div>
    <div class="login-box-body">
      
<form action="login.php" method="POST">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="input Username" required autofocus>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="input Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
          <div class="col-xs-4">
                <button type="submit" class="btn btn-primarys btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
            </div>
          </div>
      </form>
    </div>
    <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
    <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>

    <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }

        if(isset($_GET['error'])){
          echo 
          "<div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>

           login is required please
            </div>
          ";}

           if(isset($_GET['lgts'])){
          echo "
      <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
           Logout successful,  thank for your session
            </div>
          "; }
      ?>
     
</div>
  
<?php include 'scripts.php' ?>

</body>
</html>