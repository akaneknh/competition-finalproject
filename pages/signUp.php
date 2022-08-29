<?php
include '../masterpages/head.php';
?>
<title>Sign Up</title>

<?php
include '../masterpages/logOutHeader.php';
?>

  <main class="signUp-main">
    <h1>Sign up</h1>
    <!-- should change inside of action -->
 <!-- should change inside of action -->
 <form class="accountSetting-form" method="POST" action="#" enctype="multipart/form-data">
    <h5>
      <div class="required">*</div>
      is required
    </h5>
    <section class="accountSetting-section">
      <div class="accoutSetting-name">
        <aside>
          <label for="fname">First Name <div class="required">*</div></label>
          <input type="text" name="fname">
        </aside>
        <aside>
          <label for="lname">Last Name<div class="required">*</div></label>
          <input type="text" name="lname">
        </aside>
      </div>
    </section>
    <section  class="accountSetting-section">
    <label for="atype">Select your account type<div class="required">*</div></label>
    <select name="atype">
      <option selected disabled></option>
      <option>Landord</option>
      <option>Student</option>
    </select>
    </section>
    <section  class="accountSetting-section">
    <label for="bdate">Date of birth<div class="required">*</div></label>
    <input type="date" name="bdate">
    </section>
    <section  class="accountSetting-section">
    <label for="email">Email<div class="required">*</div>
   </label>
    <input type="email" name="email" placeholder="example@woodhousing.com">
    </section>
    <!-- should change pass and confirm -->
    <section  class="accountSetting-section">
    <label for="pass">Password<div class="required">*</div></label>
    <input type="password" name="pass">
    </section>
    <section  class="accountSetting-section">
    <label for="confirm">Password confirm<div class="required">*</div></label>
    <input type="password" name="confirm">
    </section>

    <section class="accountSettoing-pic">
      <!-- test for accepting img -->
      <!-- required makes this input mandatory -->
      <label for="profImg">
        Profile Picture
        <div class="required">*</div>
      </label>
      <article>
        <input type="file" name="profImg" accept="image/*" required>
      </article>
      <label for="refImg">
        References(email confirmed
        <div class="required">*</div>
      </label>

      <article>
        <input type="file" name="refImg" accept="image/*" required>
      </article>

      <label for="tamImg">
        References(from Tamwood)
        <div class="required">*</div>
      </label>

      <article>
        <input type="file" name="tamImg" accept="image/*">
      </article>

    </section>
    <section class="signUp-btn-wrap">
      <button class="signUp-btn" type="submit">Sign Up</button>
    </section> 
    
    
  </form>
  <div class="moveToLogin">
    <a href="./logIn.php">Do you have an account?</a>
  </div>
 <!-- FOOTER -->
 <?php
  include '../masterpages/footer.php';
  ?>