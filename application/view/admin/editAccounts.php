<div class="container">
  <h1>Add/Remove Accounts</h1>

  <div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div>
      <form action="<?= config::get("URL"); ?>login/register" method="post">
        <input type="submit" value="Add Account" />
      </form>
    </div>
    <div>
      <table class="overview-table">
        <thead>
        <tr>
          <td>Id</td>
          <td>Username</td>
          <td>User's email</td>
          <td>Activated ?</td>
          <td>Soft delete</td>
          <td>Submit</td>
        </tr>
        </thead>
        <?php foreach ($this->users as $user) { ?>
          <tr class="<?= ($user->user_active == 0 ? 'inactive' : 'active'); ?>">
            <td><?= $user->user_id; ?></td>
            <td><?= $user->user_name; ?></td>
            <td><?= $user->user_email; ?></td>
            <td><?= ($user->user_active == 0 ? 'No' : 'Yes'); ?></td>
            <form action="<?= config::get("URL"); ?>admin/actionAccountSettings" method="post">
              <td><input type="checkbox" name="softDelete" <?php if ($user->user_deleted) { ?> checked <?php } ?> /></td>
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
