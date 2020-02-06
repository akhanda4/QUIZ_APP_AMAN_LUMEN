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
use App\CatagoriesModel;
use DB;

class CatagoriesController extends Controller{
    
    public function __construct()
    {   
        $this->CatagoriesModel = new CatagoriesModel;
    }
    public function getCatagories(){
       $catagories =  $this->CatagoriesModel->getCatagories();
       return $catagories;
    }
    public function addCatagory(Request $request){
        $doc = $request->all();
        $response = $this->CatagoriesModel->addCatagory($doc);
        return $response;
    }
    public function deleteCatagory(Request $request){
        $catagoryId = $request->add();
        echo $catagoryId;
        return;
    }
}


?>