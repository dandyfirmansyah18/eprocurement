<?php // Company Helper

namespace App\Helpers;

use App\Models\Chat;

class ChatHelper
{

    public static function save_data($data)
    {
    	$message               = new Chat;
        $message->entity_type  = $data['entity_type'];
    	$message->entity_id    = $data['entity_id'];
        $message->sender_id    = $data['sender_id'];
        $message->recipient_id = $data['recipient_id'];
        $message->message      = $data['message'];

    	$message->save();

    	return $message->id;
    }
}