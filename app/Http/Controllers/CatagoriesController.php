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
    public function getCatagories(Request $request){
        $this->CatagoriesModel->getCatagories();
    }
    public function addCatagory(Request $request){
        $doc = $request->all();
        $response = $this->CatagoriesModel->addCatagory($doc);
        return $response;
    }
}


?>