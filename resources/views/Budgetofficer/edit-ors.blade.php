@extends(
    'layout.app-main', 
    [
        'accesslevelid' => $LoggedUserInfo['accesslevel_id'], // para sa sidebar
        'username'      => $LoggedUserInfo['username']        // para sa topbar
    ]
)
    
@section('title', 'AMS | Edit Obligation Request/Status')

@section('dependencies')
    <link rel="stylesheet" href="{{ asset('css/Budgetofficer/Budgetoffice.css') }}">
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __("Edit Obligation Request/Status form ") }}</h2>
            </div>    
        </div>

        <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-content">
                    @if ($errors->any())
                    <div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header">{{ __("There were some errors with your submission") }}</div>
                        <ul class="list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form id="edit_ORS_form" action="{{ url('edit-ors') }}" class="ui form" method="post" accept-charset="utf-8">
                        <div class="field">
                            <label>{{ __("Stock no.")}}</label>
                            <input type="text" class="readonly" readonly="" value="@isset($l->Stock_no){{ $l->Stock_no }}@endisset">
                        </div>
                        <div class="field">
                            <label>{{ __("Unit") }}</label>
                            <input type="text" class="readonly" readonly="" value="@isset($l->Unit){{ $l->Unit }}@endisset">
                        </div>

                        <div class="field">
                            <label>{{ __("Item description") }}</label>
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
                            <textarea name="comment" class="uppercase" rows="5">@isset($l->comment){{ $l->comment }}@endisset</textarea>
                        </div>
                        <!-- <div class="ui error message">
                            <i class="close icon"></i>
                                <div class="header"></div>
                                    <ul class="list">
                                        <li class=""></li>
                                    </ul>
                        </div> -->
                        <div class="box-footer">
                            <input type="hidden" class="readonly" readonly="" name="id" value="@isset($e_id){{ $e_id }}@endisset">
                            <button class="ui positive small button" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __("Update") }}</button>
                            <a href="{{ url('BO') }}" class="ui black grey small button"><i class="ui times icon"></i> {{ __("Cancel") }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop