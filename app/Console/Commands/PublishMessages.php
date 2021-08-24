<?php

namespace App\Console\Commands;

use App\Models\Message;
use App\Models\Subscriber;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PublishMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broadcast:messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command publishes messages to various subscribers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $messages = Message::whereNull('sent_date')->get();

        if (! $messages){
            return;
        }

        foreach($messages as $message){
            $subscribers = Subscriber::whereTopic($message->topic)->get();
    
            foreach($subscribers as $subscriber){

                Log::info("Posting to $subscriber->url, the message $message->message with topic $message->topic");

                try{

                    Http::post($subscriber->url, [
                        'topic' => $message->topic,
                        'data' => $message->message
                    ]);

                    Log::info("Posting to $subscriber->url, the message $message->message with topic $message->topic successful.");

                }catch(Exception $e){
                  Log::error("Posting to $subscriber->url, the message $message->message with topic $message->topic failed.");
                  Log::error($e);
                }

                
            }

            $update_message = Message::find($message->id);
            $update_message->sent_date = now();
            $update_message->save();
        }
    }
}
