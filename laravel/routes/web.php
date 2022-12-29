<?php

use App\Http\Controllers\jqueryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\listingController;
use App\Models\listing;               //store listng contents
use Illuminate\Http\Request;          // Use it on 49 Request method

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



//Create a new page  
Route::get('/meowmeow', function () {
    return "meowhecker !!!!";
});



//Use http and add somting to the header
Route::get("/response", function(){
    return response("<button> meow </button>",200)
    ->header("Content-Type","text/plain")
    ->header("meow","hecker");
});

//Get a value from URL and set a regular expression requirment on router
Route::get("/post/{id}", function($id){  // we could use function to defind the variable
    //die and dump 
    //dd($id);
    //die dump and debugs 
    ddd($id);
    return response("Post" . $id );
})->where('$id','[0-9]+');


Route::get("/search/" , function(Request $request){ // $request = the column name 
  ddd($request);
  //return ($request->name . " " . $request->account ." ". $request->password);  
});

//All listings 

Route::get("/listings", [listingController::class, "index"]);  //go to the lisitngController and the index method 


    /* without an eloquent model
    //check whether the page exists or not
    $listing = listing::find($id);
 
    if($listing){
        return view("listing", [
            "listing" => listing::find($id)
        ]);
    }
    else{
        abort(404);  //throw an HttpException with give a data
    }
    */


//listingController

    //create form 註冊
    Route::get("/listings/create", [listingController::class, "create"])->middleware("auth");

    //store data
    Route::post("/listings",[listingController::class,"store"])->middleware("auth");

    //edit listing form 
    Route::get("/listings/{listing}/edit",[listingController::class,"edit"])->middleware("auth");

    //update listing
    Route::put("listings/{listing}",[listingController::class,"update"])->middleware("auth");

    //Manage Listings 編輯
    Route::get("/listings/manage",[listingController::class,"manage"])->middleware("auth");

    //single listing 
    Route::get("/listings/{listing}",[listingController::class,"show"]);   

    //delete listing
    Route::delete("/listings/{listing}",[listingController::class,"destroy"])->middleware("auth");
    

//UserController
        
    //User registration/create
    Route::get("/register",[userController::class,"create"])->middleware("guest");

    //create a New user
    Route::post("/users",[userController::class,"store"]);

    //user logout
    Route::post("/logout",[userController::class,"logout"])->middleware("auth");

    //user login form
    Route::get("/login",[userController::class,"login"])->name('login')->middleware("guest") ;
    
    //login in user
    Route::post("/users/authenticate",[userController::class,"authenticate"]);
    
    
    
//Javascript pages
    
    //Jquery 
    Route::get("/jquery/selector",[jqueryController::class,"show"]);