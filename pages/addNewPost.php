<?php
include '../masterpages/head.php';
?>
    <title>Add New Post</title>
  <?php
  include '../masterpages/loggedInHeader.php';
  ?>

  <main class="addNewPost-main">
    <?php
    include '../masterpages/dashboard01.php';
    ?>
    <!-- should change action -->
    <form class="addNewPost-form" method="POST" action="#" enctype="multipart/form-data">
      <label for="postImg">Image</label>
      <article class="addNewPost-article">
        <input type="file" name="profImg" accept="image/*" required>
      </article>
      <label for="title">Title</label>
      <input type="text" name="title">
      <label for="content">Content</label>
      <textarea name="content"></textarea>
      <div class="addNewPost-btn">
        <button type="submit">Save</button>
      </div>
    </form>
    <?php
    include '../masterpages/dashboard02.php';
    ?>

    <?php
    include '../masterpages/footer.php';
    ?>