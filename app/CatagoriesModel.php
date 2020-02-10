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
    public function deleteCatagory($catid){
        $resArr = array();
        $catid = $catid['$oid'];
        $catResponse = DB::connection("mongodb")
        ->collection("Catagories")
        ->where('_id',new ObjectId($catid))
        ->delete();
        array_push($resArr,(object)array($catResponse));
        $subResponse = DB::connection("mongodb")
        ->collection("SubCatagories")
        ->where('parentCatagoryId',$catid)
        ->delete();
        array_push($resArr,(object)array($subResponse));
        $quesResponse = DB::connection("mongodb")
        ->collection("Questions")
        ->where('catid',$catid)
        ->delete();
        array_push($resArr,(object)array($quesResponse));
        return $resArr;
    }
    public function updateCatagory($data){
        $catagory = $data['catagory'];
        $response = $this->DBconnection
        ->collection("Catagories")
        ->where('_id',$data['_id'])
        ->update(['catagory'=>$catagory]);
        return $response;
    }
}

?>