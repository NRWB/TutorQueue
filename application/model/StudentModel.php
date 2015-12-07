<?php

/**
 * @author Nick B.
 * @class StudentModel
 * @classdesc The StudentModel class, Handles all data manipulation of the student part.
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo NONE
 */
class StudentModel {

  /**
   * @function 
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public static function getSubjects() {
    $database = DatabaseFactory::getFactory()->getConnection();
    $query = $database->query("SELECT * FROM qscSubjects.tblTutorSubjects");
    return $query->fetchAll();
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
  public static function getSubSubjects($identityNumber) {
    $database = DatabaseFactory::getFactory()->getConnection();
    $query = $database->query("SELECT * FROM qscSubjects.tblTutorSubSubjects WHERE id =".$identityNumber);
    return $query->fetchAll();
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
  public static function getSubSubjectsAll() {
    $database = DatabaseFactory::getFactory()->getConnection();
    $query = $database->query("SELECT * FROM qscSubjects.tblTutorSubSubjects");
    return $query->fetchAll();
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
  public static function getTutors() {
    $database = DatabaseFactory::getFactory()->getConnection();
    $query = $database->query("SELECT * FROM qscTutorList.tblAllTutors");
    return $query->fetchAll();
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
  public static function table_num_setup() {
    $tbl_no = Request::post('input_text_field');
    $database = DatabaseFactory::getFactory()->getConnection();
    $query = $database->prepare("SELECT * FROM qscDeviceTables.tblDevices WHERE number = :table_number_input");
    $query->execute(
      array(
        ':table_number_input' => $tbl_no
      )
    );
    if ($query->rowCount() == 0) {
      $n = intval($tbl_no);
      if ($n < 0) {
        return false;
      }
      Session::set('table_number', $n);
//      apc_store('table_number', $n);
/**
      $m = session_id();
      $database->query("INSERT INTO qscDeviceTables.tblDevices (id, number) VALUES (".$m.", ".$n.")";
*/
      $database->query("INSERT INTO qscDeviceTables.tblDevices (number) VALUES (".$n.")");
      return true;
    } else {
      // failure, table number exists!

//      $exists_already = apc_fetch('table_number');
//      if ($exists_already) {
//        Session::set('table_number');
//        return true;
//      }
      return false;
    }
  }
}
