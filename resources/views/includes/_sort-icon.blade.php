@php
    // Determine which icon to show
    if ($sortField !== $field) {
        $icon = 'selector';
    } elseif ($sortAsc) {
        $icon = 'chevron-up';
    } else {
        $icon = 'chevron-down';
    }
@endphp

<i class="icon-{{ $icon }}"></i>
