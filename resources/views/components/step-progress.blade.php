<?php

  $has_declined = false;

?>

<ol class="step-progress">

    @foreach($getFRPData() as $frp)

      @if(!$has_declined)

        @if(strcmp($frp->personelstatus, "signitured") === 0)
            <li class="progress-step ok" data-bs-toggle="tooltip" title="{{ $frp->personelstatus }}.">
                <i class="fa fa-check fa-2xs"></i>
            </li>
        @elseif(strcmp($frp->personelstatus, "unsignitured") === 0)
            <li class="progress-step not-ok" data-bs-toggle="tooltip" title="{{ $frp->personelstatus }}.">
                <i class="fa fa-exclamation fa-2xs"></i>
            </li>
        @elseif(strcmp($frp->personelstatus, "cancelled") === 0 || strcmp($frp->personelstatus, "declined") === 0)
            <?php $has_declined = true; ?>
            <li class="progress-step not-ok" data-bs-toggle="tooltip" title="{{ $frp->personelstatus }}.">
                <i class="fa fa-xmark fa-2xs"></i>
            </li>
        @endif

      @else
        <li class="progress-step not-ok" data-bs-toggle="tooltip" title="No action needed.">
            <i class="fa fa-hand fa-2xs"></i>
        </li>
      @endif

    @endforeach

</ol>
