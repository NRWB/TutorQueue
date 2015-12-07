<?php

/**
 * @author Nick B.
 * @class UserModel
 * @classdesc The UserModel class, Handles all the PUBLIC profile stuff. This is not for getting data of the logged in user, it's more for handling data of all the other users. Useful for display profile information, creating user lists etc.
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo DELETE unneeded functions
 */
class UserModel {

  /**
   * @function getPublicProfilesOfAllUsers
   * @public
   * @static
   * @returns {array} All of the user profiles.
   * @desc Gets an array that contains all the users in the database. The array's keys are the user ids. Each array element is an object, containing a specific user's data.
   * @param NONE
   * @example NONE
   */
  public static function getPublicProfilesOfAllUsers() {
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT user_id, user_name, user_email, user_active, user_has_avatar, user_deleted FROM users";
    $query = $database->prepare($sql);
    $query->execute();

    $all_users_profiles = array();

    foreach ($query->fetchAll() as $user) {

      // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
      // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
      // the user's values
      array_walk_recursive($user, 'Filter::XSSFilter');

      $all_users_profiles[$user->user_id] = new stdClass();
      $all_users_profiles[$user->user_id]->user_id = $user->user_id;
      $all_users_profiles[$user->user_id]->user_name = $user->user_name;
      $all_users_profiles[$user->user_id]->user_email = $user->user_email;
      $all_users_profiles[$user->user_id]->user_active = $user->user_active;
      $all_users_profiles[$user->user_id]->user_deleted = $user->user_deleted;
    }

    return $all_users_profiles;
  }

  /**
   * @function getPublicProfileOfUser
   * @public
   * @static
   * @returns {array} A single user profile.
   * @desc Gets a user's profile data, according to the given $user_id.
   * @param {integer} $user_id The user's id.
   * @example NONE
   */
  public static function getPublicProfileOfUser($user_id) {
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT user_id, user_name, user_email, user_active, user_deleted FROM users WHERE user_id = :user_id LIMIT 1";
    $query = $database->prepare($sql);
    $query->execute(array(':user_id' => $user_id));

    $user = $query->fetch();

    if ($query->rowCount() != 1) {
      Session::add('feedback_negative', Text::get('FEEDBACK_USER_DOES_NOT_EXIST'));
    }

    // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
    // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
    // the user's values
    array_walk_recursive($user, 'Filter::XSSFilter');

    return $user;
  }

  /**
   * @function getUserDataByUserNameOrEmail
   * @public
   * @static
   * @returns Query findings.
   * @desc Looks up a user by either the respective username or email.
   * @param {string} $user_name_or_email The searchable username or email.
   * @example NONE
   */
  public static function getUserDataByUserNameOrEmail($user_name_or_email) {
    $database = DatabaseFactory::getFactory()->getConnection();

    $query = $database->prepare("SELECT user_id, user_name, user_email FROM users
                                 WHERE (user_name = :user_name_or_email OR user_email = :user_name_or_email)
                                 AND user_provider_type = :provider_type LIMIT 1");
    $query->execute(array(':user_name_or_email' => $user_name_or_email, ':provider_type' => 'DEFAULT'));

    return $query->fetch();
  }

  /**
   * @function doesUsernameAlreadyExist
   * @public
   * @static
   * @returns {boolean} True if username exists.
   * @desc Checks if a username is already taken.
   * @param {string} $user_name Searchable username.
   * @example NONE
   */
  public static function doesUsernameAlreadyExist($user_name) {
    $database = DatabaseFactory::getFactory()->getConnection();

    $query = $database->prepare("SELECT user_id FROM users WHERE user_name = :user_name LIMIT 1");
    $query->execute(array(':user_name' => $user_name));
    if ($query->rowCount() == 0) {
      return false;
    }
    return true;
  }

  /**
   * @function doesEmailAlreadyExist
   * @public
   * @static
   * @returns {boolean} True if email exists.
   * @desc Checks if a email is already used.
   * @param {string} $user_email Searchable email.
   * @example NONE
   */
  public static function doesEmailAlreadyExist($user_email) {
    $database = DatabaseFactory::getFactory()->getConnection();

    $query = $database->prepare("SELECT user_id FROM users WHERE user_email = :user_email LIMIT 1");
    $query->execute(array(':user_email' => $user_email));
    if ($query->rowCount() == 0) {
      return false;
    }
    return true;
  }

  /**
   * @function saveNewUserName
   * @public
   * @static
   * @returns {boolean} True if successful.
   * @desc Writes new username to database.
   * @param {integer} $user_id The user identity number.
   * @param {string} $new_user_name The new username.
   * @example NONE
   */
  public static function saveNewUserName($user_id, $new_user_name) {
    $database = DatabaseFactory::getFactory()->getConnection();

    $query = $database->prepare("UPDATE users SET user_name = :user_name WHERE user_id = :user_id LIMIT 1");
    $query->execute(array(':user_name' => $new_user_name, ':user_id' => $user_id));
    if ($query->rowCount() == 1) {
      return true;
    }
    return false;
  }

  /**
   * @function saveNewEmailAddress
   * @public
   * @static
   * @returns {boolean} True if successful.
   * @desc Writes new email address to database.
   * @param {integer} $user_id The user identity number.
   * @param {string} $new_user_email The new email.
   * @example NONE
   */
  public static function saveNewEmailAddress($user_id, $new_user_email) {
    $database = DatabaseFactory::getFactory()->getConnection();

    $query = $database->prepare("UPDATE users SET user_email = :user_email WHERE user_id = :user_id LIMIT 1");
    $query->execute(array(':user_email' => $new_user_email, ':user_id' => $user_id));
    $count = $query->rowCount();
    if ($count == 1) {
      return true;
    }
    return false;
  }

  /**
   * @function getUserIdByUsername
   * @public
   * @static
   * @returns {string} One row (we only have one result or nothing).
   * @desc Gets the user's id.
   * @param {string} $user_name Searchable username.
   * @example NONE
   */
  public static function getUserIdByUsername($user_name) {
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT user_id FROM users WHERE user_name = :user_name AND user_provider_type = :provider_type LIMIT 1";
    $query = $database->prepare($sql);

    // DEFAULT is the marker for "normal" accounts (that have a password etc.)
    // There are other types of accounts that don't have passwords etc. (FACEBOOK)
    $query->execute(array(':user_name' => $user_name, ':provider_type' => 'DEFAULT'));

    return $query->fetch()->user_id;
  }

  /**
   * @function getUserDataByUsername
   * @public
   * @static
   * @returns {string} [mixed] Returns false if user does not exist, returns object with user's data when user exists. One row (we only have one result or nothing).
   * @desc Gets the user's data.
   * @param {string} $user_name Searchable username.
   * @example NONE
   */
  public static function getUserDataByUsername($user_name) {
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT user_id, user_name, user_email, user_password_hash, user_active,user_deleted, user_suspension_timestamp, user_account_type,
                   user_failed_logins, user_last_failed_login
            FROM users
            WHERE (user_name = :user_name OR user_email = :user_name)
            AND user_provider_type = :provider_type
            LIMIT 1";
    $query = $database->prepare($sql);

    // DEFAULT is the marker for "normal" accounts (that have a password etc.)
    // There are other types of accounts that don't have passwords etc. (FACEBOOK)
    $query->execute(array(':user_name' => $user_name, ':provider_type' => 'DEFAULT'));

    return $query->fetch();
  }

  /**
   * @function getUserDataByUserIdAndToken
   * @public
   * @static
   * @returns {string} [mixed] Returns false if user does not exist, returns object with user's data when user exists. One row (we only have one result or nothing).
   * @desc Gets the user's data by user's id and a token (used by login-via-cookie process).
   * @param {integer} $user_id The user identity number.
   * @param {string} $token The searchable token.
   * @example NONE
   */
  public static function getUserDataByUserIdAndToken($user_id, $token) {
    $database = DatabaseFactory::getFactory()->getConnection();

    // get real token from database (and all other data)
    $query = $database->prepare("SELECT user_id, user_name, user_email, user_password_hash, user_active,
                                        user_account_type, user_failed_logins, user_last_failed_login
                                 FROM users
                                 WHERE user_id = :user_id
                                   AND user_remember_me_token = :user_remember_me_token
                                   AND user_remember_me_token IS NOT NULL
                                   AND user_provider_type = :provider_type LIMIT 1");
    $query->execute(array(':user_id' => $user_id, ':user_remember_me_token' => $token, ':provider_type' => 'DEFAULT'));

    return $query->fetch();
  }
}
