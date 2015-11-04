<?php

/**
 * Handles all data manipulation of the student part
 */
class StudentModel {

  public static function addRequestToQueue($tableNo, $subj, $subSubj, $tutName) {
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

  public static function getSubjects() {
    $database = DatabaseFactory::getFactory()->getConnection();
    $query = $database->query("SELECT * FROM qscSubjects.tblTutorSubjects");
    return $query->fetchAll();
  }

  public static function getSubSubjects($identityNumber) {
    $database = DatabaseFactory::getFactory()->getConnection();
    $query = $database->query("SELECT * FROM qscSubjects.tblTutorSubSubjects WHERE id =".$identityNumber);
    return $query->fetchAll();
  }

  public static function getSubSubjectsAll() {
    $database = DatabaseFactory::getFactory()->getConnection();
    $query = $database->query("SELECT * FROM qscSubjects.tblTutorSubSubjects");
    return $query->fetchAll();
  }

  public static function getActiveTutors() {
  }
}
