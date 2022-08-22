<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Setting</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./css/accountSetting.css">
</head>
<body>
  <header></header>
  <main>

<!-- should change inside of action -->
    <form method="POST" action="#" enctype="multipart/form-data">
      <h5><div>*</div>is required</h5>
      <section class="name">
        <aside>
          <label for="fname">First Name <div>*</div></label>
          <input type="text" name="fname">
        </aside>
        <aside>
          <label for="lname">Last Name<div>*</div></label>
        <input type="text" name="lname">
        </aside>
      </section>
      <label for="atype">Select your account type<div>*</div></label>
      <select name="atype">
        <option selected disabled></option>
        <option>Landord</option>
        <option>Student</option>
      </select>
      <label for="bdate">Date of birth<div>*</div></label>
      <input type="date" name="bdate">
      <label for="email">Email<div>*</div></label>
      <input type="email" name="email" placeholder="example@woodhousing.com">
      <!-- should change pass and confirm -->
      <label for="pass">Password<div>*</div></label>
      <input type="password" name="pass">
      <label for="confirm">Password confirm<div>*</div></label>
      <input type="password" name="confirm">

      <section class="pic">
        <!-- test for accepting img -->
        <!-- required makes this input mandatory -->
        <label for="profImg">Profile Picture<div>*</div></label>
        <article>
          <label for="profImg">select your file<i class="fa-solid fa-file-arrow-up"></i></label>
          <input type="file"  name="profImg" accept="image/*" required>
        </article>
        
        <label for="refImg">References(email confirmed)<div>*</div></label>
        <article>
          <label for="refImg"> select your file<i class="fa-solid fa-file-arrow-up"></i></label>
          <input type="file"  name="refImg" accept="image/*" required>
        </article>
        <label for="tamImg">References(from Tamwood)<div>*</div></label>
        <article>
          <label for="tamImg"> select your file<i class="fa-solid fa-file-arrow-up"></i> </label>
          <input type="file"  name="tamImg" accept="image/*">
        </article>
      </section>
      <section class="button">
        <button type="submit">Sign up</button>
      </section>
    </form>
  </main>
  <footer></footer>
</body>
</html>