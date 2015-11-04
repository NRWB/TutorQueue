<div class="container">
    <h1>LoginController/showProfile</h1>

    <div class="box">
        <h2>Your profile</h2>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <div id="redirectToPage"></div>
       <script>
        var accLvl = <?= $this->user_account_type; ?>;
        var dispTxt;
        switch (accLvl) {
          case 1:
            document.getElementById("redirectToPage").innerHTML = "Redirecting to student view";
            window.location.replace("<?php echo Config::get('URL'); ?>student/index");
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
