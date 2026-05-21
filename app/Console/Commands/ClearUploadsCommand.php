<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearUploadsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-uploads-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $products = Storage::disk('public')->allFiles('products');
        Storage::disk('public')->delete($products);
        $thumbnails = Storage::disk('public')->allFiles('thumbnails');
        Storage::disk('public')->delete($thumbnails);
        $videos = Storage::disk('public')->allFiles('videos');
        Storage::disk('public')->delete($videos);

        $this->info('Successfully cleared all uploaded files.');
    }

}
