<?php

/**
 * @author Nick B.
 * @class GreeterModel
 * @classdesc Handles all data manipulation of the greeter part
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo 1. Complete function documentation headers
 */
class GreeterModel {

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
