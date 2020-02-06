<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->post('/login', "AdminController@login");

$router->get('/getcatagories', "CatagoriesController@getCatagories");
$router->post('/addcatagory', "CatagoriesController@addCatagory");
$router->post('/deletecatagory',"CatagoriesController@deleteCatagory");

//subcatagories
$router->post('/addsubcatagory', "SubCatagoriesController@addSubCatagory");
$router->get('/getcatagoriesfortree', "SubCatagoriesController@getCatagoriesForTree");
$router->post('/getsubcatagoriesforgrid',"SubCatagoriesController@getSubCatagoriesForGrid");
// $router->post('/addsubcatagory/{catagoryid}')



$router->get('/getcatagoriesandsubcatagories',"QuestionsController@getTree");
$router->post('/getquestions',"QuestionsController@getQuestions");
$router->post('/addquestion',"QuestionsController@addQuestion");
