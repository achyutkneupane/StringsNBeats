<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
    <channel>
      <title>{{ $title }}</title>
      <link>{{ url('/') }}</link>
      <description>
          A short description about your blog.
      </description>
      <language>en-us</language>
      <lastBuildDate>{{ date('c') }}</lastBuildDate>
      @forelse($articles as $key => $article)
        <item>
          <title><![CDATA[{{ $article->title }}]]></title>
          <link>{{ route('viewArticle',$article->slug) }}</link>
          <guid>{{ $article->guid }}</guid>
          <pubDate>{{ date('c', strtotime($article->created_at)) }}</pubDate>
          <author>Strings N Beats</author>
          <description><![CDATA[{{ $article->description }}]]></description>
          <content:encoded>
            <![CDATA[
              @include('layouts._rss')
            ]]>
          </content:encoded>
        </item>
      @empty
        <item>No articles found</item>
      @endforelse
    </channel>
  </rss>