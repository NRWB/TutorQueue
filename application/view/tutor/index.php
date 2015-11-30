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
        <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
        </li>

      <?php endif; ?>
    </ul>

    <?php if (Session::userIsLoggedIn()) { ?>
      <div class="panel panel-header">
        Logged in as: <?php echo Session::get("user_name"); ?>
      </div>
    <?php } ?>


    <div class="container">
      <h1>Tutor View</h1>
      <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <div class="panel panel-default">

          <!-- Default panel contents -->
          <div class="panel-heading">
            Tutor Panel
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="table-responsive">

                    <form method="post" action="">

                      <table id="table_holder" class="table table-bordered table-hover">
                      </table>

                    </form>

                  </div> <!-- End "table-responsive" -->
                </div> <!-- End "panel-body" -->

                <div align="left">
                  <div class="panel-body">

<!--                    <a id="add_student" href="#" class="btn btn-default" role="button" onclick="alert('hi');"> -->
                    <a id="add_student" class="btn btn-default" role="button">
                      Add Student to Queue
                    </a>

                  </div>
                </div>

                <div align="right">
                  <div class="panel-body">

                    <div class="col-xs-12">
                      Return to student view
                    </div>

                    <div class="col-xs-12">
                      (will time out after 30 seconds)
                    </div>

                    <div class="col-xs-12">
                      <a href="<?php echo Config::get('URL'); ?>tutor/leaveHelpPanel" class="btn btn-default" role="button">
                        Leave Tutor View
                      </a>
                    </div>

                  </div>
                </div>
              </div> <!-- end "panel panel-default" -->
            </div> <!-- end "col-lg-12" -->
          </div> <!-- end "row" -->

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

<script>

  $('#table_holder').load('<?php echo config::get('URL'); ?>tutor/updateTableTutors');

// http://stackoverflow.com/questions/2145012/adding-rows-dynamically-with-jquery
  $(document).ready(function() {
    $("#add_student").click(function() {
//      $('#table_holder tbody>tr:last').clone(true).insertAfter('#table_holder tbody>tr:last');

//      $.post("<?php echo Config::get('URL'); ?>HelpRequest/create", function(){} );
      var formSubjData = {
        hidden_tbl_num: "<?php echo Session::get('table_number'); ?>",
        subj_DD: "CSS (CSS)"
      };

      $.ajax({
        url: "<?php echo Config::get('URL'); ?>HelpRequest/create",
        type: "POST",
        data: formSubjData,
        success: function(data, textStatus, jqXHR){},
        error: function (jqXHR, textStatus, errorThrown){}
      });

//      $('#table_holder').load('<?php echo config::get('URL'); ?>tutor/updateTableTutors');
      location.reload();

      return false;
    });
  });

//  $(document).ready(function() {
//    $("input[type='radio']").change(function () {
//    $("input[type='radio']").live('change', function () {
// http://stackoverflow.com/questions/19199767/jquery-radio-button-submit-value-onclick
    $(document).on('change', 'input[type="radio"]', function() {

      var selection=$(this).val();

      var selName=$(this)[0].name;

      var formSubjData = {
        name_entry: selName,
        progress_state: selection
      };

      $.ajax({
        url: "<?php echo Config::get('URL'); ?>HelpRequest/update",
        type: "POST",
        data: formSubjData,
        success: function(data, textStatus, jqXHR){},
        error: function (jqXHR, textStatus, errorThrown){ alert(textStatus); }
      });

      alert("State changed to: " + selection);
    });
//  });

</script>

</body>
</html>
