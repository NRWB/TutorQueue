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
            dispTxt = "Student Lvl 1";
            break;
          case 7:
            document.getElementById("redirectToPage").innerHTML = "Redirecting to admin view";
            window.location.replace("../");
            break;
        }
        </script>
    </div>
</div>
