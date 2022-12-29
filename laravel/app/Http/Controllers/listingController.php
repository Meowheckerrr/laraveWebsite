<?php

namespace App\Http\Controllers;

use App\Models\listing;


use Illuminate\Http\Request;


use Illuminate\Validation\Rule;

class listingController extends Controller
{

    //seven common resoure routes that we have routes and method we have to deal with 
    /*
    index
    show
    create
    stroe
    exit
    update
    destory
    */

    // show all listings
    public function index(){
        //dd(listing::latest()->filter(request(['tag','search']))->paginate("6"));
        return view("listings.index", [
            //dd(request("tag")),
            //dd(request("search")),
            "head" => "Latest listings",
            "listings" =>listing::latest()->filter(request(['tag','search']))->paginate("6")  //get a lastestlist
    
        ]);

    }

    // show single listing
    public function show(listing $listing){   //use eloquent model ,Depedent Injection 
        dd($listing);
        return view("listings.show" , [
            "listing"=> $listing
        ]);

    }

    //creat
    public function create(){
        return view("listings.create");
    }

    //store
    public function store(Request $request){
        //dd($request->all());
        //dd($request->file('logo'));
        
        $formFiles=$request->validate([
            'company' => ['required', Rule::unique("listings","company")], //if you want mulitple rules, you can use array. 
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' =>'required'
        ]);

        if($request->hasFile('logo')){    //check the upload file 
            $formFiles['logo'] = $request->file('logo')->store('logo','public');
        }
        
        //Include the user id to the listing table  
        $formFiles['user_id']=auth()->id(); 

        //insert data to the database 
        Listing::create($formFiles);    

        return redirect('/listings')->with("message","Listing creates successfully");
        
    }
    //edit 
    public function edit(listing $listing){
        //dd($listing);
        return view("listings.edit",[
            "listing" => $listing
        ]);
    }

    //update
    public function update(Request $request, listing $listing){
        
        //protect user information 
        if($listing->user_id != auth()->id()){
            abort(403, "Unauthorized Action");
        }


        //dd($request);
        //dd($request->all());
        //dd($request->file('logo'));
        $formFiles=$request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' =>'required'
        ]);

        if($request->hasFile('logo')){    //check the upload file 
            $formFiles['logo'] = $request->file('logo')->store('logo','public');
        }

        //insert data to the database 
        $listing->update($formFiles);    

        return back()->with("message","Listing updates successfully");
        
    }
    
    //delete
    public function destroy(listing $listing){

        //protect user information 
        if($listing->user_id != auth()->id()){
            abort(403, "Unauthorized Action");
        }

        $listing->delete();
        return redirect("/listings")->with("message","Listings deletes successfully");
    } 

    //manage listings
    public function manage(){

        //dd(auth());           //Illuminate\auth\authManager
        //dd(auth()->user());   //App\Models\User
        return view('listings.manage',[
            'listings' => auth()->user()->listings()->get()

        ]);
    }
    
}
