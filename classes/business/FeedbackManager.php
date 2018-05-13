<?php
namespace classes\business;

use classes\entity\Feedback;
use classes\data\FeedbackManagerDB;
/**
 * This class provides the business logic
 * for Feedback
 * @author Shafiraton Mardhiah
 * TODO NEED TO IMPLEMENT TESTCASE
 *
 */
class FeedbackManager
{
    /**
     * Return all the feedbacks submitted
     * @return \classes\entity\Feedback[] is an array
     */
    public static function getAllFeedback()
    {
        return FeedbackManagerDB::getAllFeedback();
    }
    /**
     * Return feedbacks submitted by user with given email
     * @param string $email
     * @return NULL|\classes\entity\Feedback
     */
    public function getFeedbackByEmail($email)
    {
        return FeedbackManagerDB::getFeedbackByEmail($email);
    }
    /**
     * Delete feedback with given id
     * @param int $id
     */
    public function deleteFeedback($id)
    {
        return FeedbackManagerDB::deleteFeedback($id);
    }	
    /**
     * Insert the feedback submitted to the database
     * @param Feedback $feedback
     */
    public function insertFeedback(Feedback $feedback)
    {
        FeedbackManagerDB::insertFeedback($feedback);
    }
}

?>