<?php
/**
 * This is a controller class
 *
 * @author   Aman Kumar
 * @since    04-02-2020
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\SubCategoriesModel;
use DB;

class SubCategoriesController extends Controller{
    public function __construct()
    {   
        $this->SubCategoriesModel = new SubCategoriesModel;
    }
    public function addSubCategory(Request $request){
        $doc = $request->all();
        if(count($doc)===1){
            return ("{\"error\":\"Please Select a category\"}");
            die;
        }
        $this->SubCategoriesModel->addSubCategories($doc);
    }
    public function getCategoriesForTree(){
       $response = $this->SubCategoriesModel->getCategoriesForTree();
       $obj = array(); 
       foreach($response as $arr){
            $label = $arr['category'];
            $id = (string)$arr['_id'];
            array_push($obj, (object)array("id"=>$id,"label"=>$label));
        }
        return json_encode($obj);
    }
    public function getSubCategoriesForGrid(Request $request){
        $parentCategoryId = $request->input("parentCategoryId");
        $response = $this->SubCategoriesModel->getSubCategoriesForGrid($parentCategoryId);
        return $response;
    }
    public function deleteSubCategory(Request $request){
        $data = $request->all();
        $subcatid = $data['_id'];
        $response = $this->SubCategoriesModel->deleteSubCategory($subcatid);
        return $response;
    }
    public function updateSubCategory(Request $request){
        $data = $request->all();
        $response = $this->SubCategoriesModel->updateSubCategory($data);
        return $response;
    }
}
?>