<?php

namespace App\Console\Commands;

use App\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class cacheToDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:c2db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move the cached products to a DB table';

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
        $storage = Cache::getStore(); // will return instance of FileStore
        $filesystem = $storage->getFilesystem(); // will return instance of Filesystem
        $dir = (Cache::getDirectory());
        $keys = [];
        foreach ($filesystem->allFiles($dir) as $file1) {

            if (is_dir($file1->getPath())) {

                foreach ($filesystem->allFiles($file1->getPath()) as $file2) {
                    $keys = array_merge($keys, [$file2->getRealpath() => unserialize(substr(\File::get($file2->getRealpath()), 10))]);
                    foreach($keys as $key)
                    {
                        $key = json_decode($key);
                        foreach($key as $k)
                        {
                            $p = new Product();
                            $p->code = $k->code;
                            $p->name = $k->name;
                            $p->imageurl = $k->imageurl;
                            $p->discountmod = $k->discountmod;
                            $p->price = $k->price;
                            $p->save();
                        }
                    }
                }
            }
            else {

            }
        }
    }
}
