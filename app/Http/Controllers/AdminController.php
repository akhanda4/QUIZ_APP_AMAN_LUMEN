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
use App\AdminModel;
use DB;


class AdminController extends Controller
{
    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->AdminModel = new AdminModel;
    }
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:7'
        ]);
        $email = $request->input("email");
        $password = $request->input("password");
        $response = $this->AdminModel->adminLogin($email, $password);
        $response = json_decode($response);
        unset($response->password);
        json_encode($response);
        return $response;
    }
}
