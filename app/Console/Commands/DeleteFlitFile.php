<?php

namespace App\Console\Commands;

use App\Models\Flit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteFlitFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:flit-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete file in the share directory after 1 day the user uploaded the fil';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fileshare = Flit::where('expires', '<=', now())->select(['slug']);
        if ($fileshare->count() > 0) {
            foreach ($fileshare->get() as $file) {
                Storage::disk('share')->deleteDirectory($file->slug);
            }
            $fileshare->delete();
        }
    }
}
