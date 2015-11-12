<div class="container">
  <h1>QSC Tutor Queue</h1>
  <div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="panel panel-default">

     <!-- Default panel contents -->
     <div class="panel-heading">
       Tutor Help Requests Panel
     </div>

     <table class="table">

       <div class="tableHolder">
         <tr><td>Empty.</td></tr>
       </div>

     </table>

    </div>

  </div>
</div>

<!-- http://stackoverflow.com/questions/5052543/how-to-fire-ajax-request-periodically -->
<?php echo "<script>
  function updateRecords() {
    jQuery.ajax({
      url: 'updateRecords.php',
      data: '<?php echo 'Test'; ?>';
      success: function(result) {
        $('#tableHolder').html(result);
      }
      complete: function() {
        // Schedule the next request when the current one's complete
        setTimeout(updateRecords, 3000);
      }
    });
  }

  $(document).ready(function() {
    // run the first time; all subsequent calls will take care of themselves
    alert(\"hi!\");
    setTimeout(updateRecords, 3000);
  });

</script>"; ?>
