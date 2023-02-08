<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class AddImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds images to storage';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {        
        try {
            $imagesDir = opendir(readline());

            while (($file = readdir($imagesDir)) !== false) {
                echo Storage::disk('public')
                    ->put('imgs/consoled/' . basename($file), $file)
                    ->url();
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        return Command::SUCCESS;
    }
}
