<?php

namespace App\Models;

use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    use HasFactory, ObservantTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'       ,
        'description' ,
        'status_id'   ,
        'priority_id' ,
        'user_id'     ,
        'created_by'  ,
        'updated_by'  ,

    ];

    /**
     * The attributes that should be cast to date format.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];

    /**
     * Get the status of ticket
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the priority for the ticket
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    /**
     * Get the ticket user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get creator of the ticket
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get user who last updated ticket
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopeOfStatusSearch(Builder $query, string $phrase)
    {
        $query->orWhereHas('status', function ($q) use ($phrase){
            $q->where(DB::raw('lower(status)'), 'like', '%' . strtolower($phrase) . '%');
        });
    }

    public function scopeOfPrioritySearch(Builder $query, string $phrase)
    {
        $query->orWhereHas('priority', function ($q) use ($phrase){
            $q->where(DB::raw('lower(priority)'), 'like', '%' . strtolower($phrase) . '%');
        });
    }
}
