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
//categories
$router->get('/getcategories', "CategoriesController@getCategories");
$router->post('/addcategory', "CategoriesController@addCategory");
$router->post('/deletecategory', "CategoriesController@deleteCategory");
$router->put('/updatecategory',"CategoriesController@updateCategory");

//subcategories
$router->post('/addsubcategory', "SubCategoriesController@addSubCategory");
$router->get('/getcategoriesfortree', "SubCategoriesController@getCategoriesForTree");
$router->post('/getsubcategoriesforgrid', "SubCategoriesController@getSubCategoriesForGrid");
$router->post('/deletesubcategory', "SubCategoriesController@deleteSubCategory");
$router->put('/updatesubcategory',"SubCategoriesController@updateSubCategory");
// $router->post('/addsubcategory/{categoryid}')

//questions
$router->get('/getcategoriesandsubcategories', "QuestionsController@getTree");
$router->get('/getquestions', "QuestionsController@getQuestions");
$router->post('/addquestion', "QuestionsController@addQuestion");
$router->post('/deletequestion',"QuestionsController@deleteQuestion");
$router->put('/updatequestion',"QuestionsController@updateQuestion");