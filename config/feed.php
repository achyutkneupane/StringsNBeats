<?php

return [
    'feeds' => [
        'news' => [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * 'App\Model@getAllFeedItems'
             *
             * You can also pass an argument to that method:
             * ['App\Model@getAllFeedItems', 'argument']
             */
            'items' => 'App\Models\Article@getFeedNews',

            /*
             * The feed will be available on this url.
             */
            'url' => '/feed/news',

            'title' => 'Strings N\' Beats News Feed',
            'description' => 'RSS Feed for News in Strings N\' Beats.',
            'language' => 'en-US',

            /*
             * The view that will render the feed.
             */
            'view' => 'feed::atom',

            /*
             * The type to be used in the <link> tag
             */
            'type' => 'application/atom+xml',
        ],
        'new-releases' => [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * 'App\Model@getAllFeedItems'
             *
             * You can also pass an argument to that method:
             * ['App\Model@getAllFeedItems', 'argument']
             */
            'items' => 'App\Models\Article@getFeedNewReleases',

            /*
             * The feed will be available on this url.
             */
            'url' => '/feed/new-releases',

            'title' => 'Strings N\' Beats New Releases Feed',
            'description' => 'RSS Feed for New Releases Articles in Strings N\' Beats.',
            'language' => 'en-US',

            /*
             * The view that will render the feed.
             */
            'view' => 'feed::atom',

            /*
             * The type to be used in the <link> tag
             */
            'type' => 'application/atom+xml',
        ],
        'articles' => [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * 'App\Model@getAllFeedItems'
             *
             * You can also pass an argument to that method:
             * ['App\Model@getAllFeedItems', 'argument']
             */
            'items' => 'App\Models\Article@getFeedArticles',

            /*
             * The feed will be available on this url.
             */
            'url' => '/feed/articles',

            'title' => 'Strings N\' Beats Articles Feed',
            'description' => 'RSS Feed for Articles in  Strings N\' Beats.',
            'language' => 'en-US',

            /*
             * The view that will render the feed.
             */
            'view' => 'feed::atom',

            /*
             * The type to be used in the <link> tag
             */
            'type' => 'application/atom+xml',
        ],
    ],
];
