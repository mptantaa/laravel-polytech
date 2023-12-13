<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatsMail;
use App\Models\Comment;
use App\Models\Stats;
use Illuminate\Console\Command;
use Carbon\Carbon;

class StatsServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statsService';

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
        $totalArticles = Stats::whereDate('created_at', Carbon::today())->count();
        $totalComments = Comment::whereDate('created_at', Carbon::today())->count();

        Stats::truncate();
        Mail::send(new StatsMail($totalArticles, $totalComments));

    }
}
