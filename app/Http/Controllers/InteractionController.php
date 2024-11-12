<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use App\Models\Customer;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    /**
     * Display a listing of the interactions.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Fetch all interactions, with customer details
        $interactions = Interaction::with('customer')->latest()->get();

        return inertia('Interactions/Index', [
            'interactions' => $interactions->toArray(),
            'customers' => Customer::all(), // Pass customers for creating new interactions
        ]);
    }

    /**
     * Store a newly created interaction.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|string',
            'description' => 'required|string',
            'interaction_date' => 'required|date', // Ensure interaction_date is provided
        ]);

        // Create a new interaction
        Interaction::create([
            'customer_id' => $request->customer_id,
            'type' => $request->type,
            'description' => $request->description,
            'interaction_date' => $request->interaction_date, // Use provided date
        ]);

        return redirect()->back()->with('success', 'Interaction added successfully!');
    }

    /**
     * Show the form for editing the specified interaction.
     *
     * @param \App\Models\Interaction $interaction
     * @return \Inertia\Response
     */
    public function edit(Interaction $interaction)
    {
        // Pass the interaction data to the edit view
        return inertia('Interactions/Edit', [
            'interaction' => $interaction,
            'customers' => Customer::all(), // For selecting customers when editing
        ]);
    }

    /**
     * Update the specified interaction in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Interaction $interaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Interaction $interaction)
    {
        // Validate the request
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|string',
            'description' => 'required|string',
            'interaction_date' => 'required|date', // Ensure interaction_date is valid
        ]);

        // Update the interaction
        $interaction->update([
            'customer_id' => $request->customer_id,
            'type' => $request->type,
            'description' => $request->description,
            'interaction_date' => $request->interaction_date, // Update the interaction date
        ]);

        return redirect()->route('interactions.index')->with('success', 'Interaction updated successfully!');
    }

    /**
     * Remove the specified interaction from storage.
     *
     * @param \App\Models\Interaction $interaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Interaction $interaction)
    {
        // Delete the interaction
        $interaction->delete();

        return redirect()->route('interactions.index')->with('success', 'Interaction deleted successfully!');
    }
}
