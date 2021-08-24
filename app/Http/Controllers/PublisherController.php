<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function __invoke(Request $request, $topic)
    {
       Message::create([
           'topic' => $topic,
           'message' => $request->message
       ]);

       

       return response()->json([
           'message' => 'success'
       ], 201);
    }
}
