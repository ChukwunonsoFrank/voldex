@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Yfxai')
                <img width="100" src="{{ asset('wp-content/uploads/2023/05/yfxai-logo-dark.png') }}" alt="Yfxai Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
