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

class CategoriesModel extends Eloquent{
    public function __construct(){
        $this->DBconnection=DB::connection("mongodb");
        $this->collection_name = "Categories";
    }
    public function getCategories(){
        $categories = $this->DBconnection
        ->collection($this->collection_name)
        ->get();
        return $categories;
    }
    public function addCategory($categoryData){
        $response = $this->DBconnection
        ->collection($this->collection_name)
        ->updateOrInsert($categoryData);
        return (string)$response;
    }
    public function addSubCategories($categoryId, $subCategoryData){
        $response = $this->DBconnection
        ->collection($this->collection_name)
        ->where('_id',$categoryId)
        ->update($subCategoryData);
    }
    public function deleteCategory($catid){
        $resArr = array();
        $catid = $catid['$oid'];
        $catResponse = DB::connection("mongodb")
        ->collection("Categories")
        ->where('_id',new ObjectId($catid))
        ->delete();
        array_push($resArr,(object)array($catResponse));
        $subResponse = DB::connection("mongodb")
        ->collection("SubCategories")
        ->where('parentCategoryId',$catid)
        ->delete();
        array_push($resArr,(object)array($subResponse));
        $quesResponse = DB::connection("mongodb")
        ->collection("Questions")
        ->where('catid',$catid)
        ->delete();
        array_push($resArr,(object)array($quesResponse));
        return $resArr;
    }
    public function updateCategory($data){
        $category = $data['category'];
        $response = $this->DBconnection
        ->collection("Categories")
        ->where('_id',$data['_id'])
        ->update(['category'=>$category]);
        return $response;
    }
}

?>