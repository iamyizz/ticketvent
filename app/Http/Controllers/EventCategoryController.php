<?php
namespace App\Http\Controllers;

use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    public function index()
    {
        $categories = EventCategory::all();
        return view('event_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('event_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        EventCategory::create($request->all());
        return redirect()->route('event-categories.index')->with('success', 'Category created successfully.');
    }

    public function show(EventCategory $eventCategory)
    {
        return view('event_categories.show', compact('eventCategory'));
    }

    public function edit(EventCategory $eventCategory)
    {
        return view('event_categories.edit', compact('eventCategory'));
    }

    public function update(Request $request, EventCategory $eventCategory)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $eventCategory->update($request->all());
        return redirect()->route('event-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(EventCategory $eventCategory)
    {
        $eventCategory->delete();
        return redirect()->route('event-categories.index')->with('success', 'Category deleted successfully.');
    }
}
