<?php

/**
 * Handles all data manipulation of the tutor part
 */
class TutorModel {

  /**
    takes a record that's in the help request
    internal time stamps should be updated by the phpmyadmin framework

    stateEnum - "wait" "progress" "done"
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
    adds notes from tutor input, into a record of a help request

    noteDD - the ``quick'' option of filling in notes for a help request
    noteText - the type option of filling in notes of a help request
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
   * Created to look up a tutors input code, to see if the input number is a valid tutor code for accessing the tutor view.
   * Logs in as a tutor if the code found is a success.
   */
  public static function confirmTutorCode() {
    $database = DatabaseFactory::getFactory()->getConnection();
    $tut_code = Request::post('input_tutor_text_code');
    $query = $database->prepare("SELECT * FROM qscTutorList.tblAllTutors WHERE tutcode = :the_tutor_code LIMIT 1");
    $query->execute(
      array(
        ':the_tutor_code' => $tut_code
      )
    );
    if ($query->rowCount() == 1) {
      return true;
    } else {
      return false;
    }
  }

  public static function logoutTimeoutTutor() {
    LoginModel::logout();
    $login_successful = LoginModel::login(
      'studenttest', 'system', ''
    );
  }

}
