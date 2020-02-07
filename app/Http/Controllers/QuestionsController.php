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
use App\QuestionsModel;
use DB;

class QuestionsController extends Controller{
    public function __construct()
    {   
        $this->QuestionsModel = new QuestionsModel;
    }
    public function getTree(){
        $tree = $this->QuestionsModel->getTree();
        $final_array = array(); 
       foreach($tree as $arr){
            $items = array();
            $cat_id = (string)$arr['_id'];
            $label = $arr['catagory'];
            //get subcatagories
            $sub_cat = $this->QuestionsModel->getSubCatagories($cat_id);
            foreach ($sub_cat as $sub_arr) {
                array_push($items, (object)array("label"=>$sub_arr["subcatagory"],"id"=>(string)$sub_arr["_id"].'-'.(string)$sub_arr["parentCatagoryId"]));
            }
            array_push($final_array, (object)array("cat_id"=>$cat_id,"label"=>$label,"items"=>$items));
        }
        return json_encode($final_array);
    }
    public function getQuestions(Request $request){
        $id = $request->all();
        $id = $id['id'];
        $sub_id = strchr($id,"-",true);
        $cat_id = strchr($id,"-",false);
        $cat_id = ltrim($cat_id,"-");
        $questions = $this->QuestionsModel->getQuestions($cat_id,$sub_id);
        return $questions;
    }
    public function addQuestion(Request $request){

        $questiondata = $request->all();
        $question = $questiondata['question'];
        $id = $questiondata['id'];
        $options = $questiondata['options'];
        $sub_id = strchr($id,"-",true);
        $cat_id = strchr($id,"-",false);
        $cat_id = ltrim($cat_id,"-");
        $correct = $questiondata['options'][3];
        unset($questiondata['options'][3]);
        unset($questiondata['id']);
        $questiondata['catid'] = $cat_id;
        $questiondata['subid'] = $sub_id;
        $questiondata['correct'] = $correct;
        $response = $this->QuestionsModel->addQuestion($questiondata);
        return (string)$response;
    }
    public function deleteQuestion(Request $request){
        $data = $request->all();
        $response = $this->QuestionsModel->deleteQuestion($data);
        return $data;
    }
}