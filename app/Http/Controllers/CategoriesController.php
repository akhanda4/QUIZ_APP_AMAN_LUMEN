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
use App\CategoriesModel;
use DB;

class CategoriesController extends Controller{
    
    public function __construct()
    {   
        $this->CategoriesModel = new CategoriesModel;
    }
    public function getCategories(){
       $categories =  $this->CategoriesModel->getCategories();
       return $categories;
    }
    public function addCategory(Request $request){
        $doc = $request->all();
        $response = $this->CategoriesModel->addCategory($doc);
        return $response;
    }
    public function deleteCategory(Request $request){
        $categorydata = $request->all();
        $catid = $categorydata['_id'];
        $response = $this->CategoriesModel->deleteCategory($catid);
        return $response;
    }
    public function updateCategory(Request $request){
        $data = $request->all();
        $response = $this->CategoriesModel->updateCategory($data);
        return $response;
    }
}
?>