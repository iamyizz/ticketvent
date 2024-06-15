<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Ticket;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        return view('admin1.index');
    }

    public function dashboard() {
        $data = Event::with('tickets', 'category')->get();
        $category = EventCategory::all();
        return view('home.index', compact('data','category'));
    }
    public function home() {
        $data = Event::with('tickets', 'category')->get();
        $category = EventCategory::all();
        return view('home.index', compact('data','category'));
    }

    public function event_detail($id) {
        $data = Event::find($id);
        $category = EventCategory::all();
        $ticket = Ticket::where('event_id', $id)->first(); 
        return view('home.product', compact('data', 'category', 'ticket'));
    }

    public function store(Request $request)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);
        $quantity = $request->quantity;
        if($ticket && $ticket->quantity >= $quantity) {
            $order = new Order();
            $ticket->quantity -= $quantity;
            $ticket->save();
        }
        $totalPrice = $ticket->price * $quantity;

        $order->user_id = Auth::id();
        $order->ticket_id = $ticket->id;
        $order->quantity = $quantity;
        $order->total_harga = $totalPrice;
        $order->save();

        toastr()->success('Pesanan telah terbuat');
        return redirect()->back();
    }

    public function search(Request $request) {
        $category_id = $request->input('category_id');
        $query = $request->input('query');
    
        // Redirect to the results page with parameters stored in session or as flash data
        return redirect()->route('search.results', compact('category_id', 'query'));
    }
    
    public function searchResults(Request $request) {
        $category_id = $request->input('category_id');
        $query = $request->input('query');
        $category = EventCategory::all();
    
        $data = Event::with('tickets', 'category')
            ->when($category_id, function ($query, $category_id) {
                return $query->where('category_id', $category_id);
            })
            ->when($query, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->get();
    
        return view('home.index', compact('data', 'category'));
    }

    public function showByCategory($categoryName)
    {
        $events = Event::whereHas('category', function($query) use ($categoryName) {
            $query->where('name', $categoryName);
        })->get();

        $category = EventCategory::all();
        return view('home.eventlist', compact('events', 'categoryName', 'category'));
    }
}
