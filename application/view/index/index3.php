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

<!--
http://stackoverflow.com/questions/5052543/how-to-fire-ajax-request-periodically
http://stackoverflow.com/questions/25446628/ajax-jquery-refresh-div-every-5-seconds
-->
<?php echo "
<script>

// $(document).ready(function() {

/*
  function loadlnk() {
    $('#tableHolder').load('<?php echo config::get('URL'); ?>index/updateTable', function() { $(this).unwrap(); } );
  }

  loadlnk();

  setInterval(function() { loadlnk() }, 3000);
*/

  function loadlnk() {
//    $('#tableHolder').load('<?php echo config::get('URL'); ?>index/updateTable');
    document.getElementById('tableHolder').innerHTML = '<object type='text/html' data='<?php echo config::get('URL'); ?>index/updateTable'></object>';
    setTimeout(loadlnk, 3000);
  }

  loadlnk();

//});

</script>
"; ?>
