@extends("layout.app-main")

@section('title', 'AMS | Edit Job order Request/Status')

@section('dependencies')
    <link rel="stylesheet" href="{{ asset('css/Budgetofficer/Budgetoffice.css') }}">
@stop

@section('content')
<div class="d-block w-100 h-100">
        <div class="container-fluid">
            <span class="dashboard__dashboard-header-label d-block px-0 py-3 text-muted" role="text">{{ __('Edit Purchase Request Status') }}</span>    
        </div>

        <div class="d-block py-5">
            <div class="container py-2 rounded-2 shadow-lg">
                <form id="edit_PR_form" action="{{ url('edit-purchaserequest') }}" class="ui form" method="post" accept-charset="utf-8">
                    @csrf
                    <div class="d-block py-3 px-3">
                        <div class="field">
                            <label>{{ __("Stock number")}}</label>
                            <input type="text" class="readonly" readonly="" value="@isset($l->Stock_no){{ $l->Stock_no }}@endisset">
                        </div>
                        <div class="field">
                            <label>{{ __("Unit") }}</label>
                            <input type="text" class="readonly" readonly="" value="@isset($l->Unit){{ $l->Unit }}@endisset">
                        </div>
                        <div class="field">
                            <label>{{ __("Description") }}</label>
                            <input type="text" class="readonly" readonly="" value="@isset($l->Item_description){{ $l->Item_description }}@endisset">
                        </div>
                        <div class="field">
                            <label for="">{{ __("Quantity") }}</label>
                            <input type="text" class="readonly" readonly="" value="@isset($l->Quantity){{ $l->Quantity }}@endisset"/>
                        </div>
                        <div class="field">
                            <label for="">{{ __("Unit cost") }}</label>
                            <input type="text" class="readonly" readonly="" value="@isset($l->Unit_cost){{ $l->Unit_cost }}@endisset"/>
                        </div>
                        <div class="field">
                            <label for="">{{ __("Total cost") }}</label>
                            <input type="text" class="readonly" readonly="" value="@isset($l->Total_cost){{ $l->Total_cost }}@endisset"/>
                        </div>
                        <div class="field">
                            <label>{{ __("Status") }}</label>
                            <select class="ui dropdown uppercase" name="status">
                                <option value="Approved" @isset($l->status) @if($l->status == 'Approved') selected @endif @endisset>Approved</option>
                                <option value="Pending" @isset($l->status) @if($l->status == 'Pending') selected @endif @endisset>Pending</option>
                                <option value="Declined" @isset($l->status) @if($l->status == 'Declined') selected @endif @endisset>Declined</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>{{ __("Add Comment (Optional)") }}</label>
                            <textarea placeholder="Type something here..."name="comment" class="uppercase" rows="5">@isset($l->comment){{ $l->comment }}@endisset</textarea>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" class="readonly" readonly="" name="id" value="@isset($form_id){{ $form_id }}@endisset">
                            <button class="small_button border" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __("Update") }}</button>
                            <a href="{{ url('joborderstatus') }}" class="ui black grey small button"><i class="ui times icon"></i> {{ __("Cancel") }}</a>
                        </div>
                    </div>
                <form>
            </div>
        </div>
</div>
@stop