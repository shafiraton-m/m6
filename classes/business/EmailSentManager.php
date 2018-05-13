<?php
namespace classes\business;

use classes\entity\EmailSent;
use classes\data\EmailSentManagerDB;

/**
 * This class provides the business logic
 * for EmailSent
 * @author Shafiraton Mardhiah
 *
 */
class EmailSentManager
{
    /**
     * Return all the emailsent listed in the database
     * @return \classes\entity\EmailSent[] is an array of emailsent
     */
    public static function getAllEmailSent()
    {
        return EmailSentManagerDB::getAllEmailSent();
    }
    /**
     * Return the emailsent with the given id
     * @param int $id
     * @return NULL|\classes\entity\EmailSent
     */
    public function getEmailSentById($id)
    {
        return EmailSentManagerDB::getEmailSentById($id);
    }
    /**
     * Create new emailsent or update existing emailsent in the database 
     * @param EmailSent $emailsent
     */
    public function saveEmailSent(EmailSent $emailsent)
    {
        EmailSentManagerDB::saveEmailSent($emailsent);
    }
    /**
     * Return the emailsent with the given date, subject, message and recipient
     * @param string $date
     * @param string $subject
     * @param string $message
     * @param string $recipient
     * @return \classes\entity\EmailSent[]
     */
    public function searchEmailSent($date,$subject,$message,$recipient)
    {
        return EmailSentManagerDB::searchEmailSent(
            $date,
            $subject,
            $message,
            $recipient
            );
    }
    /**
     * Delete the emailsent with the given id
     * @param int $id
     */
    public function deleteEmailSent($id)
    {
        EmailSentManagerDB::deleteEmailSent($id);
    }
    
}

?>