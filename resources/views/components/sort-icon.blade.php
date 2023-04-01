@props(['sortBy', 'sortAsc', 'sortField'])

@if ($sortBy == $sortField)   
    @if (!$sortAsc)    
        <i class="fa fa-sort-up float-right mt-1"></i> 
    @endif
    @if ($sortAsc)   
        <i class="fa fa-sort-down float-right mt-1"></i>
    @endif
@else
    <i class="fa fa-sort float-right mt-1"></i>
@endif
