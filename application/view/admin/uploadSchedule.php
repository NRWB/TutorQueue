<div class="container">
  <h1>Upload Quarterly Tutor Shift Schedule</h1>

  <div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div>

      <form>
        <input type="text" id="uploadPath">
        <input type="submit" id="uploadBtn">
      </form>

    </div>

    <div>
      View a template example of the expected excel format: <a href="<?php echo Config::get('URL'); ?>ScheduleTestFile.xlsm"><b>here</b></a>.
    </div>

  </div>
</div>
