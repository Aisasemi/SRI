<?php

namespace Aisasemi\SRI\Commands;

use Illuminate\Console\Command;

class SRIClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sri:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear sri-manifest.json file.';

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
        \file_put_contents(\public_path('sri-manifest.json'), '{}');
        return 0;
    }
}
