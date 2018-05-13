<?php
namespace classes\business;

use classes\entity\User;
use classes\data\UserManagerDB;
/**
 * This class provides the business logic
 * for User
 * @author Shafiraton Mardhiah
 *
 */
class UserManager
{
    /**
     * Return all the users listed in the database
     * @return \classes\entity\User[] is an array of users
     */
    public static function getAllUsers()
    {
        return UserManagerDB::getAllUsers();
    }
    /**
     * Return the user with the given email and password
     * @param string $email
     * @param string $password should be the salted hash password stored in database
     * @return NULL|\classes\entity\User
     */
    public function getUserByEmailPassword($email,$password)
    {
        return UserManagerDB::getUserByEmailPassword($email,$password);
    }
    /**
     * Return the user with given the email
     * @param string $email
     * @return NULL|\classes\entity\User
     */
    public function getUserByEmail($email)
    {
        return UserManagerDB::getUserByEmail($email);
    }
    /**
     * Return the user with the given id
     * @param int $id
     * @return NULL|\classes\entity\User
     */
    public function getUserById($id)
    {
        return UserManagerDB::getUserById($id);
    }
    /**
     * Return the user with the given salt
     * @param string $salt
     * @return NULL|\classes\entity\User
     */
    public function getUserBySalt($salt)
    {
        return UserManagerDB::getUserBySalt($salt);
    }
    /**
     * Return the last login timestamp for the user with the given email
     * @param string $email
     * @return string|mixed
     */
    public function getUserLogin($email)
    {
        return UserManagerDB::getUserLogin($email);
    }
    /**
     * Create new user or update existing user in the database 
     * @param User $user
     */
    public function saveUser(User $user)
    {
        UserManagerDB::saveUser($user);
    }
    /**
     * Return the users with the given first name, last name and email
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @return \classes\entity\User[]
     */
    public function searchUsers($firstName,$lastName,$email)
    {
        return UserManagerDB::searchUsers($firstName,$lastName,$email);
    }
    /**
     * Create new login for user in the database
     * @param User $user
     */
    public function loginUser(User $user)
    {
        UserManagerDB::loginUser($user);
    }
    /**
     * Update the password of user with given email
     * @param string $email
     * @param string $password is the salted hash password of that submitted by end 
     * user to be stored in database 
     */
    public function updatePassword($email,$password)
    {
        UserManagerDB::updatePassword($email,$password);
    }
    /**
     * Update the subscription of user with given salt
     * @param string $salt
     * @param string $subscription
     */
    public function updateSubscription($salt,$subscription)
    {
        UserManagerDB::updateSubscription($salt,$subscription);
    }
    /**
     * Delete the user with the given id
     * @param int $id
     */
    public function deleteAccount($id)
    {
        UserManagerDB::deleteAccount($id);
    }
    /**
     * Generate specific number of random passwords with specified lengths and 
     * characters 
     * @param int $length the length of the generated password
     * @param int $count number of passwords to be generated
     * @param string $characters list of different types of characters to be 
     * included in each password 
     * @return string[]
     */
    public function randomPassword($length,$count, $characters)
    {
        // $length - the length of the generated password
        // $count - number of passwords to be generated
        // $characters - types of characters to be used in the password
        
        // define variables used within the function
        $symbols      = array();
        $passwords    = array();
        $used_symbols = '';
        $pass         = '';
        
        // an array of different character types
        $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
        $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $symbols["numbers"]    = '1234567890';
        $symbols["special_symbols"] = '!?~@#-_+<>[]{}';
        
        // get characters types to be used for the passsword
        $characters = explode(",",$characters);
        $noCharacters = count($characters);
        foreach ($characters as $key=>$value) {
            $used_symbols .= $symbols[$value]; // build a string with all characters
        }
        //strlen starts from 0 so to get number of characters deduct 1
        $symbols_length = strlen($used_symbols) - 1;
        
        for ($p = 0; $p < $count; $p++) {
            $pass = '';
            for ($i = 0; $i < $noCharacters; $i++) {
                // initialize password with the required characters
                $initial_symbols = '';
                $value = $characters[$i];
                $initial_symbols .= $symbols[$value];
                $initial_symbols_length = strlen($initial_symbols) - 1;
                $n = rand(0, $initial_symbols_length);
                $pass .= $initial_symbols[$n];
            }
            for ($j = $noCharacters; $j < $length; $j++) {
                // get a random character from the string with all characters
                $n = rand(0, $symbols_length);
                // add the character to the password string
                $pass .= $used_symbols[$n];
            }
            $passwords[] = $pass;
        }
        // return the generated password
        return $passwords;
    } //end of generate random password function
}

?>