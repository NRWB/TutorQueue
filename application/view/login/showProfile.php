<div class="container">
  <h1>
    Login Redirect Controller -> Direct to default show profile
  </h1>

  <div class="box">

    <h2>
      Your profile
    </h2>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

      If stuck on this page for several seconds, click a navigation button at the top of the page.

      <div id="redirectToPage"></div>

      <script>
        var accLvl = <?= $this->user_account_type; ?>;
        var currTblNo = parseInt(<?php echo Session::get('table_number')[0]; ?>);
        console.log('C T N = ' + currTblNo);
        var dispTxt;
        switch (accLvl) {
          case 1:
            if (currTblNo < 0) {
              window.location.replace("<?php echo Config::get('URL'); ?>student/tableSetup");
              console.log('error, no table number setup, going to redirect to setup a table number for the stuent session');
            } else {
              window.location.replace("<?php echo Config::get('URL'); ?>student/index");
              console.log('success, there is already a table number setup.');
            }
            break;
          case 3:
            document.getElementById("redirectToPage").innerHTML = "Redirecting to greeter view";
            window.location.replace("<?php echo Config::get('URL'); ?>greeter/index");
            break;
          case 7:
            document.getElementById("redirectToPage").innerHTML = "Redirecting to admin view";
            window.location.replace("<?php echo Config::get('URL'); ?>admin/index");
            break;
        }
      </script>

  </div>
</div>
