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
        $response = $this->DBconnection
            ->collection("Questions")
            ->where('catid',$cat_id)
            ->where('subid',$sub_id)
            ->get();
            return $response;
    }
}
