<!doctype html>
<html lang="en" prefix="op: http://media.facebook.com/op#">
    <head>
        <meta charset="utf-8">
        <meta property="op:markup_version" content="v1.0">
        <meta property="fb:article_style" content="default"/>
        <link rel="canonical" href="{{ route('viewArticle',$article->slug) }}">
        <title>{{ $article->title }}</title>
    </head>
    <body>
    <article>
        <header>
            <h1>{{  $article->title  }}</h1>
            <h2> {{ $article->description }}</h2>
            <h3 class="op-kicker">
                {{ $article->category->title }}
            </h3>
            <address>
                Strings N' Beats
            </address>
            <time class="op-published" dateTime="{{ $article->created_at->format('c') }}">{{ $article->created_at->format('M d Y, h:i a') }}</time>
            <time class="op-modified" dateTime="{{ $article->updated_at->format('c') }}">{{ $article->updated_at->format('M d Y, h:i a') }}</time>
        </header>

        {{ $article->content }}

        <footer>
        <small>© Strings N' Beats {{ date('Y') }}</small>
        </footer>
    </article>
    </body>
</html>