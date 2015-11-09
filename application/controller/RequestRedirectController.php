<?php

class RequestRedirect extends Controller {

  public function __construct() {
    parent::__construct();
    Auth::checkAuthentication();
  }

  public function index() {
    $this->View->render('student/RequestRedirect');
  }

  public function RequestRedirect() {
    $this->View->render('student/RequestRedirect');
  }

}
