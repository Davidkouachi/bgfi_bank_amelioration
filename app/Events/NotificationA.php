<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationA implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

      public function broadcastOn()
      {
          return ['my-channel-action-r'];
      }

      public function broadcastAs()
      {
          return 'my-event-action-r';
      }
}
