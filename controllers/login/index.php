<?php
	$PAGE_VAR["css"][] = "login";
	$PAGE_VAR["js"][] = "login";
  $theme = "admin";

  // print_r($_POST);
//username check
// if(empty($_POST['name'])) {
//   die("please fill username");
// }

// //password check
// if(empty($_POST['password'])) {
//   die("please fill password");
// } elseif(strlen($_POST['password']) < 5 ) {
//   die("password must have more than 5 charactors");
// }

//password hash
// $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

// print_r($_POST);
// var_dump($password_hash)

// echo "<script> alert('Login success') </script>";
// header('Refresh:0; url=../admindashbroad/');
?>

<!-- 
<div id="user" style="height: 100px;"></div>
<div style="height: 100vh;" class="container d-flex justify-content-center align-items-center">
  <div class="container position-absolute top-0 start-0 mt-5 ms-5">
    <button onclick="backToHome()" class="btn btn-secondary">HOME</button>
  </div>
  <form action="" method="post" id="fromLogin" class="bg-light p-5 rounded border border-2">
  <h3 class="text-center">ADMIN LOGIN</h3>
  <div class="mb-3 mt-4">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" name="username" id="username" >
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button  type="submit" onclick="login()" class="btn btn-secondary">Login</button>
  <!-- <button id="submitButton" class="btn btn-secondary">Login</button> -->
</form>
</div> -->