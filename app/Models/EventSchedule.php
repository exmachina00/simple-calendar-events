<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    protected $table = 'event_schedules';

    protected $primaryKey = 'event_schedule_id';

    protected $hidden = ['event_id'];

    protected $fillable = ['schedule'];

    public $timestamps = false;

    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }
}
