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

// s=start, e=end
  public static function makeDDRequest($sMon, $sDay, $sYr, $eMon, $eDay, $eYr) {
    $database = DatabaseFactory::getFactory()->getConnection();

    $query = $database->prepare("SELECT * FROM qscQueue.tblRequests WHERE tsRequest >= :start_d_m_y, tsRequest <= :end_d_m_y INTO OUTFILE 'aFile.csv' FIELDS TERMINATED BY ','");

    if ((intval($sMon) > 0) && (intval($sMon) < 10)) { $sMon = '0' . $sMon; }
    if ((intval($sDay) > 0) && (intval($sDay) < 10)) { $sDay = '0' . $sDay; }
    if ((intval($eMon) > 0) && (intval($eMon) < 10)) { $eMon = '0' . $eMon; }
    if ((intval($eDay) > 0) && (intval($eDay) < 10)) { $eDay = '0' . $eDay; }
    $start_date = $sMon . '-' . $sDay . '-' . $sYr . ' 00:00:00';
    $end_date = $eMon . '-' . $eDay . '-' . $eYr . ' 00:00:00';

    $query->execute(array(
      ':start_d_m_y' => $start_date,
      ':end_d_m_y' => $end_date
    ));

  }

  public static function getQuickNotes() {
    $database = DatabaseFactory::getFactory()->getConnection();
    $sql = "SELECT * FROM qscQueue.tblTutorQuickNotes";
    return $database->query($sql);
  }
}
