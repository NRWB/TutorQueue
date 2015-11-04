<div class="container">
  <h1>Edit Accounts</h1>

  <div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>


<div class="text-center">
<div class="panel panel-default">
<div class="row">
<div class="col-lg-12">

    <div>
      <table class="overview-table">
        <thead>
        <tr>
          <td>Id</td>
          <td>Username</td>
          <td>Password</td>
          <td>Delete</td>
          <td>Submit</td>
        </tr>
        </thead>
        <?php foreach ($this->users as $user) { ?>
          <tr>
            <td><?= $user->user_id; ?></td>
            <td><?= $user->user_name; ?></td>
            <td><a href="<?= config::get("URL"); ?>login/changePassword"><u>Change Password</u></a></td>
            <form action="<?= config::get("URL"); ?>admin/actionAccountSettings" method="post">
              <td><input type="checkbox" name="softDelete" /></td>
              <td>
                <input type="hidden" name="user_id" value="<?= $user->user_id; ?>" />
                <input type="submit" />
              </td>
            </form>
          </tr>
        <?php } ?>
      </table>
    </div>

</div>
</div>
</div>
</div>

    <div>
      <form action="<?= config::get("URL"); ?>login/register" method="post">
        <input type="submit" value="Add Account" />
      </form>
    </div>


  </div>
</div>
