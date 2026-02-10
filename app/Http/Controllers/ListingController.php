<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class ListingController extends Controller
{
    // Show all listings
   public function index()
{
    return view('listings.index', [
        'listings' => Listing::latest()->paginate(6)
    ]);
}

    // Show single listing
     public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show create form (auth protected in routes)
    public function create()
    {
        return view('listings.create');
    }

    // Store listing (auth protected in routes)
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'company' => ['required', Rule::unique('listings', 'company')],
            'title' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        // Attach logged-in user
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')
            ->with('message', 'Listing created successfully!');
    }

    // Show edit form (only owner)
    public function edit(Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    // Update listing (only owner)
    public function update(Request $request, Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) {
            abort(403, 'Only owner can edit this listing');
        }

        $formFields = $request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        $listing->update($formFields);

        return back()
            ->with('message', 'Listing updated successfully!');
    }

    // Delete listing (only owner)
    public function destroy(Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) {
            abort(403, 'Only owner can delete this listing');
        }

        $listing->delete();

        return redirect('/')
            ->with('message', 'Listing deleted successfully!');
    }

    // Manage listings for logged-in user
    public function manage()
    {
        return view('listings.manage', [
            'listings' => auth()->user()->listings()->get()
        ]);
    }
}
