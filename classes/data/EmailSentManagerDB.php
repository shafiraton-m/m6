<?php
namespace classes\data;

use classes\entity\EmailSent;
use classes\util\DBUtil;
/**
 * This class provides the database access logic
 * for EmailSent
 * @author Shafiraton Mardhiah
 *
 */
class EmailSentManagerDB
{
    /**
     * Instantiating the EmailSent class with information from $row
     * @param array $row read from the database
     * @return \classes\entity\EmailSent
     */
    public static function fillEmailSent($row)
    {
        $emailsent = new EmailSent();
        $emailsent->id        = $row["id"];
        $emailsent->date      = $row["date"];
        $emailsent->subject   = $row["subject"];
        $emailsent->message   = $row["message"];
        $emailsent->type      = $row["type"];
        $emailsent->sent_by      = $row["sent_by"];
        $emailsent->recipient = $row["recipient"];
        return $emailsent;
    }
    /**
     * Read and return the emailsent with the given id
     * @param int $id
     * @return NULL|\classes\entity\EmailSent
     */
    public static function getEmailSentById($id)
    {
        $emailsent = NULL;
        $conn = DBUtil::getConnection();
        $id = mysqli_real_escape_string($conn,$id);
        $sql = "select * from tb_email_sent where id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $emailsent = self::fillEmailSent($row);
            }
        }
        $conn->close();
        return $emailsent;
    }
	/**
     * Create new emailsent in the database
     * @param EmailSent $emailsent
     */
    public static function saveEmailSent(EmailSent $emailsent)
    {
        $conn = DBUtil::getConnection();
        $sql = "call procSaveEmailSent(?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "isssss", 
            $emailsent->id,
            $emailsent->subject,
            $emailsent->message,
            $emailsent->type,
            $emailsent->sent_by,
            $emailsent->recipient
        ); 
        $stmt->execute();
        if($stmt->errno != 0){
            printf("Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();
    }
    /**
     * Read and return the emailsent with the given date, subject and message
     * @param string $date
     * @param string $subject
     * @param string $message
     * @param string $recipient
     * @return \classes\entity\EmailSent[] an array of objects
     */
    public static function searchEmailSent($date,$subject,$message,$recipient)
    {
        $emailsents[] = array();
        $conn = DBUtil::getConnection();
        $date = mysqli_real_escape_string($conn,$date);
        if ($date != "") {
            $date = '%'.$date.'%';
        }
        $subject = mysqli_real_escape_string($conn,$subject);
        if ($subject != "") {
            $subject = '%'.$subject.'%';
        }
        $message = mysqli_real_escape_string($conn,$message);    
        if ($message != "") {    
            $message = '%'.$message.'%';
        }
        $recipient = mysqli_real_escape_string($conn,$recipient);
        if ($recipient != "") {
            $recipient = '%'.$recipient.'%';
        }
        $sql = "select * from tb_email_sent 
            where date like '$date' 
            or subject like '$subject' 
            or message like '$message' 
            or recipient like '$recipient'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $emailsent = self::fillEmailSent($row);
				$emailsents[] = $emailsent;
            }
        }
        $conn->close();
        return $emailsents;
    }    
	/**
	 * Delete the emailsent with the given id
	 * @param int $id
	 */
    public static function deleteEmailSent($id)
    {
        $conn = DBUtil::getConnection();
        $sql = "DELETE from tb_email_sent WHERE id = '$id';";
        $stmt = $conn->prepare($sql);
		if ($conn->query($sql) === TRUE) {
			echo "<script>alert(Record deleted successfully)</script>";
		} else {
			echo "Error updating record: " . $conn->error;
		}
		$conn->close();
    }
    /**
     * Read and return all the emailsent listed in the database
     * @return \classes\entity\EmailSent[] an array of objects
     */
    public static function getAllEmailSent()
    {
        $emailsents[] = array();
        $conn = DBUtil::getConnection();
        $sql = "select * from tb_email_sent";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $emailsent = self::fillemailsent($row);
                $emailsents[] = $emailsent;
            }
        }
        $conn->close();
        return $emailsents;
    }
}

?>