<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class SyncRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步路由到权限表';

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
     * @return mixed
     */
    public function handle()
    {
        $routes = app()->routes->getRoutes();
        $list = [];
        foreach($routes as $k=>$v){
            $path = explode('/',$v->uri);
            if($path[0]=='api' && $v->getName()){
                $list[$k]['name'] = $v->getName();
                $list[$k]['guard_name'] = $path[0];
            }
        }

        app()->cache->forget('spatie.permission.cache');
        foreach($list as $k=>$v){
            Permission::firstOrCreate($v);
            echo $v['name']." insert;\r\n";
        }

    }
}