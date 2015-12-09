<?php

/**
 * @author Nick B.
 * @class AdminModel
 * @classdesc The AdminModel class, Handles all data manipulation of the admin part.
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo NONE
 */
class AdminModel {

  /**
   * @function setAccountDeletionStatus
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
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

  /**
   * @function 
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
// s=start, e=end
  public static function reqDataDump($sMon, $sDay, $sYr, $eMon, $eDay, $eYr) {
    $database = DatabaseFactory::getFactory()->getConnection();

    $query = $database->prepare("SELECT * FROM qscQueue.tblRequests WHERE tsRequest >= :start_d_m_y, tsRequest <= :end_d_m_y");

    if ((intval($sMon) > 0) && (intval($sMon) < 10)) { $sMon = '0' . $sMon; }
    if ((intval($sDay) > 0) && (intval($sDay) < 10)) { $sDay = '0' . $sDay; }
    if ((intval($eMon) > 0) && (intval($eMon) < 10)) { $eMon = '0' . $eMon; }
    if ((intval($eDay) > 0) && (intval($eDay) < 10)) { $eDay = '0' . $eDay; }
    $start_date = $sMon . '-' . $sDay . '-' . $sYr . ' 00:00:00';
    $end_date = $eMon . '-' . $eDay . '-' . $eYr . ' 00:00:00';

    $result = $query->execute(array(
                ':start_d_m_y' => $start_date,
                ':end_d_m_y' => $end_date
              ));

    return $result->fetchAll();

  }

  /**
   * @function 
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public static function getQuickNotes() {
    $database = DatabaseFactory::getFactory()->getConnection();
    $sql = "SELECT * FROM qscQueue.tblTutorQuickNotes";
    return $database->query($sql);
  }
}
