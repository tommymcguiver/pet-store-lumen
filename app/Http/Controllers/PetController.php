<?php

namespace App\Http\Controllers;

use App\Models\{Image, Tag, Pet, PetCategory};

use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * The storage folder
     */
    public static $storage = __DIR__ . '/../../../storage/app';

    /**
     * Show a specific pet
     *
     * @param Request $request
     * @param integer $id
     */
    public function show(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        return response()->json($pet, 200);
    }

    /**
     * Add a new pet to the pet store
     *
     * @param Request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'name' => 'required|string|max:255',
            'photoUrls' => 'sometimes|array',
            'photoUrls.*' => 'string',
            'tags' => 'sometimes|array',
            'tags.*.name' => 'required|string|max:255',
        ]);

        // Create a new pet model
        $pet = new Pet($request->only('name', 'status'));

        // If there is a category associated with the
        // pet, find it in the database or create it
        $category = PetCategory::firstOrCreate([
            'name' => $request->input('category.name')
        ], []);

        // Associate the new category with the pet
        $pet->category()->associate($category);

        // Save the pet
        $pet->save();

        if ($request->has('tags')) {
            $tags = collect($request->input('tags'));

            $tags = $tags->map(function($tag) use ($pet) {
                return Tag::firstOrCreate([
                    'name' => $tag['name'],
                ], [])->id;
            });

            // Attach the new tags to the pet
            $pet->tags()->sync($tags->toArray());
        }

        return response()->json($pet, 200);
    }

    /**
     * Update a pet
     *
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, $id = null)
    {
        $this->validate($request, [
            'name' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|in:available,pending,sold',
        ]);

        $pet = Pet::findOrFail($id);
        $pet->update(
            $request->only(['name', 'status'])
        );

        return response()->json($pet, 200);
    }

    /**
     * Find pets by status
     *
     * @param Request $request
     */
    public function findByStatus(Request $request)
    {
        $allowed = ['available', 'pending', 'sold'];

        $statuses = array_filter(
            explode(',', $request->get('status'))
        );

        if (array_diff($statuses, $allowed)) {
            return response()->json(null, 400);
        }

        // Filter pets by status
        $pets = Pet::byStatus($statuses)->get();

        return response()->json($pets, 200);
    }

    /**
     * Delete a pet
     *
     * @NOTE add token auth
     *
     * @param Request $request
     * @param string $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $pet = Pet::findOrFail($id)->load('images');
        $pet->images->each(function($image) {
            $path = static::$storage . "/{$image->filename}";
            if (file_exists($path)) {
                unlink($path);
            }
        });
        $pet->images()->delete();

        $pet->delete();

        return response()->json(null, 200);
    }

    /**
     * Upload a pet image
     */
    public function upload(Request $request, $id)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return response()->json(null, 400);
        }

        // Get the pet
        $pet = Pet::findOrFail($id);

        $originalName = $request->file('file')->getClientOriginalName();
        $extension = $request->file('file')->extension();
        $filename = md5($originalName . microtime()) . '.' . $extension;
        $path = static::$storage . "/$filename";

        // Associate the image with pet
        $image = new Image([
            'filename' => $filename,
            'original_filename' => $originalName,
            'metadata' => json_encode($request->input('additionalMetadata')),
        ]);

        $image->pet()->associate($pet->id);
        $image->save();

        file_put_contents($path, file_get_contents($request->file('file')));

        return response()->json([
            'message' => 'The file was uploaded successfully',
        ], 200);
    }
}
