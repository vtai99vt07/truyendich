<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoLeechFaloo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leech:faloo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Leech https://wap.faloo.com/';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    const URL = "https://wap.faloo.com/1";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (setting('is_leech_on_faloo', false)) {
            $admin = User::where('id', 16)->first();
            $count = 0;
            do {
                if (Carbon::now()->diffInDays(setting('leech_faloo_last_success_date', Carbon::now())) > 1) {
                    setting()->put('leech_faloo_book_id', setting('leech_faloo_last_success_id', 1) + 1);
                }
                $url = self::URL . sprintf('%06d', setting('leech_faloo_book_id', 1)) . '.html';
                $result = embedStoryUukanshu($url, '', $admin, null, true);
                if ($result) {
                    $count++;
                    setting()->put('leech_faloo_last_success_id', setting('leech_faloo_book_id', 1));
                    setting()->put('leech_faloo_last_success_date', Carbon::now());
                }
                setting()->put('leech_faloo_book_id', setting('leech_faloo_book_id', 1) + 1);
            } while ($count < 5 || setting('leech_faloo_book_id', 1) - setting('leech_faloo_last_success_id', 1) > 10000);
        }
        return 0;
    }
}
