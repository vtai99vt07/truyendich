<?php

namespace App\Console\Commands;

use App\Domain\Story\Models\Story;
use App\Scraper\LeechXinyushuwu;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoLeechXinyushuwu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leech:xinyushuwu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Leech https://www.xinyushuwu.org/';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    const URL =  'https://www.xinyushuwu.org';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (setting('is_leech_on_xinyushuwu', false)) {
            $count = 0;
            $admin = User::where('is_vip', 1)->first();
            do {
                $bot = new LeechXinyushuwu();
                if (Carbon::now()->diffInDays(setting('leech_xinyushuwu_last_success_date', Carbon::now())) > 1) {
                    setting()->put('leech_xinyushuwu_book_id', setting('leech_xinyushuwu_last_success_id', 1) + 1);
                }
                $bookId = setting('leech_xinyushuwu_book_id', 1);
                if ($bot->scrape($bookId, self::URL, '/0/', $admin)) {
                    $count++;
                    setting()->put('leech_xinyushuwu_last_success_id', setting('leech_xinyushuwu_book_id', 1));
                    setting()->put('leech_xinyushuwu_last_success_date', Carbon::now());
                }
                setting()->put('leech_xinyushuwu_book_id', setting('leech_xinyushuwu_book_id', 1) + 1);
            } while ($count < 5 || setting('leech_xinyushuwu_book_id', 1) - setting('leech_xinyushuwu_last_success_id', 1) > 10000);
        }
        return 0;
    }
}
