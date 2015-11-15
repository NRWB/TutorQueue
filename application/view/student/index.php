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

    <!-- my account -->
    <ul class="navigation right">

      <?php if (Session::userIsLoggedIn()) : ?>
        <?php if (Session::get("user_account_type") != 1) : ?>
          <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
          </li>
        <?php endif; ?>
      <?php endif; ?>
    </ul>

    <?php if (Session::userIsLoggedIn()) { ?>
      <div class="panel panel-header">
        Logged in as: <?php echo Session::get("user_name"); ?>, Table Number = <?php echo Session::get("table_number"); ?>
      </div>
    <?php } ?>

    <!--
    =========================== End of Header ======================
    -->

    <!--
    =========================== Start of Body ======================
    -->

    <div class="container">
      <h1>Student View</h1>
      <div class="box">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <div class="text-center">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">

                <div class="panel-heading">Create a Requests Panel</div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel panel-default">

                      <div class="panel-body">
                        <div class="table-responsive">

                           <form method="post" onsubmit="return verifySubmit();" action="<?php echo Config::get('URL'); ?>HelpRequest/create">

                           <input type="hidden" name="hidden_tbl_num" value="<?php echo Session::get('table_number'); ?>">

                           <table class="table table-bordered table-hover">

                            <tr>
                              <td>Subject (Required)</td>
                              <td>
                                <select id="subj_DD_ID" name="subj_DD" required>

                                  <option selected="selected"></option>

                                  <!-- this PHP will initially populate the DropDown when the page loads. -->
                                  <?php foreach (StudentModel::getSubjects() as $subj) { ?>
                                    <option value="<?= $subj->name; ?>"><?= $subj->name; ?></option>
                                  <?php } ?>

                                </select>
                              </td>
                            </tr>

                            <tr>
                              <td>Sub-Subject (Optional)</td>
                              <td>
                                <select id="sub_subj_DD_ID" name="sub_subj_DD">
                                  <option selected="selected"></option>
                                </select>
                              </td>
                            </tr>

                            <tr>
                              <td>Tutor (Optional)</td>
                              <td>
                                <select id="req_tutor_DD_ID" name="req_tutor_DD">
                                  <option selected="selected"></option>
                                </select>
                              </td>
                            </tr>

                            <tr align="center">
                              <td colspan="2">
                                <input id="student_submit" type="submit" value="submit">
                              </td>
                            </tr>

                          </table>

                          </form>


                        </div> <!-- End "table-responsive" -->
                      </div> <!-- End "panel-body" -->

                      <div align="right">
                        <div class="panel-body">
                          <div class="col-xs-12">Enter Tutor Code:</div>
                          <div class="col-xs-4 col-xs-offset-8"><input type="text" class="form-control" id="tutorcode"></div>
                          <div class="col-xs-12"><button type="button" class="btn btn-default">Enter Tutor Portal</button></div>
                        </div>
                      </div>

                    </div> <!-- end "panel panel-default" -->
                  </div> <!-- end "col-lg-12" -->
                </div> <!-- end "row" -->

              </div> <!-- end "panel panel-default" -->
            </div> <!-- end "col-lg-12" -->
          </div> <!-- end "row" -->
        </div> <!-- end "text-center" -->

      </div> <!-- end "box" -->
    </div> <!-- end "container" -->

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

<script type="text/javascript">

  function verifySubject() {
    if (document.getElementById("subj_DD_ID").selectedIndex == 0) {
      alert("Please select a valid subject.");
      return false;
    } else {
      return true;
    }
  }

  function updateDD() {

    document.getElementById("sub_subj_DD").options.length = 0;

    var doc = document.getElementById("subj_DD_ID");

    var idNo = parseInt(doc.selectedIndex);

    console.log(idNo);
  }
</script>

<!--
    <?php foreach (StudentModel::getSubSubjects($idNo) as $ss) { ?>
      var opt = document.createElement("option");
      document.getElementById("sub_subj_DD").appendChild(opt);
    <?php } ?>
-->

</body>
</html>
