<?php

/**
 * The AdminModel class
 * Handles all data manipulation of the admin part.
 */
class AdminModel {

  public static function setAccountDeletionStatus($softDelete, $userId) {
    $database = DatabaseFactory::getFactory()->getConnection();

    // FYI "on" is what a checkbox delivers by default when submitted.
    if ($softDelete == "on") {
      $delete = 1;
    } else {
      $delete = 0;
    }

    $query = $database->prepare("UPDATE users SET user_deleted = :user_deleted  WHERE user_id = :user_id LIMIT 1");
    $query->execute(array(
      ':user_deleted' => $delete,
      ':user_id' => $userId
    ));

    if ($query->rowCount() == 1) {
      Session::add('feedback_positive', Text::get('FEEDBACK_ACCOUNT_SUSPENSION_DELETION_STATUS'));
      return true;
    }
  }

  public static function getQuickNotes() {
    $database = DatabaseFactory::getFactory()->getConnection();
    $sql = "SELECT * FROM qscQueue.tblTutorQuickNotes";
    return $database->query($sql);
  }
}
