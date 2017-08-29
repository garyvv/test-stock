<?php

namespace App\Console\Commands;

use App\Services\TestServices;
use Illuminate\Console\Command;
use App\Services\RabbitMQ;

class QueueDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Queue:Demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test RabbitMQ Demo';

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
        //
//        echo PHP_EOL . 'Demo' . PHP_EOL;
        $rabbit = new RabbitMQ();

        $message = 'test queue : ' . date('Y-m-d H:i:s');
        $queue = 'demo';
        $rabbit->publishMessage($message, $queue);

//        $msg = $rabbit->getMessage($queue);
//        echo PHP_EOL;
//        var_dump($msg);
//        echo PHP_EOL;


    }

}
