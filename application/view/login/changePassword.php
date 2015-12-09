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
  <h1>Set new Password</h1>

  <!-- echo out the system feedback (error and success messages) -->
  <?php $this->renderFeedbackMessages(); ?>

  <div class="box">

    <!-- new password form box -->
    <form method="post" action="<?php echo Config::get('URL'); ?>login/changePassword_action" name="new_password_form">

      <label for="change_input_password_current">
        Enter Current Password:
      </label>
      <p>
        <input id="change_input_password_current" class="reset_input" type='password'
               name='user_password_current' pattern=".{6,}" required autocomplete="off" />
      </p>

      <label for="change_input_password_new">
        New password
      </label>

<!--        <span class="glyphicon glyphicon-info-sign"
          <a href="#" data-toggle="tooltip" title="(min. 6 characters, case sensitive)">
          </a>
        </span>
-->
        <br>
        (min. 6 characters, case sensitive,
        <br>
        special characters supported)
      <p>
        <input id="change_input_password_new" class="reset_input" type="password"
               name="user_password_new" pattern=".{6,}" required autocomplete="off" />
      </p>

      <label for="change_input_password_repeat">
        Repeat new password
      </label>
      <p>
        <input id="change_input_password_repeat" class="reset_input" type="password"
               name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
      </p>

      <input type="submit" name="submit_new_password" value="Submit new password" />

    </form>
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
