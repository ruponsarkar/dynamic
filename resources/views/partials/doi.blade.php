@php
    $doiText = trim((string) ($doi ?? ''));
    $doiUrl = \App\Support\PublicationLinks::doi($doiText);
@endphp
@if ($doiText !== '')
    @if ($showLabel ?? true)<b>DOI:</b> @endif
    @if ($doiUrl)
        <a href="{{ $doiUrl }}" target="_blank" rel="noopener noreferrer">{{ $doiText }}</a>
    @else
        {{ $doiText }}
    @endif
@endif
