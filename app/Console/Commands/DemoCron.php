<?php

namespace App\Console\Commands;

use App\Models\CashinCashout;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

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
     * @return int
     */
    public function handle()
    {
        //run test
        $result = DB::select("SELECT ts.client_id,SUM(ts.sale_amount) as SalesAmount,a.commission,
        (cio.coin_amount + (a.commission/100)* SUM(ts.sale_amount)) as UpdateAmt
        FROM twod_sales_lists ts left join agents a ON a.id = ts.client_id left join
        cashin_cashouts cio on ts.client_id = cio.agent_id group by ts.client_id,a.commission,cio.coin_amount");
           foreach($result as $re){
            info(CashinCashout::where('agent_id','=',$re->client_id)->update(['coin_amount'=>$re->UpdateAmt]));
         }
    }
}
