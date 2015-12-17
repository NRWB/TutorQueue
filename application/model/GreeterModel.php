<?php

/**
 * @author Nick B.
 * @class GreeterModel
 * @classdesc Handles all data manipulation of the greeter part
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo 1. Complete function documentation headers
 */
class GreeterModel {

  public static function editViewSaver($update_id, $update_tableID, $update_subject, $update_sub_subject, $update_tutor_requested) {
    $sql = "UPDATE qscQueue.tblRequests SET ";

    if ((strlen($update_tableID) == 0) && (strlen($update_subject) == 0) && (strlen($update_sub_subject) == 0) && (strlen($update_tutor_requested) == 0)) {
      Session::add('feedback_positive', 'Nothing to update');
      return;
    }

    $arr = array(':u_id' => $update_id);

    if (strlen($update_tableID) != 0) {
      $sql = $sql . "tableNo = :u_tbl_num , ";
      $arr[':u_tbl_num'] = $update_tableID;
    }

    if (strlen($update_subject) != 0) {
      $sql = $sql . "subject = :u_subj , ";
      $arr[':u_subj'] = $update_subject;
    }

    if (strlen($update_sub_subject) != 0) {
      $sql = $sql . "subSubject = :u_sub_subj , ";
      $arr[':u_sub_subj'] = $update_sub_subject;
    }

    if (strlen($update_tutor_requested) != 0) {
      $sql = $sql . "tutorRequested = :u_req_tut ";
      $arr[':u_req_tut'] = $update_tutor_requested;
    }

    $sql = $sql . "WHERE tblRequests.id = :u_id";

    $database = DatabaseFactory::getFactory()->getConnection();

    $query = $database->prepare($sql);

    $query->execute($arr);
  }

  /**
   * @function setRequestDetails
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public static function setRequestDetails($recordID, $tableNo, $subj, $subSubj, $tutName) {
    $database = DatabaseFactory::getFactory()->getConnection();

    // to do = update according to the settings needed given func's params/args.
    $query = $database->prepare("UPDATE users SET user_deleted = :user_deleted  WHERE user_id = :user_id LIMIT 1");
    $query->execute(array(
      ':user_deleted' => $delete,
      ':user_id' => $userId
    ));

    // to do = determine if needed below if-statement
    if ($query->rowCount() == 1) {
      Session::add('feedback_positive', Text::get('FEEDBACK_ACCOUNT_SUSPENSION_DELETION_STATUS'));
      return true;
    }

  } // end of function

}
