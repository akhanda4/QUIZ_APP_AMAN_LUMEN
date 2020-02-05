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

class CatagoriesModel extends Eloquent{
    public function __construct(){
        $this->DBconnection=DB::connection("mongodb");
        $this->collection_name = "Catagories";
    }
    public function getCatagories(){
        $catagories = $this->DBconnection
        ->collection($this->collection_name)
        ->get();
        return $catagories;
    }
    public function addCatagory($catagoryData){
        $response = $this->DBconnection
        ->collection($this->collection_name)
        ->updateOrInsert($catagoryData);
        return (string)$response;
    }
    public function addSubCatagories($catagoryId, $subCatagoryData){
        $response = $this->DBconnection
        ->collection($this->collection_name)
        ->where('_id',$catagoryId)
        ->update($subCatagoryData);
    }
}

?>