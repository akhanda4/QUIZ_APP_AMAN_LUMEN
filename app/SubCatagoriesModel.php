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
class SubCatagoriesModel extends Eloquent{
    public function __construct(){
        $this->DBconnection=DB::connection("mongodb");
        $this->collection_name = "SubCatagories";
    }
    public function addSubCatagories($parentCatagoryId, $subCatagoryData){
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
}