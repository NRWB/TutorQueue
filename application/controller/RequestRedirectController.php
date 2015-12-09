<?php

/**
 * @author Nick B.
 * @class RequestRedirect
 * @classdesc The RequestRedirect class.
 * @extends Controller
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo NONE
 */
class RequestRedirect extends Controller {

  /**
   * @function __construct
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function __construct() {
    parent::__construct();
    Auth::checkAuthentication();
  }

  /**
   * @function index
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function index() {
    $this->View->renderEx('student/RequestRedirect');
  }

  /**
   * @function RequestRedirect
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function RequestRedirect() {
    $this->View->renderEx('student/RequestRedirect');
  }

}
