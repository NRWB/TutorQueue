<?php

/**
 * @author Nick B.
 * @class IndexController
 * @classdesc The IndexController class.
 * @extends Controller
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo NONE
 */
class IndexController extends Controller {

  /**
   * @function __construct
   * @public
   * @returns NONE
   * @desc Construct this object by extending the basic Controller class.
   * @param NONE
   * @example NONE
   */
  public function __construct() {
    parent::__construct();
    Auth::checkStudentAuthentication();
  }

  /**
   * @function index
   * @public
   * @returns NONE
   * @desc Handles what happens when user moves to URL/index/index - or - as this is the default controller, also when user moves to /index or enter your application at base level.
   * @param NONE
   * @example NONE
   */
  public function index() {
    $this->View->renderEx(
//    $this->View->render(
      'index/index'
    );
  }

  /**
   * @function updateTable
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function updateTable() {
    $this->View->renderEx('index/updateTable');
  }
}
