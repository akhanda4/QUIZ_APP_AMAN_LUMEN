<?php
    /**
     * This is a modal class
     *
     * @author   Aman Kumar
     * @since    18-01-2020
     */
namespace App;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectId;
use DB;
class SubCatagoriesModel extends Eloquent{
    public function __construct(){
        $this->DBconnection=DB::connection("mongodb");
        $this->collection_name = "SubCatagories";
    }
    public function addSubCatagories($subCatagoryData){
        $subCatagoryId = $this->DBconnection
        ->collection($this->collection_name)
        ->updateOrInsert($subCatagoryData);
        echo $subCatagoryId;
    }
    public function getCatagoriesForTree(){
        $catagories = $this->DBconnection
        ->collection("Catagories")
        ->get();
        return $catagories;
    }
    public function getSubCatagoriesForGrid($catagoryId){
        $subcatagoryList = $this->DBconnection
        ->collection("SubCatagories")
        // ->where('parentCatagoryId',new ObjectId($catagoryId))
        ->where('parentCatagoryId',$catagoryId)
        ->get();
        return $subcatagoryList;
    }
}