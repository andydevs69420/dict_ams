@switch($personelStatusID())
    @case(1)
        {{-- signitured --}}
        <span {{ $attributes->merge(["class" => "badge bg-success rounded-pill shadow"]) }} data-bs-toggle="tooltip" data-bs-placement="left" title="You have signed this form." role="button">
            {{ $personelStatus() }}
        </span>
        @break
    @case(2)
        {{-- unsignitured --}}
        <span {{ $attributes->merge(["class" => "badge bg-warning rounded-pill shadow"]) }} data-bs-toggle="tooltip" data-bs-placement="left" title="Your signiture is missing." role="button">
            {{ $personelStatus() }}
        </span>
        @break
    @case(3)
        {{-- cancelled --}}
        <span {{ $attributes->merge(["class" => "badge bg-secondary rounded-pill shadow"]) }} data-bs-toggle="tooltip" data-bs-placement="left" title="You have cancelled this form." role="button">
            {{ $personelStatus() }}
        </span>
        @break
    @default
        <span {{ $attributes->merge(["class" => "badge bg-danger rounded-pill shadow"]) }} data-bs-toggle="tooltip" data-bs-placement="left" title="You have declined this form." role="button">
            {{ $personelStatus() }}
        </span>
        @break
@endswitch