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
use App\SubCatagoriesModel;
use DB;

class SubCatagoriesController extends Controller{
    public function __construct()
    {   
        $this->SubCatagoriesModel = new SubCatagoriesModel;
    }
    public function addSubCatagory(Request $request){
        $doc = $request->all();
        $parentCatagoryId = $doc['parentCatagoryId'];
        echo $parentCatagoryId;
        $this->SubCatagoriesModel->addSubCatagories($parentCatagoryId, $doc);
    }
    public function getCatagoriesForTree(){
       $response = $this->SubCatagoriesModel->getCatagoriesForTree();
       $obj = array(); 
       foreach($response as $arr){
            $label = $arr['catagory'];
            $id = (string)$arr['_id'];
            array_push($obj, (object)array("id"=>$id,"label"=>$label));
        }
        return json_encode($obj);
    }
}
?>