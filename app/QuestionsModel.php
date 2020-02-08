<?php
/**
 * This is a modal class
 *
 * @author   Aman Kumar
 * @since    18-01-2020
 */
namespace App;

use DB;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
// use MongoDB\BSON\toJSON;
use MongoDB\BSON\ObjectId;
class QuestionsModel extends Eloquent
{
    public function __construct()
    {
        $this->DBconnection = DB::connection("mongodb");
        $this->collection_name = "Questions";
    }
    public function getTree()
    {
        $data = $this->DBconnection
            ->collection("Catagories")
            ->get();
        return $data;
    }
    public function getSubCatagories($catagoryId)
    {
        $subcatagoryList = $this->DBconnection
            ->collection("SubCatagories")
        // ->where('parentCatagoryId',new ObjectId($catagoryId))
            ->where('parentCatagoryId', $catagoryId)
            ->get();
        return $subcatagoryList;
    }
    public function addQuestion($questiondata)
    {
        $response = $this->DBconnection
            ->collection("Questions")
            ->insert($questiondata);
            return $response;
    }
    public function getQuestions($cat_id, $sub_id)
    {
        $collection = "Questions";
        $response = $this->DBconnection
            ->collection("Questions")
            ->where('catid',$cat_id)
            ->where('subid',$sub_id)
            ->get()
            ->shuffle()
            ->take(10);
            return $response;
    }
    public function deleteQuestion($quesId){
        $response = $this->DBconnection
            ->collection("Questions")
            ->where('_id',$quesId['$oid'])
            ->delete();
            return $response;
    }
}
