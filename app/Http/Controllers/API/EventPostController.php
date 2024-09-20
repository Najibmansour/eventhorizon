<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EventPost;
use Illuminate\Http\Request;

class EventPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query_page_length = $request->query('page_length', null);
        $query_page_index = $request->query('page_index',null);

        // dd($query_page_length, $query_page_index);

        if ($query_page_index == null || $query_page_length == null) {
            
            return response()->json([
                'data'=> EventPost::all(),  
            ]);
        }else {
        
            $posts = EventPost::where('id', '>=', $query_page_index * $query_page_length) // Fetch posts with IDs greater than or equal to the starting ID
                 ->orderBy('id')                 // Ensure they are ordered by ID
                 ->limit($query_page_length)                     // Limit to 20 posts
                 ->get();

            return response()->json([
                'data'=> $posts,  
            ]);     
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validate = $request->validate([
            'title'=> ['required', 'string', 'max:255'], // Required, must be a string, maximum 255 characters
            'description'=> ['required', 'string'], // Required, must be a string
            'start_date'=> ['required', 'date'], // Required, must be a valid date
            'end_date'=> ['required', 'date', 'after_or_equal:start_date'], // Required, must be a valid date, after or equal to the start date
            'location_name'=> ['required', 'string', 'max:255'], // Required, must be a string, maximum 255 characters
            'location_url'=> ['nullable', 'url'], // Optional, must be a valid URL if provided
            'event_image_url'=> ['nullable', 'url'], // Optional, must be a valid URL if provided
            'owner_id'=> ['required', 'integer'], // Required, must be an integer, must exist in the users table
            'entry_fee'=> ['nullable', 'numeric', 'min:0'], // Optional, must be a number, minimum value of 0
            'restriction_age_min'=> ['nullable', 'integer', 'min:0'], // Optional, must be an integer, minimum value of 0
            'restriction_age_max'=> ['nullable', 'integer', 'gte:restriction_age_min'], // Optional, must be an integer, greater than or equal to minimum age
            'accecciblity_disablity'=> ['nullable', 'boolean'], // Optional, must be true or false
        ]);

        // dd($validate);


        // $eventPost = new EventPost();
        // $eventPost->title = $request->title;
        // $eventPost->description = $request->description;
        // $eventPost->start_date = $request->start_date;
        // $eventPost->end_date = $request->end_date;
        // $eventPost->location_name = $request->location_name;
        // $eventPost->location_url = $request->location_url;
        // $eventPost->event_image_url = $request->event_image_url;
        // $eventPost->owner_id = $request->owner_id;
        // $eventPost->entry_fee = $request->entry_fee;
        // $eventPost->restriction_age_min = $request->restriction_age_min;
        // $eventPost->accecciblity_disablity = $request->accecciblity_disablity;

        // $eventPost->save();

        // return response()->json([
        //     'data'=> $eventPost,  
        // ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
