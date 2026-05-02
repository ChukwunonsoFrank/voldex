<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
    {{ config('app.name') }}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
    {{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }} Global. {{ __('All rights reserved.') }}
<br><br>
<a href="https://app.voldexglobal.com" target="_blank" rel="noopener noreferrer">app.voldexglobal.com</a> | <a href="mailto:voldexcustomersservice@gmail.com">voldexcustomersservice@gmail.com</a>
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
