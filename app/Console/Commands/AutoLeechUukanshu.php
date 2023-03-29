<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class AutoLeechUukanshu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leech:uukanshu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Leech https://www.uukanshu.com/';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    const URL = 'https://www.uukanshu.com/b/';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (setting('is_leech_on_uukanshu', false)) {
            $admin = User::where('is_vip', 1)->first();
            $count = 0;
            do {
                if (Carbon::now()->diffInDays(setting('leech_uukanshu_last_success_date', Carbon::now())) > 1) {
                    setting()->put('leech_uukanshu_book_id', setting('leech_uukanshu_last_success_id', 1) + 1);
                }
                $url = self::URL . setting('leech_uukanshu_book_id', 1) . '/';
                $result = embedStoryUukanshu($url, '', $admin, null, true);
                if ($result) {
                    $count++;
                    setting()->put('leech_uukanshu_last_success_id', setting('leech_uukanshu_book_id', 1));
                    setting()->put('leech_uukanshu_last_success_date', Carbon::now());
                }
                setting()->put('leech_uukanshu_book_id', setting('leech_uukanshu_book_id', 1) + 1);
            } while ($count < 5 || setting('leech_uukanshu_book_id', 1) - setting('leech_uukanshu_last_success_id', 1) > 10000);
        }
        return 0;
    }
}