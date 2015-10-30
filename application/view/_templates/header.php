<!doctype html>
<html>
<head>
  <title>QSC Electronic Tutor Queue</title>
  <!-- META -->
  <meta charset="utf-8">
  <!-- send empty favicon fallback to prevent user's browser hitting the server for lots of favicon requests resulting in 404s -->
  <link rel="icon" href="data:;base64,=">
  <!-- CSS -->
  <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
</head>
<body>

  <!-- wrapper, to center website -->
  <div class="wrapper">

    <!-- navigation -->
    <ul class="navigation">

      <?php if (Session::userIsLoggedIn()) { ?>
        <?php if (Session::get("user_account_type") == 7) : ?>
          <li <?php if (View::checkForActiveController($filename, "greeter")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>greeter/index">Index/Home</a>
          </li>
        <?php endif; ?>
      <?php } else { ?>
        <!-- for not logged in users -->
        <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
        </li>
      <?php } ?>

    </ul>

    <!-- my account -->
    <ul class="navigation right">
      <?php if (Session::userIsLoggedIn()) : ?>
        <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
        </li>
      <?php if (Session::get("user_account_type") == 7) : ?>
        <li <?php if (View::checkForActiveController($filename, "admin")) {
          echo ' class="active" ';
        } ?> >
        <a href="<?php echo Config::get('URL'); ?>admin/">Admin</a>
          <ul class="navigation-submenu">
            <li <?php if (View::checkForActiveController($filename, "note")) { echo ' class="active" '; } ?> >
              <a href="<?php echo Config::get('URL'); ?>note/index">My Notes</a>
            </li>
          </ul>
        </li>
      <?php endif; ?>
    <?php endif; ?>
  </ul>
