<?php

/**
 * @author Nick B.
 * @class TutorModel
 * @classdesc The TutorModel class, Handles all data manipulation of the tutor part.
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo DELETE unneeded functions/Change login of student
 */
class TutorModel {

  /**
   * @function setHelpRequestTransitionState
   * @public
   * @static
   * @returns {boolean} True if successful.
   * @desc Takes a record that's in the help request. Internal time stamps should be updated by the phpmyadmin framework.
   * @param {integer} $id The unique identity for the help request.
   * @param {string} $stateEnum The enumerated state of the help request.
   * @example NONE
   */
  public static function setHelpRequestTransitionState($id, $stateEnum) {
    $database = DatabaseFactory::getFactory()->getConnection();
    $query = $database->prepare("UPDATE qscQueue.tblRequests SET serviceState = :service_state WHERE id = :id_no");
    $query->execute(array(
      ':service_state' => $stateEnum,
      ':id_no' => $id
    ));
    Session::add('feedback_positive', 'modified the state of a help request - success');
    return true;
  }

  /**
   * @function appendNotesHelpRequest
   * @public
   * @static
   * @returns {boolean} True if successful.
   * @desc Adds notes from tutor input, into a record of a help request.
   * @param {integer} $id The unique identity for the help request.
   * @param {string} $noteDD The ``quick'' option of filling in notes for a help request.
   * @param {string} $noteText The type option of filling in notes of a help request.
   * @example NONE
   */
  public static function appendNotesHelpRequest($id, $noteDD, $noteText) {
    $database = DatabaseFactory::getFactory()->getConnection();
    $query = $database->prepare("UPDATE qscQueue.tblRequests SET notesDropDown = :note_drop_down, notesEditable = :note_text WHERE id = :id_no");
    $query->execute(array(
      ':note_drop_down' => $noteDD,
      ':note_text' => $noteText,
      ':id_no' => $id
    ));
    Session::add('feedback_positive', 'added the notes to a help request - success');
    return true;
  }

  /**
   * @function confirmTutorCode
   * @public
   * @static
   * @returns {boolean} True if successful.
   * @desc Created to look up a tutors input code, to see if the input number is a valid tutor code for accessing the tutor view. Logs in as a tutor if the code found is a success.
   * @param NONE
   * @example NONE
   */
  public static function confirmTutorCode() {
    $database = DatabaseFactory::getFactory()->getConnection();
    $tut_code = Request::post('input_tutor_text_code');
//    $query = $database->prepare("SELECT * FROM qscTutorList.tblAllTutors WHERE tutcode = :the_tutor_code LIMIT 1");
    $query = $database->prepare("SELECT * FROM qscTutorList.tblAllTutors WHERE tutCode = :the_tutor_code LIMIT 1");
    $query->execute(
      array(
        ':the_tutor_code' => $tut_code
      )
    );
    if ($query->rowCount() == 1) {
      Session::set('tmp_tutor_code', $tut_code);
      return true;
    } else {
      return false;
    }
  }

  /**
   * @function logoutTimeoutTutor
   * @public
   * @static
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public static function logoutTimeoutTutor() {
    LoginModel::logout();
    $login_successful = LoginModel::login(
      'student', 'system', ''
    );
  }

}
