<?php
    /**
     * This is a modal class
     *
     * @author   Aman Kumar
     * @since    18-01-2020
     */
namespace App;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectID;
use DB;

class AdminModel extends Eloquent {
    /**
     * Connection establish instance
     */
    public function __construct(){
        $this->DBconnection=DB::connection("mongodb");
        $this->collection_name = "Admin";
    }
    /**
     * This method will fetch document with matching phone number
     */
    public function adminLogin($email, $password){
        $response = $this->DBconnection
        ->collection($this->collection_name)
        ->where('email',$email)
        ->where('password', $password)
        ->get();
        return $response;
    }
}
?>