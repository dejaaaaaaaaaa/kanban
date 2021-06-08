<?php

namespace App\Listeners;

use App\Events\TicketActionEvent;
use App\Models\TicketHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TicketActionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TicketActionEvent  $event
     * @return void
     */
    public function handle(TicketActionEvent $event)
    {
        $data = [
            'action' => $event->action,
            'user_id'   => $event->ticket->updated_by,
        ];
        $history = new TicketHistory($data);
        $event->ticket->ticketHistories()->save($history);
    }
}
