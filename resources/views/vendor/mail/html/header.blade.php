<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('dist/new/img/logos/marca-de-agua.png') }}" class="logo" alt="Inversiones Meka C.A">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
