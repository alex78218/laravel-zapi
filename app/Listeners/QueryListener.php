<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class QueryListener
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
     * @param  QueryExecuted  $event
     * @return void
     */
    public function handle(QueryExecuted $event)
    {
        try{
            if (true || env('APP_DEBUG') == true) {
                $sql = str_replace("?", "'%s'", $event->sql);
                $sql = str_replace("%", "@", $sql);
                foreach ($event->bindings as $i => $binding) {
                    if ($binding instanceof DateTime) {
                        $event->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                    } else {
                        if (is_string($binding)) {
                            $event->bindings[$i] = "'$binding'";
                        }
                    }
                }
                $log = vsprintf($sql, $event->bindings);
                $log = $log.'  [RunTime:'.$event->time.'ms] ';
                Log::channel('sql')->info($log);
            }
        }catch (Exception $e){
            Log::channel('sql')->info($e->getMessage());
        }
    }
}
