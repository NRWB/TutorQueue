<!doctype html>
<html>
<head>
  <title>QSC Tutor Queue</title>
  <meta charset="utf-8">
  <!-- send empty favicon fallback to prevent user's browser hitting the server for lots of favicon requests resulting in 404s -->
  <link rel="icon" href="data:;base64,=">

  <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
  <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/bootstrap.min.css" />

  <script src="<?php echo Config::get('URL'); ?>js/jquery-latest.min.js"></script>
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

    <!-- my account -->
    <ul class="navigation right">

      <?php if (Session::userIsLoggedIn()) : ?>
        <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
        </li>

      <?php endif; ?>
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
      <h1>Edit Accounts</h1>

      <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

          <div class="text-center">
            <div class="panel panel-default">
              <div class="row">
                <div class="col-lg-12">

                  <div>
                    <table class="overview-table">
                      <thead>
                        <tr>
                          <td>Id</td>
                          <td>Username</td>
                          <td>Password</td>
                          <td>Delete</td>
                          <td>Submit</td>
                        </tr>
                      </thead>

                      <?php foreach ($this->users as $user) { ?>
                        <tr>
                          <td>
                            <?= $user->user_id; ?>
                          </td>
                          <td>
							<?= $user->user_name; ?>
                          </td>
                          <td>
							<a href="<?= config::get("URL"); ?>login/changePassword"><u>Change Password</u></a>
						  </td>
                          <form action="<?= config::get("URL"); ?>admin/actionAccountSettings" method="post">
							<td>
							  <input type="checkbox" name="softDelete" />
							</td>
							<td>
							  <input type="hidden" name="user_id" value="<?= $user->user_id; ?>" />
							  <input type="submit" />
							</td>
						  </form>
                        </tr>
					  <?php } ?>
					  
                    </table>
                  </div> <!-- End of Empty Div -->
                </div> <!-- End of col-lg-12 -->
              </div> <!-- End of row -->
            </div> <!-- End of Panel panel-default -->
          </div> <!-- End of Text Center -->

          <div>
            <form action="<?= config::get("URL"); ?>login/register" method="post">
              <input type="submit" value="Add Account" />
            </form>
          </div>


        </div> <!-- End of box -->
      </div> <!-- End of container -->

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
