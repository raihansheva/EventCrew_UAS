<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::with('panitia', 'kategori', 'divisiVolunteer')->get();

        return view('pages.event' , compact('event'));
    }
}