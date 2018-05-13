<?php
require_once 'm6/includes/autoload.php';
use classes\business\UserManager;
use classes\data\UserManagerDB;
use classes\entity\User;
use classes\util\DBUtil;

/**
 * UserManager test case.
 * phpunit UserManagerTest ../src/UserManagerTest.php
 */
class UserManagerTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var UserManager
     */
    private $userManager;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();        
        $this->userManager = new UserManager(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->userManager = null;
        
        parent::tearDown();
    }

    /**
     * Tests UserManager::getAllUsers()
     * Need to change the expected result based on the 
     * number of users in the database i.e. #users + 1
     */
    public function testGetAllUsers()
    {
        $users = $this->userManager->getAllUsers();
        $this->assertEquals(6, count($users));
    }

    /**
     * Tests UserManager->getUserByEmailPassword()
     */
    public function testGetUserByEmailPasswordValid()
    {
        $email = "adam@testmail.com";
        $password = "Password01";
        $user = $this->userManager->getUserByEmail($email);
        $salt = $user->salt;
        $user = $this->userManager->getUserByEmailPassword(
            $email,
            hash("sha512",$salt.$password)
            );
        $this->assertInstanceOf('classes\entity\User', $user);
    }

    public function testGetUserByEmailPasswordInvalid()
    {        
        $user = $this->userManager->getUserByEmailPassword(
            'xxxx',
            'Password01'
            );
        $this->assertEquals(Null, $user);
    }
    
    /**
     * Tests UserManager->getUserByEmail()
     */
    public function testGetUserByEmailValid()
    {
        $user = $this->userManager->getUserByEmail("adam@testmail.com");
        $this->assertInstanceOf('classes\entity\User', $user);
    }
    
    public function testGetUserByEmailInvalid()
    {
        $user = $this->userManager->getUserByEmail("xxx");
        $this->assertEquals(Null, $user);
    }

    /**
     * Tests UserManager->getUserById()
     * For invalid test, need to change the number
     * to non existing id number
     */
    public function testGetUserByIdValid()
    {
        $user = $this->userManager->getUserById(2);
        $this->assertInstanceOf('classes\entity\User', $user);
    }
    
    public function testGetUserByIdInvalid()
    {
        $user = $this->userManager->getUserById(10);
        $this->assertEquals(NULL, $user);
    }

    /**
     * Tests UserManager->getUserLogin()
     * Ensure expected login is the last login timestamp
     */
    public function testGetUserLoginValid()
    {
        $login = $this->userManager->getUserLogin("adam@testmail.com");
        $this->assertEquals("2018-04-10 18:17:57", $login);
    }

    public function testGetUserLoginInvalid()
    {
        $login = $this->userManager->getUserLogin("xxx");
        $this->assertEquals("No previous login", $login);
    }

    /**
     * Tests UserManager->saveUser()
     */
    public function testSaveUser()
    {
        $salt = $this->userManager->randomPassword(
            6,
            1,
            "lower_case,upper_case,numbers"
            );
        $password = "Password01";
        $user = new User();
        $user->firstName = "Rose";
        $user->lastName  = "Azhar";
        $user->email     = "rose@testmail.com";
        $user->salt      = $salt[0];
        $user->password  = hash("sha512",$salt[0].$password);
        $user->role      = "User";
        $user->user_access      = "Allowed";
        $this->userManager->saveUser($user);
        $savedUser = $this->userManager->getUserByEmail($user->email);        
        $this->assertEquals($user->salt, $savedUser->salt);
    }

    /**
     * Tests UserManager->searchUsers()
     * Ensure asserts are according to the expected search output
     * from the sql query 
     */
    public function testSearchUsers()
    {
        $firstName = "Adam";
        $lastName = "Mardhiah";
        $email = "sam@testmail.com";
        $users = $this->userManager->searchUsers($firstName, $lastName, $email);        
        $this->assertEquals($lastName , $users[1]->lastName);        
        $this->assertEquals($firstName, $users[2]->firstName);        
        $this->assertEquals($email    , $users[3]->email);       
    }

    /**
     * Tests UserManager->loginUser()
     * Need to change expected id according to last
     * last login id in the database 
     * i.e. last loginId + 1
     */
    public function testLoginUser()
    {
        $email = "sam@testmail.com";
        $user = $this->userManager->getUserByEmail($email);
        $this->userManager->loginUser($user);
        $conn = DBUtil::getConnection();
        $email = mysqli_real_escape_string($conn,$email);
        $sql = "select id from tb_login where email = '$email' 
            order by id desc limit 1";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc(); 
        $loginId = $row["id"];
        $conn->close();
        $this->assertEquals(19, $loginId);
    }

    /**
     * Tests UserManager->updatePassword()
     */
    public function testUpdatePassword()
    {
        $email = "sam@testmail.com";
        $newPassword = "Password01";
        $user = $this->userManager->getUserByEmail($email);
        $salt = $user->salt;
        $newPassword = hash("sha512",$salt.$newPassword);
        $this->userManager->updatePassword($email, $newPassword);
        $updatedUser = $this->userManager->getUserByEmail($email);
        $this->assertEquals($newPassword, $updatedUser->password);
    }

    /**
     * Tests UserManager->deleteAccount()
     */
    public function testDeleteAccount()
    {
        $user = $this->userManager->getUserByEmail("rose@testmail.com");
        $id = $user->id;
        $this->userManager->deleteAccount($id);
        $users = $this->userManager->searchUsers("", "", "rose@testmail.com");
        $this->assertFalse(isset($users[1]));
    }

    /**
     * Tests UserManager->randomPassword()
     */
    public function testRandomPassword()
    {
        $password = $this->userManager->randomPassword(
            8,
            1,
            "lower_case,upper_case,numbers"
            );
        $this->assertRegExp("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)
            [a-zA-Z\d]{8,}$/", $password[0]);
    }
}

