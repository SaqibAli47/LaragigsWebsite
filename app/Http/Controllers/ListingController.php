<?php

namespace App\Http\Controllers;


use App\Models\Listing;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show All Listing
    public function index(){
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]); 
    }

    // Show Single Listing
    public function show(Listing $listing){
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show  Create Listing
    public function create(){
        return view('listings.create');
    }

    
    // Store  Create Listing
    public function store(Request $request){
        // for validation in laravel super minimal code
        $formFields = $request->validate([
            'title'    => 'required',
            'company'  => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website'  => 'required',
            'email'    => ['required', 'email'],
            'tags'     => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);
        // we want to use the flash message creating data
        // Session::flash('message', 'listing created');
        return redirect('/')->with('message', 'Listing Created Successfully!');
    }

    // Show Edit Forms
    public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
    }

     // Update Listing
     public function update(Request $request, Listing $listing){
        // Make Sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort('403', 'Unathorized Action' );
        }
        $formFields = $request->validate([
            'title'    => 'required',
            'company'  => ['required'],
            'location' => 'required',
            'website'  => 'required',
            'email'    => ['required', 'email'],
            'tags'     => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listing->update($formFields);
        // we want to use the flash message creating data
        // Session::flash('message', 'listing created');
        return back()->with('message', 'Listing Updated Successfully!');
    }
    // destroy listing
    public function destroy(Listing $listing){
        // Make sure owner can delete the list gigs
        if($listing->user_id != auth()->id()){
            abort('403', 'Unathorized Action' );
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted Successfully!');
    }

    // Manage Function Listings
    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
