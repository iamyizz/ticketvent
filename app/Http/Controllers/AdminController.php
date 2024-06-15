<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\User;
use Flasher\Toastr\Prime\ToastrInterface;

class AdminController extends Controller
{
    public function view_category() {
        $dt = EventCategory::all();
        return view('admin1.kategori', compact('dt'));
    }

    public function add_category(Request $request)
    {
        $category = new EventCategory;
        $category->name = $request->category;
        $category->save();
        toastr()->success('Kategori telah terbuat');
        return redirect()->back();
    }

    public function delete_category($id) {
        $dt = EventCategory::find($id);
        $dt->delete();
        toastr()->info('Kategori telah dihapus');
        return redirect()->back();
    }

    public function edit_category($id) {
        $dt = EventCategory::find($id);
        return view('admin.edit_category', compact('dt'));
    }

    public function update_category(Request $request,$id){
        $dt = EventCategory::find($id);
        $dt->name = $request->category;
        $dt->save();
        return redirect('view_category');
    }

    public function add_event() {
        $category = EventCategory::all();
        return view('admin.add_event',compact('category'));
    }

    public function upload_event(Request $request) {
        $data = new Event;
        $data->name = $request->judul;
        $data->description = $request->deskripsi;
        $data->category_id = $request->category;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $image = $request->foto;
        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->foto->move('events',$imagename);
            $data->image = $imagename;
        }
        $data->save();
        toastr()->success('Event telah terdaftar');
        return redirect()->back();
    }

    public function view_event() {
        $event = Event::paginate(6);
        $category = EventCategory::all();
        return view('admin1.event', compact('event','category'));
    }

    public function delete_event($id) {
        $data = Event::find($id);
        if ($data->image) {
            $image_path = public_path('events/' . $data->image);
            if (file_exists($image_path) && is_file($image_path)) {
                unlink($image_path);
            }
        }
    
        $data->delete();
        toastr()->info('Event telah dihapus');
        return redirect()->back();
    }

    public function update_event($id) {
        $data = Event::find($id);
        $category = EventCategory::all();
        return view('admin.edit_event',compact('data','category',));
    }

    public function edit_event(Request $request,$id) {
        $data = Event::find($id);
        $data->name = $request->judul;
        $data->description = $request->deskripsi;
        $data->category_id = $request->category;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $image = $request->foto;
        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->foto->move('events',$imagename);
            $data->image = $imagename;
        }
        $data->save();
        return redirect('/view_event');
    }

    public function show_event($id) {
        $event = Event::find($id);
        return view('admin.show_event', compact('event'));
    }

    public function view_ticket() {
        $dt = Ticket::all();
        $events = Event::all(); // Ubah variabel menjadi events untuk menghindari konflik nama
        return view('admin1.ticket', compact('dt', 'events'));
    }    

    public function add_ticket(Request $request)
    {
        $ticket = new Ticket;
        $ticket->event_id = $request->event_id;
        $ticket->type = $request->type;
        $ticket->price = str_replace(['Rp', '.'], '', $request->price);
        $ticket->quantity = $request->quantity;
        $ticket->save();
        toastr()->success('Ticket telah terbuat');
        return redirect()->back();
    }

    public function edit_ticket(Request $request, $id)
    {
        $ticket = Ticket::find($id);
    
        if (!$ticket) {
            return redirect()->back()->with('error', 'Ticket not found.');
        }

        $ticket->event_id = $request->input('event_id');
        $ticket->type = $request->input('type');
        $ticket->price = str_replace(['Rp', '.'], '', $request->price);
        $ticket->quantity = $request->input('quantity');
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket updated successfully');
    }

    public function delete_ticket($id) {
        $ticket = Ticket::find($id);
        $ticket->delete();
        toastr()->info('Ticket telah dihapus');
        return redirect()->back();
    }

    public function view_order() {
        $dt = Order::with(['user', 'ticket.event'])->get();
        $ticket = Ticket::all();
        $user = User::all();
        return view('admin1.order', compact('dt','ticket','user'));
    }

    public function store_order(Request $request) {
        $ticket = Ticket::find($request->ticket_id);
        $total_harga = $ticket->price * $request->quantity;
    
        $order = new Order;
        $order->user_id = $request->user_id;
        $order->ticket_id = $request->ticket_id;
        $order->quantity = $request->quantity;
        $order->total_harga = str_replace(['Rp', '.'], '', $request->total_harga);
        $order->save();
    
        toastr()->success('Order telah terbuat');
        return redirect()->back();
    }
}