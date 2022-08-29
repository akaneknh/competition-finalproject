<?php include '../masterpages/head.php' ?>

<title>Your Profile</title>
<?php include '../masterpages/loggedInHeader.php' ?>


  <main class="yourProfile-main">
    <?php include '../masterpages/dashboard01.php' ?>
    <form class="yourProfile-form" method="POST" action="#" enctype="multipart/form-data">
      <label for="postImg">Profile image</label>
      <article class="yourProfile-article">
      <input type="file" name="profImg" accept="image/*" required>
      </article>
      <label for="content">Content</label>
      <textarea class="yourProfile-textarea" name="content"></textarea>
      <div class="yourProfile-btn">
        <button type="submit">Save</button>
      </div>
    </form>
    <?php include '../masterpages/dashboard02.php' ?>
    <?php include '../masterpages/footer.php' ?>