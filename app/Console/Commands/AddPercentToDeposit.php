<?php

namespace App\Console\Commands;

use App\Deposit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddPercentToDeposit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:percent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $deposits = Deposit::where('active','=','1')->get();
        DB::transaction(function () use ($deposits) {
        foreach ($deposits as $deposit) {
            $percent = ($deposit->invested / 100) * $deposit->percent;
            $deposit->invested += $percent;
            $deposit->accrue_times--;
            if ($deposit->accrue_times == 0) {
                $deposit->active = '0';
            }
            $deposit->save();
        }
        });
    }
}
