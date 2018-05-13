<?php
namespace classes\entity;
/**
 * This is the User entity class
 * @author Shafiraton Mardhiah
 *
 */
class User
{
   public $id=0;
   public $firstName;
   public $lastName;
   public $email;
   public $salt;
   public $password;
   public $account_creation_time;
   public $role;
   public $user_access;
   public $subscription;
}
?>
