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

}
