<?php

namespace App\Console\Commands;

use App\Order;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
class generateOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:generate {order}';
    private $order;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate CSV file in appropriate format given the order';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Order $order)
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

        $oid = $this->argument('order');
        $order = Order::where('id','=',$oid)->first();
        //$export = ['OrderType' => [],'CustAccRef'=> [],'OrderRequestedDate' => [], 'OrderPromisedDate' => [],'CustomerOrderNumber'=> [],'DelPostalName'=> [],'DelAddressLine1'=> [],'DelAddressLine2'=> [],'DelAddressLine3'=> [],'DelAddressLine4'=> [],'DelCity'=> [],'DelPostcode' => [],'DelCountry'=> [], 'DelContact'=> [],'DelTelephone' => [],'DelEmail'=> [],'OrderLineRequestedDate'=> [],'OrderLinePromisedDate'=> [],'LineType'=> [],'ProductCode'=> [],'ProductDescription'=> [],'Warehouse'=> [],'Quantity'=> [],'UnitPrice'=> [],'AnalysisCode1'=> [],'AnalysisCode2'=> [],'AnalysisCode3'=> [],'AnalysisCode4'=> [],'AnalysisCode9'=>[],'AnalysisCode20'=>[]];
        $export2 = [];
        $export2[] = ['OrderType','CustAccRef','OrderRequestedDate','OrderPromisedDate','CustomerOrderNumber','DelPostalName','DelAddressLine1','DelAddressLine2','DelAddressLine3','DelAddressLine4','DelCity','DelPostcode','DelCountry','DelContact','DelTelephone','DelEmail','OrderLineRequestedDate','OrderLinePromisedDate','LineType','ProductCode','ProductDescription','Warehouse','Quantity','UnitPrice','AnalysisCode1','AnalysisCode2','AnalysisCode3','AnalysisCode4','AnalysisCode9','AnalysisCode20'];
//        foreach($order->order_product()->get() as $op) {
//            $export['OrderType'][] = 1;
//            $export['CustAccRef'][] = $order->user()->first()->sage_uid;
//            $export['OrderRequestedDate'][] = $order->delivery_date;
//            $export['OrderPromisedDate'][] = $order->delivery_date;
//            $export['CustomerOrderNumber'][] = $order->purchase_order_reference;
//            $export['DelPostalName'][] = $order->contact_name;
//            $export['DelAddressLine1'][] = $order->address_line1;
//            if ($order->address_line2) {
//                $export['DelAddressLine2'][] = $order->address_line2;
//            } else {
//                $export['DelAddressLine2'][] = "";
//            }
//            $export['DelADdressLine3'][] = "";
//            $export['DelADdressLine4'][] = "";
//            $export['DelCity'][] = $order->city;
//            $export['DelPostcode'][] = $order->postcode;
//            $export['DelCountry'][] = $order->country;
//            $export['DelContact'][] = $order->contact_name;
//            $export['DelTelephone'][] = $order->contact_phone;
//            $export['DelEmail'][] = $order->email;
//            $export['OrderLineRequestedDate'][] = $order->delivery_date;
//            $export['OrderLinePromisedDate'][] = $order->delivery_date;
//            $export['LineType'][] = 1;
//            $export['ProductCode'][] = $op->product_code;
//            $export['ProductDescription'][] = "";
//            $export['Warehouse'][] = "LIN";
//            $export['Quantity'][] = $op->quantity;
//            $export['UnitPrice'][] = $op->price;
//            $export['AnalysisCode1'][] = "EXP EXPORT";
//            $export['AnalysisCode2'][] = "S13 EXPORT";
//            $export['AnalysisCode3'][] = "TRCDTRADE";
//            $export['AnalysisCode4'][] = "Installations";
//            $export['AnalysisCode9'][] = "Export";
//            $export['AnalysisCode20'][] = "N";
//
//        }
    foreach($order->order_product()->get() as $op) {
        $exp = [];
        $exp[] = 1;
        $exp[] = $order->user()->first()->sage_uid;
        $exp[] = $order->delivery_date;
        $exp[] = $order->delivery_date;
        $exp[] = $order->purchase_order_reference;
        $exp[] = $order->contact_name;
        $exp[] = $order->address_line1;
        if ($order->address_line2) {
            $exp[] = $order->address_line2;
        } else {
            $exp[] = "";
        }
        $exp[] = "";
        $exp[] = "";
        $exp[] = $order->city;
        $exp[] = $order->postcode;
        $exp[] = $order->country;
        $exp[] = $order->contact_name;
        $exp[] = $order->contact_phone;
        $exp[] = $order->email;
        $exp[] = $order->delivery_date;
        $exp[] = $order->delivery_date;
        $exp[] = 1;
        $exp[] = $op->product_code;
        $exp[] = "";
        $exp[] = "LIN";
        $exp[] = $op->quantity;
        $exp[] = $op->price;
        $exp[] = "EXP EXPORT";
        $exp[] = "S13 EXPORT";
        $exp[] = "TRCDTRADE";
        $exp[] = "Installations";
        $exp[] = "Export";
        $exp[] = "N";
        $export2[] = $exp;
    }
        Excel::create('Export_Order_' . $order->id, function($excel) use ($export2, $order){

            $excel->setTitle('Export Order ' . $order->id . ' for Playdale');
            $excel->setCreator('PlaydaleEOS');
            $excel->setCompany('Playdale');
            $excel->sheet('Order', function($sheet)use ($export2) {

                $sheet->fromArray($export2,null, 'A1', false, false);

            });

        })->store('csv',storage_path('excel/exports'));
    }
}
