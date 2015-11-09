<div class="container">
  <h1>Student View</h1>
  <div class="box">
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="text-center">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">

            <h2>Thank you, your request has been placed successfully.</h2>
            (Returning to the Create a Request Panel in 3 seconds, click <a href="<?php echo Config::get('URL') . 'student' ?>"><b><u>here</u></b></a> if the page does not load automatically)

          </div> <!-- end "panel panel-default" -->
        </div> <!-- end "col-lg-12" -->
      </div> <!-- end "row" -->
    </div> <!-- end "text-center" -->


  </div> <!-- end "box" -->
</div> <!-- end "container" -->
