<?php
    /**
     * This is a modal class
     *
     * @author   Aman Kumar
     * @since    18-01-2020
     */
namespace App;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectID;
use DB;

class QuestionsModel extends Eloquent{
    public function __construct(){
        $this->DBconnection=DB::connection("mongodb");
        $this->collection_name = "Questions";
    }
    public function getTree(){
        $data = $this->DBconnection
        ->collection("Catagories")
        ->get();
        return $data;
    }
    public function getSubCatagories($catagoryId){
        $subcatagoryList = $this->DBconnection
        ->collection("SubCatagories")
        // ->where('parentCatagoryId',new ObjectId($catagoryId))
        ->where('parentCatagoryId',$catagoryId)
        ->get();
        return $subcatagoryList;
    }
}