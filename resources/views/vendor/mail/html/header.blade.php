@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Voldex')
                <img width="100" src="{{ asset('assets/img/logo.png') }}" alt="Voldex Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
