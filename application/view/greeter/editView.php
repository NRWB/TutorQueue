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
        Logged in as: <?php echo Session::get("user_name"); ?>
      </div>
    <?php } ?>


    <div class="container">
      <h1>Greeter View</h1>
      <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <div class="panel panel-default">

          <!-- Default panel contents -->
          <div class="panel-heading">
            Greeter Panel
          </div>

          <table id="table_holder" class="table">
          </table>

        </div>

        <input id="greeter_save_btn_ID" name="greeter_save_btn" type="submit" value="Save Checked/Selected">

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

  var timer = $('#table_holder').load('<?php echo config::get('URL'); ?>greeter/updateTable2');

  $(document).on('change', 'input[type="checkbox"]', function() {
    var selection = $(this).val();
    var selName = $(this)[0].name;
    var isChecked = $(this).prop("checked");
    console.log('selection = ' + selection + ', selName = ' + selName + ', prop is checked? = ' + isChecked);
  });

  $("#greeter_save_btn_ID").on('click', function() {
    $("#table_holder").find("tr").each(function() {

      var ischecked = $(this).find("input:checkbox").is(":checked");

      if (ischecked) {

        properties_ya = {
//          rec_id: $(this).find("input:hidden[name=rec_id]").val()
        };
//        console.log(' => ' + JSON.stringify($(this).find("input:hidden[name=rec_id]").));
//        console.log(' => ' + $(this).find("input:hidden[name=rec_id]") );

        $(this).find("input:text, :hidden").each(function() {
//        console.log($(this));
//        console.log($(this)[0].value + ' ... ' + JSON.stringify( $(this)[0].value ).length );
//        console.log(JSON.stringify($(this)[0].name) + ', ' + JSON.stringify($(this)[0].value));
          properties_ya[$(this)[0].name] = $(this)[0].value;
        });

        console.log('Associative Array = ' + JSON.stringify(properties_ya));

        $.ajax({
          url: "<?php echo Config::get('URL'); ?>greeter/editViewSaver",
          type: "POST",
          data: properties_ya,
          success: function(data, textStatus, jqXHR) { location.reload(); console.log("" + textStatus); },
          error: function (jqXHR, textStatus, errorThrown){ console.log("" + textStatus); }
        });

      }

    });
  });


/*
  $("#greeter_save_btn_ID").on('click', function() {
    $(":checkbox").each(function() {
      var ischecked = $(this).is(":checked");
      if (ischecked) {
        console.log($(this).parent("tr").find('input[type=text]').text());
      }
    });
  });
*/

//  $('#table_holder').find('input:checkbox[id$="is_checked"]').click(function() {
//    var isChecked = $(this).prop("checked");
//    console.log(isChecked);
//  });

</script>

</body>
</html>
