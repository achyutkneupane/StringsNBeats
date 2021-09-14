<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
    <channel>
        <title>{{ $title }}</title>
        <link>{{ url('/') }}</link>
        <description>
            Strings N’ Beats is the primary destination for Nepali music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.
        </description>
        <language>en-us</language>
        <lastBuildDate>{{ date('c') }}</lastBuildDate>
        @forelse($articles as $key => $article)
        <item>
            <title>{{ $article->title }}</title>
            <link>
            {{ route('viewArticle',$article->slug) }}
            </link>
            <content:encoded>
                <![CDATA[<!doctype html><html><head><link rel="canonical" href="{{ route('viewArticle',$article->slug) }}"/><meta charset="utf-8"/><meta property="op:generator" content="facebook-instant-articles-sdk-php"/><meta property="op:generator:version" content="1.10.0"/><meta property="op:generator:application" content="facebook-instant-articles-wp"/><meta property="op:generator:application:version" content="4.2.1"/><meta property="op:generator:transformer" content="facebook-instant-articles-sdk-php"/><meta property="op:generator:transformer:version" content="1.10.0"/><meta property="op:markup_version" content="v1.0"/><meta property="fb:use_automatic_ad_placement" content="enable=true ad_density=default"/><meta property="fb:article_style" content="default"/></head><body><article><header><figure><img src="{{ $article->cover->getUrl() }}"/></figure><h1>{{ $article->title }}</h1><time class="op-published" datetime="{{ $article->created_at }}">{{ $article->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a') }}</time><time class="op-modified" datetime="{{ $article->updated_at }}">{{ $article->updated_at->isoFormat('MMMM Do YYYY, h:mm:ss a') }}</time><address><a href='{{ route('homepage') }}'>Strings N Beats</a></address><h3 class="op-kicker">{{ $article->category->title }}</h3><figure class="op-ad"><iframe src="https://www.facebook.com/adnw_request?placement=935868386814250_935868403480915&adtype=banner300x250" width="300" height="250"></iframe></figure></header>{{ $article->content }}</article></body></html>]]>
            </content:encoded>
            <guid isPermaLink="false">
                {{ route('viewArticle',$article->slug) }}
            </guid>
            <description>
                <![CDATA[{{ $article->description }}]]>
            </description>
            <pubDate>{{ $article->created_at }}</pubDate>
            <modDate>{{ $article->updated_at }}</modDate>
            <author>Strings N' Beats</author>
        </item>
        @empty
          <item>No articles found.</item>
        @endforelse
    </channel>
</rss>