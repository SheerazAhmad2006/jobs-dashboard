@props(['tagsCsv'])

@php
    $tags = collect(explode(',', (string) $tagsCsv))
        ->map(fn ($tag) => trim($tag))
        ->filter(); // removes empty values
@endphp

@if ($tags->count())
<ul class="flex">
    @foreach ($tags as $tag)
        <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
            <a href="/?tag={{ urlencode($tag) }}">{{ $tag }}</a>
        </li>
    @endforeach
</ul>
@endif
