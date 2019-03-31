<?php

namespace App\Http\Controllers;

use App\Models\{Pet, Order};
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * The available inventory grouped by status
     */
    public function inventory()
    {
        $inventory = Pet::inventory()->get();

        $result = $inventory->flatMap(function($item) {
            return [$item->status => $item->quantity];
        })->toArray();

        return response()->json($result, 200);
    }

    /**
     * Place an order for a pet
     */
    public function order(Request $request)
    {
        $this->validate($request, [
            'petId' => 'required|exists:pets,id',
            'quantity' => 'required|integer',
            'shipDate' => 'required|date',
            'status' => 'required|in:placed,approved,delivered',
            'complete' => 'required|boolean'
        ]);

        $order = Order::create([
            'pet_id' => $request->input('petId'),
            'quantity' => $request->input('quantity'),
            'ship_date' => $request->input('shipDate'),
            'status' => $request->input('status', 'placed'), // Default to 'placed'
            'complete' => $request->input('complete', false), // Default to false
        ]);

        return response()->json($order, 200);
    }

    /**
     * Find purchase order by Id
     */
    public function findOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        return response()->json($order, 200);
    }

    /**
     * Delete order by Id
     */
    public function destroy(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return response()->json(null, 200);
    }
}
