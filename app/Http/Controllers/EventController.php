<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\EventSchedule;

class EventController extends Controller
{
    public function index()
    {
        return view('index')->with('data', [
            'rs' => EventSchedule::with('event')->get(),
        ]);
    }

    /**
     * Handles saving the schedules to persistent storage
     * @param  EventRequest $request
     */
    public function store(EventRequest $request)
    {
        $savedSchedules = [];

        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);

        $event = Event::firstOrCreate(['name' => $request->name]);

        $includedDays = $request->input('days', []);

        while ($from->lessThanOrEqualTo($to)) {

            if ($this->isDayNotIncluded($from, $includedDays)) {
                $from->addDay();
                continue;
            }

            $schedule = EventSchedule::where('schedule', $from)->first();

            if ($schedule) {
                $schedule->event()->associate($event)->save();
            } else {
                $event->schedules()->firstOrCreate([
                    'schedule' => $from->toDateString(),
                ]);
            }
            
            $savedSchedules[] = $from->toDateString();

            $from->addDay();
        }

        $event->schedules()
            ->whereNotIn('schedule' , $savedSchedules)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => __('success.add', ['module' => __('content.event')]),
            'data' => EventSchedule::with('event')->get(),
        ]);
    }

    /**
     * Checks if date is not included
     * @param  Carbon  $date         
     * @param  array   $includedDays 
     * @return boolean               
     */
    protected function isDayNotIncluded(Carbon $date, $includedDays = []) : bool
    {
        return ! $this->isDayIncluded($date, $includedDays);
    }

    /**
     * Checks if date is included
     * @param  Carbon  $date        
     * @param  array   $includedDays
     * @return boolean              
     */
    protected function isDayIncluded(Carbon $date, $includedDays = []) : bool
    {
        return in_array($date->dayOfWeek, $includedDays);
    }
}
