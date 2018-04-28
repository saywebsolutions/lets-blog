<?xml version="1.0" encoding="UTF-8"?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/" xmlns:moz="http://www.mozilla.org/2006/browser/search/">
    <ShortName>{{ config('letsblog.site.name' )}}</ShortName>
    <Description>Search {{ config('letsblog.site.name') }}</Description>
    <Image height="16" width="16" type="image/x-icon">{{ url('/') }}/favicon.ico</Image>
    <Url type="text/html" method="get" template="{{ route('search') }}?q={searchTerms}" />
</OpenSearchDescription>
