<?php

/**
 * Handles all data manipulation of the student part
 */
class StudentModel {

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
