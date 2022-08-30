<!-- if you use $_SERVER['php_self] ,this means index.php(file where you include this file)-->
<form action="<?php $requrl;?>">
<!-- this $requrl is just variable, so you don't need echo-->
  <div class="form-floating mb-3">
    <input
      type="text"
      class="form-control" name="Label" id="Label" placeholder="">
    <label for="floatingLabel">Name</label>
  </div>
  <div class="form-floating mb-3">
    <input
      type="text"
      class="form-control" name="Label" id="Label" placeholder="">
    <label for="floatingLabel">Name</label>
  </div>
  
  <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $username = 
    }
  ?>
</form>