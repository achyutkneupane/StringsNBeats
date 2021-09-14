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
                <![CDATA[
                    @include('layouts._rss')
                ]]>
            </content:encoded>
            <guid isPermaLink="false">
                {{ route('viewArticle',$article->slug) }}
            </guid>
            <description>
                <![CDATA[
                    {{ $article->description }}
                ]]>
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