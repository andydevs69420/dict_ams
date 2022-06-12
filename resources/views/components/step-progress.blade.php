<?php

  $has_declined = false;

?>




<div class="row flex-nowrap">
    <div class="col-1">

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

    </div>
    <div class="col-11 pl-0">
        <div class="progress-label">
            @foreach($getFRPData() as $frp)
                <div class="d-block small text-truncate @if(strcmp($frp->personelstatus, "unsignitured") === 0) text-muted @endif" role="text">
                    <span class="d-block" role="text">{{ \App\Models\Accesslevel::getAccesslevelById($frp->accesslevel_id) }}</span>
                    <span class="d-block small" role="text" style="font-size: .5em">{{ $frp->updatedat? $frp->updatedat : "----:--:--" }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>