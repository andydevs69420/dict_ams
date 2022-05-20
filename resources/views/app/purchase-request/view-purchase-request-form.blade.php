<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PR | FORM</title>
        <link rel="stylesheet" href="{{ asset('css/purchase-request/view-pr-form/view-pr-form.css') }}">
    </head>

    <body>

        <div class="form__view">

            <img src="{{ asset('images/form-header-thin.png') }}" alt="form-header">

            <table id="table-main" border=0 cellpadding=0 cellspacing=0>
            
                <tr height=20 style='height:15.0pt;'>
                    <td height=20 colspan=7 style='height:15.0pt;'></td>
                </tr>
                <tr height=25 style='height:18.75pt;'>
                    <td class=xl181 colspan=7 height=25 width=658 style='height:18.75pt;width:495pt;'>PURCHASE REQUEST</td>
                </tr>
                <tr height=20 style='height:15.0pt;'>
                    <td height=20 colspan=7 style='height:15.0pt;'></td>
                </tr>
                <tr height=20 style='height:15.0pt;'>
                    <td class=xl297 height=20 style='height:15.0pt;'></td>
                    <td class=xl298></td>
                    <td class=xl299></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl299></td>
                </tr>
                <tr height=20 style='height:15.0pt;'>
                    <td class=xl300 height=20 style='height:15.0pt;'>Division</td>
                    <td id="pr-template__division-value-id" class=x-division-slot colspan=2 style='border-right:2.0pt double black;max-width: 112pt;'>Cagayan de Oro City</td>
                    <td class=xl66>PR Number</td>
                    <td id="pr-template__pr-number-value-id" class=x-pr-number-slot style="max-width:25pt;"></td>
                    <td class=xl119>Date</td>
                    <td id="pr-template__date-value-id" class=x-date-slot style="max-width:58pt;">LOADING...</td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;'>Office</td>
                    <td id="pr-template__office-value-id" class=x-office-slot colspan=2 style='border-right:2.0pt double black;max-width:112pt;'>Provincial Office&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td class=xl66>SAI Number</td>
                    <td id="pr-template__sai-value-id" class=x-sai-number-slot style='max-width:25pt;'></td>
                    <td class=xl66></td>
                    <td class=xl303></td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl304 height=21 style='height:15.75pt;'></td>
                    <td class=xl305></td>
                    <td class=xl306></td>
                    <td class=xl307></td>
                    <td class=xl308></td>
                    <td class=xl307></td>
                    <td class=xl309></td>
                </tr>
                <tr height=19 style='height:14.25pt;'>
                    <td class=xl310 height=19 style='height:14.25pt;border-top:none;'>Stock no.</td>
                    <td class=xl311 width=75 style='border-top:none;width:56pt;'>Unit</td>
                    <td class=xl1225 colspan=2 style='border-right:.5pt solid black;border-left:none;'>Item Description</td>
                    <td class=xl312 style='border-top:none;border-left:none;'>Qty</td>
                    <td class=xl312 style='border-top:none;border-left:none;'>Unit Cost</td>
                    <td class=xl313 style='border-top:none;'>Total Cost</td>
                </tr>
                
                <!-- FIRST ITEM -->
                <tr>
                    <td class=xl319  style='border-top:none;'></td>
                    <td class=xl351  style='border-top:none;'></td>
                    <td class=xl1243 style='border-right:.5pt solid black;border-left:none;' colspan=2></td>
                    <td class=xl352  style='border-top:none;border-left:none;'></td>
                    <td class=xl353  style='border-top:none;border-left:none;'></td>
                    <td class=xl354  style='border-top:none;'></td>
                </tr>
                
                <!-- ITEM TEMPLATE -->
                <div id="pr-template__item-list">
                    @foreach ($items as $item)
                        <tr style="border-bottom: 1px solid black;">
                            <td class=x-col-1 style='border-top:none;max-width: 50pt;'>{{ $item[0] }}</td>
                            <td class=x-col-2 style='border-top:none;border-left:none;max-width: 45pt;'>{{ $item[1] }}</td>
                            <td class=x-col-3 style='border-right:.5pt solid black;border-left:none;max-width:158pt;padding-bottom: 1em;' colspan=2>{{ $item[2] }}</td>
                            <td class=x-col-4 style='border-top:none;border-left:none;max-width:24pt;'>{{ $item[3] }}</td>
                            <td class=x-col-5 style='border-top:none;border-left:none;max-width: 22pt;'>{{ $item[4] }}</td>
                            <td class=x-col-6 style='border-top:none;border-left:none;max-width: 57pt;'>{{ $item[5] }}</td>
                        </tr>
                    @endforeach
           
                    <tr style="border-bottom: 1px solid black;">
                        <td class=x-col-1 style='border-top:none;max-width: 50pt;'></td>
                        <td class=x-col-2 style='border-top:none;border-left:none;max-width: 45pt;'></td>
                        <td class=x-col-3 style='border-right:.5pt solid black;border-left:none;max-width:158pt;font-size: 12px;text-align: center;padding-bottom: 1em;' colspan=2>***** Nothing Follows *****</td>
                        <td class=x-col-4 style='border-top:none;border-left:none;max-width:24pt;'></td>
                        <td class=x-col-5 style='border-top:none;border-left:none;max-width: 22pt;'></td>
                        <td class=x-col-6 style='border-top:none;border-left:none;max-width: 57pt;'></td>
                    </tr>
                    <tr>
                        <td class=x-col-1 style='border-top:none;max-width: 50pt;'></td>
                        <td class=x-col-2 style='border-top:none;border-left:none;max-width: 45pt;'></td>
                        <td class=x-col-3 style='border-right:.5pt solid black;border-left:none;max-width:158pt;font-size: 12px;text-align: center;padding-bottom: 2.5em;padding-bottom: @if(count($items) > 1) {{ (250/count($items)) < 0 ? 0 : (250/count($items)) }}px; @else 250px; @endif' colspan=2></td>
                        <td class=x-col-4 style='border-top:none;border-left:none;max-width:24pt;'></td>
                        <td class=x-col-5 style='border-top:none;border-left:none;max-width: 22pt;'></td>
                        <td class=x-col-6 style='border-top:none;border-left:none;max-width: 57pt;'></td>
                    </tr>
                    <tr>
                        <td class=x-col-1 style='border-top:none;max-width: 50pt;'></td>
                        <td class=x-col-2 style='border-top:none;border-left:none;max-width: 45pt;'></td>
                        <td class=x-col-3 style='border-right:.5pt solid black;border-left:none;max-width:158pt;font-size: 12px;text-align: center;padding-bottom: 2em;' colspan=2>
                            
                           <span class="x-budget-officer-designation-slot" role="text">
                               <span class="x-budget-officer-slot" role="text">{{ $budget_officer_name }}</span> <br>
                               <span class="x-budget-officer-designation-slot" role="text">{{ $budget_officer_designation }}</span>
                           </span>
                            
                        </td>
                        <td class=x-col-4 style='border-top:none;border-left:none;max-width:24pt;'></td>
                        <td class=x-col-5 style='border-top:none;border-left:none;max-width: 22pt;'></td>
                        <td class=x-col-6 style='border-top:none;border-left:none;max-width: 57pt;'></td>
                    </tr>
                </div>

                <!-- LAST ITEM -->
                <tr>
                    <td class=xl332 style='border-top:none;'></td>
                    <td class=xl333 style='border-top:none;border-left:none;'></td>
                    <td class=xl334 style='border-top:none;border-left:none;'></td>
                    <td class=xl335 style='border-top:none;'></td>
                    <td class=xl333 style='border-top:none;border-left:none;'></td>
                    <td class=xl336 style='border-top:none;border-left:none;'></td>
                    <td class=xl337 style='border-top:none;border-left:none;'></td>
                </tr>

                {{-- <tr height=34 style='height:25.5pt;'> --}}
                <tr>
                    <td class=xl297 height=34 style='height:25.5pt;border-top:none;text-align:center;'>Purpose:</td>
                    <td id="pr-template__purpose-value-id" class=x-purpose-slot colspan=6 rowspan=2 style='border-right:2.0pt double black;max-width: 418pt;'>{{ $purpose }}</td>
                </tr>

                <tr height=30 style='height:22.5pt;'>
                    <td class=xl338 height=30 style='height:22.5pt;'></td>
                </tr>

                <tr height=8 style='height:6.0pt;'>
                    <td class=xl339 height=8 style='height:6.0pt;'></td>
                    <td class=xl340></td>
                    <td class=xl340></td>
                    <td class=xl340></td>
                    <td class=xl340></td>
                    <td class=xl67></td>
                    <td class=xl341></td>
                </tr>

                <tr height=21 style='height:15.75pt;'>
                    <td class=xl342  height=21 style='height:15.75pt;border-top:none;'></td>
                    <td class=xl1240 colspan=2 style='border-right:.5pt solid black;'>Requested by:</td>
                    <td class=xl1240 colspan=2 style='border-right:.5pt solid black;border-left:none;'>Recommending Approval</td>
                    <td class=xl1240 colspan=2 style='border-right:2.0pt double black;border-left:none;'>Approved by:</td>
                </tr>

                <tr height=23 style='height:17.25pt;'>
                    <td class=xl302 height=23 style='height:17.25pt;'></td>
                    <td class=xl343></td>
                    <td class=xl344></td>
                    <td class=xl343></td>
                    <td class=xl344></td>
                    <td class=xl343></td>
                    <td class=xl345></td>
                </tr>

                <tr height=21 style='height:15.75pt;'>
                    <td class=xl346 height=21 style='height:15.75pt;'>Signature:</td>
                    <td class=xl347 style='border-left:none;'></td>
                    <td class=xl186></td>
                    <td class=xl347></td>
                    <td class=xl186></td>
                    <td class=xl347></td>
                    <td class=xl348></td>
                </tr>

                <tr height=22 style='height:16.5pt'>
                    <td class=xl346 height=22 style='height:16.5pt;'>Printed Name:</td>
                    <td id="pr-template__requested-name-value-id" class=x-personel-slot colspan=2 style='border-right:.5pt solid black;border-left:none;max-width:90pt;'>{{ $requester_name }}</td>
                    <td id="pr-template__recommending-approval-value-id" class=x-personel-slot colspan=2 style='border-right:.5pt solid black;border-left:none;max-width:119.7pt;'>{{ $recommending_approval_name }}</td>
                    <td id="pr-template__approver-name-value-id" class=x-personel-slot colspan=2 style='border-right:2.0pt double black;border-left:none;max-width:80pt;'>Sittie Rahma Alawi</td>
                </tr>

                <tr height=22 style='height:16.5pt;'>
                    <td class=xl349  height=22 style='height:16.5pt;'>Designation:</td>
                    <td id="pr-template__requested-designation-value-id" class=x-designation-slot colspan=2 style='border-right:.5pt solid black;border-left:none;max-width:90pt;'>{{ $requester_designation }}</td>
                    <td id="pr-template__recommending-approval-designation-value-id" class=x-designation-slot colspan=2 style='border-right:.5pt solid black;border-left:none;max-width:119.7pt;'>{{ $recommending_approval_designation }}</td>
                    <td id="pr-template__approver-designation-value-id" class=x-designation-slot colspan=2 style='border-right:2.0pt double black;border-left:none;max-width:80pt;'>Regional Director</td>
                </tr>

            </table>
        </div>
    </body>
    <script>
        window.print();
    </script>
</html>
