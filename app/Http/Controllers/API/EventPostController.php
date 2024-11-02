<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EventPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventPostController extends Controller
{


    public function index(Request $request)
{
    $page_length = $request->query('page_length', 20);
    $posts = EventPost::orderBy('id')->paginate($page_length);

    return response()->json($posts);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $eventPost = EventPost::create(
                $request->validate([
                    'title' => ['required', 'string', 'max:255'],
                    'description' => ['required', 'string'],
                    'start_date' => ['required', 'date'],
                    'end_date' => ['required', 'date', 'after_or_equal:start_date'],
                    'location_name' => ['required', 'string', 'max:255'],
                    'location_url' => ['nullable', 'url'],
                    'event_image_url' => ['nullable', 'url'],
                    'owner_id' => ['required', 'integer', 'exists:users,id'],
                    'entry_fee' => ['nullable', 'numeric', 'min:0'],
                    'restriction_age_min' => ['nullable', 'integer', 'min:0'],
                    'restriction_age_max' => ['nullable', 'integer', 'gte:restriction_age_min'],
                    'accecciblity_disablity' => ['nullable', 'boolean'],
                ])
            );

            return response()->json(["message" => "Success, event created successfully", "data" => $eventPost], 201);

        } catch (\Exception $e) {
            return response()->json(["message" => "Error creating event"], 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $eventPost = EventPost::where('id',$id)->first();
            

        if ($eventPost) {
            return response()->json(
                ["data"=> $eventPost] ,200
            );
        }else {
            return response()->json(
                ["message" => "Event not found"], 404
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
        try {
            $validatedData = $request->validate(
                [
                'title'=> ['required', 'string', 'max:255'], // Required, must be a string, maximum 255 characters
                'description'=> ['required', 'string'], // Required, must be a string
                'start_date'=> ['required', 'date'], // Required, must be a valid date
                'end_date'=> ['required', 'date', 'after_or_equal:start_date'], // Required, must be a valid date, after or equal to the start date
                'location_name'=> ['required', 'string', 'max:255'], // Required, must be a string, maximum 255 characters
                'location_url'=> ['nullable', 'url'], // Optional, must be a valid URL if provided
                'event_image_url'=> ['nullable', 'url'], // Optional, must be a valid URL if provided
                'entry_fee'=> ['nullable', 'numeric', 'min:0'], // Optional, must be a number, minimum value of 0
                'restriction_age_min'=> ['nullable', 'integer', 'min:0'], // Optional, must be an integer, minimum value of 0
                'restriction_age_max'=> ['nullable', 'integer', 'gte:restriction_age_min'], // Optional, must be an integer, greater than or equal to minimum age
                'accecciblity_disablity'=> ['nullable', 'boolean'], // Optional, must be true or false
                ]
            );

            // dd($request->all());
            // Fetch the record by 'id'
            $eventPost = EventPost::findOrFail($id);
           
    
            // Update the record
            $eventPost->title = $validatedData['title'];
            $eventPost->description = $validatedData['description'];
            $eventPost->start_date = $validatedData['start_date'];
            $eventPost->end_date = $validatedData['end_date'];
            $eventPost->location_name = $validatedData['location_name'];
            $eventPost->location_url = $validatedData['location_url'];
            $eventPost->event_image_url = $validatedData['event_image_url'];
            $eventPost->entry_fee = $validatedData['entry_fee'];
            $eventPost->restriction_age_min = $validatedData['restriction_age_min'];
            $eventPost->restriction_age_max = $validatedData['restriction_age_max'];
            $eventPost->accecciblity_disablity = $validatedData['accecciblity_disablity'];

            // Save the updated record to the database
            $eventPost->save();
    
            // Return success response
            return response()->json(['message' => 'Event Post updated successfully!', 'event_post' => $eventPost], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the user is not found
            return response()->json(['error' => 'Event Post not found'], 404);
        } catch (\Exception $e) {
            // Handle other potential errors
            return response()->json(['error' => 'Failed to update Event Post. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Attempt to find the event post by ID
            $eventPost = EventPost::findOrFail($id);
    
            // Delete the event post
            $eventPost->delete();
    
            // Log the deletion (optional)
            Log::info("Event post with ID $id has been deleted.");
    
            // Return success response
            return response()->json(['message' => 'Event post deleted successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // If the event post is not found, return a 404 response
            return response()->json(['error' => 'Event post not found'], 404);
        } catch (\Exception $e) {
            // Handle any other potential errors
            return response()->json(['error' => 'Failed to delete event post. ' . $e->getMessage()], 500);
        }
    }
}
