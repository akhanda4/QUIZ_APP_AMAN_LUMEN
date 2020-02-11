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
class SubCategoriesModel extends Eloquent{
    public function __construct(){
        $this->DBconnection=DB::connection("mongodb");
        $this->collection_name = "SubCategories";
    }
    public function addSubCategories($subCategoryData){
        $subCategoryId = $this->DBconnection
        ->collection($this->collection_name)
        ->updateOrInsert($subCategoryData);
        echo $subCategoryId;
    }
    public function getCategoriesForTree(){
        $categories = $this->DBconnection
        ->collection("Categories")
        ->get();
        return $categories;
    }
    public function getSubCategoriesForGrid($categoryId){
        $subcategoryList = $this->DBconnection
        ->collection("SubCategories")
        // ->where('parentCategoryId',new ObjectId($categoryId))
        ->where('parentCategoryId',$categoryId)
        ->get();
        return $subcategoryList;
    }
    public function deleteSubCategory($subcatid){
        $resArr = array();
        $subResponse = DB::connection("mongodb")
        ->collection("SubCategories")
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
    public function updateSubCategory($data){
        $_id = $data['_id'];
        $parentCategoryId = $data['parentCategoryId'];
        $subcategory = $data['subcategory'];
        $response = DB::connection("mongodb")
        ->collection("SubCategories")
        ->where('_id',$_id)
        ->where('parentCategoryId',$parentCategoryId)
        ->update(['subcategory'=>$subcategory]);
        return $response;
    }
}