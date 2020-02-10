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
    public function deleteSubCatagory($subcatid){
        $resArr = array();
        $subResponse = DB::connection("mongodb")
        ->collection("SubCatagories")
        ->where('_id',$subcatid['$oid'])
        ->delete();
        array_push($resArr,(object)array($subResponse));
        $quesResponse = DB::connection("mongodb")
        ->collection("Questions")
        ->where('catid',$subcatid['$oid'])
        ->delete();
        array_push($resArr,(object)array($quesResponse));
        return $resArr;
    }
    public function updateSubCatagory($data){
        $_id = $data['_id'];
        $parentCatagoryId = $data['parentCatagoryId'];
        $subcatagory = $data['subcatagory'];
        $response = DB::connection("mongodb")
        ->collection("SubCatagories")
        ->where('_id',$_id)
        ->where('parentCatagoryId',$parentCatagoryId)
        ->update(['subcatagory'=>$subcatagory]);
        return $response;
    }
}