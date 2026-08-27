@extends('client.layouts.app')

@section('title', $metaTitle ?: $title)

@section('styles')
<style id="client-page-css">
    *, *::before, *::after { box-sizing: border-box; }
    body { margin: 0; color: #20242a; font-family: Arial, sans-serif; }
    img { max-width: 100%; }
    {!! $css !!}
</style>
@endsection

@section('content')
    @if($headerHtml)
        <header id="client-page-header">{!! $headerHtml !!}</header>
    @endif
    <main id="client-page-{{ $page->id }}">
        {!! $renderedHtml !!}
    </main>
    @if($footerHtml)
        <footer id="client-page-footer">{!! $footerHtml !!}</footer>
    @endif
@endsection
