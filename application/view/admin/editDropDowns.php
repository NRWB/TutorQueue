<div class="container">
  <h1>Add/Remove Drop Down Elements</h1>

  <div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div>

<div class="text-center">
<div class="panel panel-default">
<div class="row">
<div class="col-lg-12">
      <table class="overview-table">
        <thead>
          <tr>
            <td>
              Notes-Quick Reason
            </td>
            <td>
              Remove?
            </td>
          </tr>
        </thead>
        <?php foreach ($this->quicknotes as $note) { ?>
          <tr>
            <td><?= $note->qNoteReason; ?></td>
            <td><input type="checkbox">
          </tr>
        <?php } ?>
      </table>
      <form class="navbar-form navbar-left" method="post" action="">
        <button type="submit" class="btn btn-default">Remove Selected</button>
      </form>
</div>
</div>
</div>
</div>


      <form class="navbar-form navbar-left" method="post" action="">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Add Item...">
        </div>
        <button type="submit" class="btn btn-default">Add</button>
      </form>

    </div>

  </div>
</div>
