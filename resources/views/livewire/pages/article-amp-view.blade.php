<!doctype html>
<html ⚡ amp lang="en">

<head>
    <meta charset="utf-8">
    <link rel="amphtml" href="{{ strtolower(route('viewAmpArticle',$article->slug)) }}">
    <link rel="canonical" href="{{ strtolower(route('viewArticle',$article->slug)) }}">
    <title>{{ $article->title }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ $article->title }}">
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta property='article:published_time' content='{{ $article->created_at }}' />
    <meta property='article:section' content='article' />

    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $article->title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $coverImage }}">
    <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $article->title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $coverImage }}">
    <meta name="twitter:site" content="@strings_beats">
    {!! $schemaScripts !!}
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
    <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
    <script async custom-element="amp-facebook" src="https://cdn.ampproject.org/v0/amp-facebook-0.1.js"></script>
    <script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
    <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="Strings N' Beats">
    <link rel="icon" type="image/png" href="{{ asset('statics/snb-favicon.png') }}"/>
    <style amp-boilerplate>
        body {
            -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            animation: -amp-start 8s steps(1, end) 0s 1 normal both
        }

        @-webkit-keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

        @-moz-keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

        @-ms-keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

        @-o-keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

        @keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

    </style><noscript>
        <style amp-boilerplate>
            body {
                -webkit-animation: none;
                -moz-animation: none;
                -ms-animation: none;
                animation: none
            }

        </style>
    </noscript>

    <style amp-custom>
        body {
            padding: 5%;
            text-align: justify;
            font-family: 'Titillium Web', sans-serif;
        }

        amp-social-share.rounded {
            border-radius: 50%;
            background-size: 60%;
            color: #ffffff;
            background-color: #d9534f;
        }

        a {
            color: #d9534f;
            font-weight: bolder;
        }

        blockquote {
            background: #f9f9f9;
            border-left: 10px solid #d9534f;
            margin: 1.5em 10px;
            padding: 0.5em 10px;
            quotes: "\201C""\201D""\2018""\2019";
        }

        h1 {
            text-transform: uppercase;
            text-align: center;
        }

        @media only screen and (min-width: 550px) {
            body {
                display: flex;
                flex-direction: row;
                justify-content: center;
                padding-top: 0px;
                padding-bottom: 0px;
            }
            body div {
                padding-top: 40px;
                padding-left: 5%;
                padding-right: 5%;
                width: 500px;
            }
        }
    </style>
</head>

<body>
    <div>
        <a href='{{ route('homepage') }}'><amp-img src="http://stringsnbeats.net/statics/logo-text.webp" height="46" layout="fixed-height" style="margin-bottom: 25px;"></amp-img></a>
        <amp-img
            src="{{ $article->cover ? $article->cover->getUrl('big') : '' }}"
            width="500" height="350"
            alt="{{ $article->title }} - {{ config('app.name') }}"
            layout="responsive">
        </amp-img>
        <h1>{{ $article->title }}</h1>
        <h3 class="mt-2 text-capitalize">
            Category: <a href='{{ route('viewCategory',$article->category->slug) }}' target='_blank'><strong>{{ $article->category->title }}</strong></a>
        </h3>
        <div>
            <amp-social-share class="rounded" aria-label="Share by email " type="email" width="40" height="40">
            </amp-social-share>
            <amp-social-share class="rounded" aria-label="Share on Facebook" type="facebook" width="40" height="40">
            </amp-social-share>
            <amp-social-share class="rounded" aria-label="Share on LinkedIn" type="linkedin" width="40" height="40">
            </amp-social-share>
            <amp-social-share class="rounded" aria-label="Share on Twitter" type="twitter" width="40" height="40">
            </amp-social-share>
            <amp-social-share class="rounded" aria-label="Share on WhatsApp" type="whatsapp" width="40" height="40">
            </amp-social-share>
        </div>
        {!! $content !!}
        <div>
            <amp-social-share class="rounded" aria-label="Share by email " type="email" width="40" height="40">
            </amp-social-share>
            <amp-social-share class="rounded" aria-label="Share on Facebook" type="facebook" width="40" height="40">
            </amp-social-share>
            <amp-social-share class="rounded" aria-label="Share on LinkedIn" type="linkedin" width="40" height="40">
            </amp-social-share>
            <amp-social-share class="rounded" aria-label="Share on Twitter" type="twitter" width="40" height="40">
            </amp-social-share>
            <amp-social-share class="rounded" aria-label="Share on WhatsApp" type="whatsapp" width="40" height="40">
            </amp-social-share>
        </div>
        <h2 style='text-align: center; text-transform: uppercase;'>
            More Articles
        </h2>
        @foreach ($latests as $latest)
            <div style='margin-left: auto; margin-right: auto; margin-bottom: 40px; width: 85%;'>
                <amp-img
                    src="{{ $latest->cover ? $latest->cover->getUrl('medium') : '' }}"
                    width="500" height="500"
                    alt="{{ $latest->title }} - {{ config('app.name') }}"
                    layout="responsive">
                </amp-img>
                <a href='{{ route('viewAmpArticle',$latest->slug) }}' style='text-decoration: none;'>
                    <h3 style='margin-top: 10px; margin-bottom: 10px; padding-left: 10px; padding-right: 10px; text-align: center; text-transform: uppercase;'>
                        {{ $latest->title }}
                    </h3>
                </a>
            </div>
        @endforeach
    </div>
    <amp-analytics type="gtag" data-credentials="include">
        <script type="application/json">
            {
                "vars" : {
                    "gtag_id": "UA-176442345-2",
                    "config" : {
                        "UA-176442345-2": { "groups": "default" }
                    }
                }
            }
        </script>
    </amp-analytics>
    <amp-analytics type="gtag" data-credentials="include">
        <script type="application/json">
            {
                "vars" : {
                    "gtag_id": "G-HS0XEPQE5K",
                    "config" : {
                        "G-HS0XEPQE5K": { "groups": "default" }
                    }
                }
            }
        </script>
    </amp-analytics>
    <amp-analytics type="gtag" data-credentials="include">
        <script type="application/json">
            {
                "vars" : {
                    "gtag_id": "G-R4S36RJSZ2",
                    "config" : {
                        "G-R4S36RJSZ2": { "groups": "default" }
                    }
                }
            }
        </script>
    </amp-analytics>
</body>
</html>
