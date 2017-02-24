<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
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

        $prodgrp = "Prod Group"; //TODO: work out discount code information
        $productdata = DB::connection('sqlsrv')->table('dbo.vw_PhilsExportOrderForm')->get();
        $product_json = [];
        $bar = $this->output->createProgressBar(count($productdata));
        foreach ($productdata as $product)
        {
            $image = $this->getImageFromProductCode($product->Code);
            $prodjs = [
                "code" => $product->Code,
                "name" => $product->Name,
                "imageurl" => $image,
                "group" => $product->$prodgrp,
                "price" => round($product->Price,2)
                ];
            $product_json[] = $prodjs; //append it to the big json array
            $bar->advance();
        }
        $expiresAt = Carbon::tomorrow();
        Cache::forget('products');
        Cache::put('products', json_encode($product_json), $expiresAt);
        $bar->finish();
    }
    private function getImageFromProductCode($productcode)
    {
        $turn = DB::table('product_images')->where('code','=',$productcode)->first();
        if($turn == null)
        {
            return asset('storage/default.png');
        }
        else{
            return asset('storage/images'.$turn->path);
        }
    }
}
