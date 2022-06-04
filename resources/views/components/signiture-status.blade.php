@switch($personelStatusID())
    @case(1)
        {{-- signitured --}}
        <span class="badge bg-success rounded float-end" data-bs-toggle="tooltip" data-bs-placement="left" title="You have signed this form." role="button">
            {{ $personelStatus() }}
        </span>
        @break
    @case(2)
        {{-- unsignitured --}}
        <span class="badge bg-warning rounded float-end" data-bs-toggle="tooltip" data-bs-placement="left" title="Your signiture is missing." role="button">
            {{ $personelStatus() }}
        </span>
        @break
    @case(3)
        {{-- cancelled --}}
        <span class="badge bg-secondary rounded float-end" data-bs-toggle="tooltip" data-bs-placement="left" title="You have cancelled this form." role="button">
            {{ $personelStatus() }}
        </span>
        @break
    @default
        <span class="badge bg-danger rounded float-end" data-bs-toggle="tooltip" data-bs-placement="left" title="You have declined this form." role="button">
            {{ $personelStatus() }}
        </span>
        @break
@endswitch