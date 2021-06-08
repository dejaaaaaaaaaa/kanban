<?php

namespace App\Models;

use App\Enums\TicketAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id'   ,
        'action'      ,
        'user_id'     ,
        'created_by'  ,
        'updated_by'  ,

    ];

    protected $appends = ['ticket_action'];

    /**
     * Get ticket
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class)->withTrashed();
    }

    /**
     * Get user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return string
     */
    public function getTicketActionAttribute()
    {
        return TicketAction::getDescription($this->action);
    }
}
