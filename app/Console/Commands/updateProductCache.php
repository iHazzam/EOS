<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class updateProductCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache the playdale products in the DB for a day or until manually changed';

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
        $productdata = DB::connection('sqlsrv')->table('dbo.vw_PhilsExportOrderForm')->get();
        $product_json = [];
        $bar = $this->output->createProgressBar(count($productdata));
        foreach ($productdata as $product)
        {
            $image = $this->getImageFromProductCode($product["Code"]);
            $prodjs = [
                "code" => $product["Code"],
                "Name" => $product["Name"],
                "imageurl" => $image,
                "group" => $product['Prod Group'],
                "price" => $product['Price'],
                ];
            $product_json[] = $prodjs; //append it to the big json array
        }
        $expiresAt = Carbon::tomorrow();
        Cache::put('products', json_encode($product_json), $expiresAt);
    }
    private function getImageFromProductCode($productcode)
    {
        return DB::table('product_images')->where('code','=',$productcode)->pluck();
    }
}
