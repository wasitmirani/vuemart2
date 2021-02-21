
@if(config('meta.Is_seoTags') == '1')
<meta property="fb:pages" content="{{config('meta.meta_title')}}">
<meta name="description" content="{{config('meta.meta_description')}}">
<title>{{config('meta.meta_title')}}</title>
<meta name="twitter:card"content="{{config('meta.meta_description')}}" />
<meta name="twitter:title"content="{{config('meta.meta_title')}}" />
@else
{!! SEOMeta::generate(true) !!}
{!! OpenGraph::generate(true) !!}
{!! Twitter::generate(true) !!}
@endif

@if(isset($metaTitle) && !empty($metaTitle))
<title>{{ $metaTitle }}</title>

@endif
