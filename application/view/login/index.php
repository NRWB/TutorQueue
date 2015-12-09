<!doctype html>
<html>
<head>
  <title>QSC Tutor Queue</title>
  <meta charset="utf-8">
  <!-- send empty favicon fallback to prevent user's browser hitting the server for lots of favicon requests resulting in 404s -->
  <link rel="icon" href="data:;base64,=">

  <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
  <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/bootstrap.min.css" />

  <script src="<?php echo Config::get('URL'); ?>js/jquery-latest.min.js"></script> <!--  <script src="<?php echo Config::get('URL'); ?>js/jquery-1.11.3.min.js"></script> -->
  <script src="<?php echo Config::get('URL'); ?>js/bootstrap.min.js"></script>
</head>
<body>

  <!-- wrapper, to center website -->
  <div class="wrapper">

    <!-- navigation -->
    <ul class="navigation">

      <?php if (Session::userIsLoggedIn()) { ?>

        <!-- Admins -->
        <?php if (Session::get("user_account_type") == 7) : ?>
          <li <?php if (View::checkForActiveController($filename, "admin")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>admin/index">Admin Home</a>
          </li>
          <li <?php if (View::checkForActiveController($filename, "greeter")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>greeter/index">Greeter Home</a>
          </li>
          <li <?php if (View::checkForActiveController($filename, "student")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>student/index">Student Home</a>
          </li>
        <?php endif; ?>

        <!-- Greeters -->
        <?php if (Session::get("user_account_type") == 3) : ?>
          <li <?php if (View::checkForActiveController($filename, "greeter")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>greeter/index">Greeter Home</a>
          </li>
        <?php endif; ?>

        <!-- Students -->
        <!-- Should not have header shown as students stay on one page and do not need to log in or out -->

      <?php } else { ?>

        <!-- for not logged in users -->
        <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
        </li>

      <?php } ?>

    </ul>

    <?php if (Session::userIsLoggedIn()) { ?>
      <div class="panel panel-header">
<!--        Logged in as: <?php echo Session::get("user_name"); ?>, Table Number = <?php echo Session::get("table_number"); ?> -->
        Logged in as: <?php echo Session::get("user_name"); ?>, Table Number =
        <?php
          $val = Session::get("table_number");
          if (gettype($val) == "integer") {
            echo Session::get("table_number");
          } else if (gettype($val) == "array") {
            echo Session::get("table_number")[0];
          }
        ?>
      </div>
    <?php } ?>


<div class="container">
  <!-- echo out the system feedback (error and success messages) -->
  <?php $this->renderFeedbackMessages(); ?>
  <div class="login-page-box">
    <div class="table-wrapper">
      <!-- login box on left side -->
      <div class="login-box">
        <h2>Login</h2>
        <form action="<?php echo Config::get('URL'); ?>login/login" method="post">
          <input type="text" name="user_name" placeholder="Username or email" required />
          <input type="password" name="user_password" placeholder="Password" required />
            <!--
              when a user navigates to a page that's only accessible for logged a logged-in user, then
              the user is sent to this page here, also having the page he/she came from in the URL parameter
              (have a look). This "where did you came from" value is put into this form to sent the user back
              there after being logged in successfully. Simple but powerful feature, big thanks to @tysonlist.
            -->
            <?php if (!empty($this->redirect)) { ?>
              <input type="hidden" name="redirect" value="<?php echo $this->redirect ?>" />
            <?php } ?>
          <!--
            set CSRF token in login form, although sending fake login requests mightn't be interesting gap here.
            If you want to get deeper, check these answers:
              1. natevw's http://stackoverflow.com/questions/6412813/do-login-forms-need-tokens-against-csrf-attacks?rq=1
              2. http://stackoverflow.com/questions/15602473/is-csrf-protection-necessary-on-a-sign-up-form?lq=1
              3. http://stackoverflow.com/questions/13667437/how-to-add-csrf-token-to-login-form?lq=1
          -->
          <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>" />
          <input type="submit" class="login-submit-button" value="Log in"/>
        </form>
      </div>
    </div>
  </div>
</div>


  <div class="container">
    <p style="display: block; font-size: 11px; color: #999;">
      <div class="footer" align="center">
        <a href="http://www.washington.edu/"><img src="https://www.washington.edu/home/graphics/blockw.gif" width="53" height="37" alt="UW Logo"></a>
        <br>
        <a href="http://www.bothell.washington.edu/qsc">Contact QSC</a>
      </div>
    </p>
  </div>

  </div><!-- close class="wrapper" -->

</body>
</html>
