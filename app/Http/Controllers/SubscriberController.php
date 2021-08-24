<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function __invoke(Request $request, $topic)
    {
        $subscriber = Subscriber::create([
            'url' => $request->url,
            'topic' => $topic
        ]);

        return response()->json([
            'url' => $subscriber->url,
            'topic' => $subscriber->topic
        ], 201);
    }
}
