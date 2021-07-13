<?php

namespace App\Console\Commands;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating Sitemap';

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
        $sitemap = Sitemap::create('https://stringsnbeats.net');
        $sitemap->add(Url::create('/')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setLastModificationDate(Carbon::create('2021', '6', '6'))
                ->setPriority(1));
        $sitemap->add(Url::create('/contact-us')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setLastModificationDate(Carbon::create('2021', '6', '6'))
                ->setPriority(0.9));

        Article::all()->each(function (Article $article) use ($sitemap) {
            if($article->status == 'active') {
                $sitemap->add(Url::create("/{$article->slug}")
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setLastModificationDate($article->updated_at)
                        ->setPriority(0.8));
            }
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
