<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Price Quotation | FORM</title>
        <link rel="stylesheet" href="{{ asset('css/supplyofficer/view-pqs-form/view-pqs-form.css') }}">
    </head>

    <body>

        <div class="form__view">

            <img src="{{ asset('images/form-header-thin.png') }}" alt="form-header">

            <table id="table-main" border=0 cellpadding=0 cellspacing=0>
            
                <tr height=20 style='height:15.0pt;'>
                    <td height=20 colspan=7 style='height:15.0pt;'></td>
                </tr>
                <tr height=25 style='height:18.75pt;'>
                    <td class=xl181 colspan=9 height=25 width=658 style='height:18.75pt;width:495pt;'>REQUEST FOR PRICE QUOTATION</td>
                </tr>
                <tr height=25 style='height:18.75pt;'>
                    <td class=xl181-b colspan=9 height=25 width=658 style='height:18.75pt;width:495pt;'>CANVASS FORM</td>
                </tr>
                <tr height=20 style='height:15.0pt;'>
                    <td height=20 colspan=7 style='height:15.0pt;'></td>
                </tr>


                <tr></tr>
                <tr></tr>
                <!-- FORM FIRST PART -->
                <tr height=20 style='height:15.0pt;'>
                    <td class=xl297 height=20 style='height:15.0pt;' colspan=3></td>
                    <td class=xl298></td>
                    <td class=xl299></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl299 colspan="3"></td>
                </tr>
                <tr class="first-row" height=20 style='height:15.0pt;'>
                    <td class=xl302 height=20 style='height:15.0pt;' colspan=4>&nbsp;&nbsp;{{ __("Purchase Request No.") }}</td>
                    <td class=x-office-slot colspan=1 style='border-right:2.0pt double black;max-width: 112pt;'>
                        @if ($formdata["formtype_id"] === 1)
                            @if (strlen($formdata["prnumber"]) > 0)
                                {{ $formdata["prnumber"] }}
                            @else
                                {{ __("TBA") }}
                            @endif
                        @elseif ($formdata["formtype_id"] === 2)
                            {{ __("TBA") }}
                        @endif
                    </td>
                    <td class=xl66>&nbsp;&nbsp;{{ __("Canvass NO.") }}</td>
                    <td class=x-jo-number-slot style="max-width:25pt;" colspan=2>{{ __("TBA") }}</td>
                    <td class=xl303 colspan="3"></td>
                </tr>
                <tr class="first-row" height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;' colspan=4>&nbsp;&nbsp;{{ __("Approved Budget for the Contract (ABC)") }}</td>
                    <td id="jo-template__address-value-id" class=x-office-slot colspan=1 style='border-right:2.0pt double black;max-width:112pt;'>{{ __("TBA") }}</td>
                    <td class=xl66>&nbsp;&nbsp;{{ __("Date") }}</td>
                    <td id="jo-template__date-value-id" class=x-jo-number-slot style="max-width:25pt;" colspan=2>{{ $date }}</td>
                    <td class=xl303 colspan="3"></td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;' colspan=4>&nbsp;&nbsp;</td>
                    <td id="jo-template__procurement-value-id" class=x-office-slot colspan=1 style='border-right:2.0pt double black;max-width:112pt;'></td>
                    <td class=xl66></td>
                    <td style='max-width:25pt;'></td>
                    <td class=xl66></td>
                    <td class=xl303 colspan="3"></td>
                </tr>
                

                
                <tr height=20 style='height:15.0pt;'>
                    <td class=xl298 height=20 style='height:15.0pt;' colspan="4"></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl298  colspan="3"></td>
                </tr>

                <tr></tr>
                <tr></tr>
                <!-- FORM SECOND PART -->
                <tr>
                    <td id="notice-1">GENTLEMEN:</td>
                </tr>
                <tr class="spacer"></tr>
                <tr>
                    <td id="notice-2" colspan="12">Please quote your lowest price for each of the following item(s) specified below including the total amount in legible style (preferably typewritten) and return this duly accomplished and signed by the company's authorized representative to the Procurement Planning and Management Division. Deadline for the submission of bids ______________.</td>
                </tr>
                <tr class="spacer"></tr>
                <tr class="spacer"></tr>
                <tr>
                    <td class="name canvasser-name" colspan="6">{{ $canvasserdata["firstname"]." ".$canvasserdata["middleinitial"]." ".$canvasserdata["lastname"]}}</td>
                    <td class="name companyrep-name" colspan="6">{{ __("TBA") }}</td>
                </tr>
                <tr>
                    <td class="name-label" colspan="6">CANVASSER</td>
                    <td class="name-label" colspan="6">CHAIRMAN</td>
                </tr>
                <tr class="spacer"></tr>
                <tr>
                    <td class="">IMPORTANT:</td>
                </tr>
                <tr>
                    <td class="" colspan="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.&nbsp;&nbsp;The total price quoted below is subject to withholding tax</td>
                </tr>
                <tr>
                    <td class="" colspan="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;&nbsp;Bids should be valid for at least 45 days (from the deadline of submission)</td>
                </tr>
                <tr>
                    <td class="" colspan="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.&nbsp;&nbsp;Delivery of 5 to 7 working days (please state the delivery period if beyond the required</td>
                </tr>
                <tr>
                    <td class="" colspan="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10 working days)</td>
                </tr>
                <tr>
                    <td class="" colspan="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.&nbsp;&nbsp;In case of failure to deliver make full delivery within the time specified below, a penalty of</td>
                </tr>
                <tr>
                    <td class="" colspan="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;one-tenth (1/10) of one percent (1%) for everyday of delay shall be imposed</td>
                </tr>
                <tr>
                    <td class="" colspan="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;&nbsp;Terms of Payment: Fifteen (15) to thirty (30) days after the Inspection and Acceptance of</td>
                </tr>
                <tr>
                    <td class="" colspan="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Goods</td>
                </tr>
                <tr>
                    <td class="" colspan="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.&nbsp;&nbsp;Bidders should provide the following requirements: </td>
                </tr>
                <tr>
                    <td class="" colspan="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Valid PhilGEPS Certificate of Registration</td>
                </tr>
                <tr>
                    <td class="" colspan="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. BIR Certificate of Registration; and</td>
                </tr>
                <tr>
                    <td class="" colspan="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c. Business/Mayor's Permit</td>
                </tr>




                <!-- FORM THIRD PART -->
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl304 height=21 style='height:15.75pt;'></td>
                    <td class=xl305></td>
                    <td></td>
                    <td class=xl307></td>
                    <td class=xl308></td>
                    <td class=xl307></td>
                    <td class=xl309></td>
                    <td class=xl309></td>
                    <td class=xl309></td>
                </tr>

                <tr height=19 style='height:14.25pt;'>
                    <td class=xl310 height=19 style='height:14.25pt;border-top:none;'>Item no.</td>
                    <td class=xl311 style='border-top:none;'>QTY</td>
                    <td class=xl1225  style='border-right:.5pt solid black;border-left:none;'>Unit</td>
                    <td class=xl312 colspan=2 style='border-top:none;border-left:none;'>Item Description</td>
                    <td class=xl312 style='border-top:none;border-left:none;'>Unit Cost</td>
                    <td class=xl313 style='border-top:none;'>Total Amount</td>
                    <td class=xl313 style='border-top:none;'>Brand</td>
                    <td class=xl313 style='border-top:none;'>Model</td>
                </tr>

                <!-- FIRST ITEM -->
                <tr>
                    <td class=xl319  style='border-top:none;'></td>
                    <td class=xl351  style='border-top:none;'></td>
                    <td class=xl1243 style='border-right:.5pt solid black;border-left:none;'></td>
                    <td class=xl352  style='border-top:none;border-left:none;' colspan=2></td>
                    <td class=xl353  style='border-top:none;border-left:none;'></td>
                    <td class=xl354  style='border-top:none;'></td>
                    <td class=xl354  style='border-top:none;'></td>
                    <td class=xl354  style='border-top:none;'></td>
                </tr>

                
                <!-- ITEM TEMPLATE -->
                <div id="pr-template__item-list">
                    @foreach ($itemdata as $formitem)
                        <tr>
                            <td class=x-col-1 style='border-top:none;'>{{ $formitem["stockno"] }}</td>
                            <td class=x-col-2 style='border-top:none;border-left:none;'>{{ $formitem["quantity"] }}</td>
                            <td class=x-col-3 style='border-right:.5pt solid black;border-left:none;'>{{ $formitem["unit"] }}</td>
                            <td class=x-col-4 style='border-top:none;border-left:none;' colspan="2">{{ $formitem["item"] }}</td>
                            <td class=x-col-5 style='border-top:none;border-left:none;'></td>
                            <td class=x-col-6 style='border-top:none;border-left:none;'></td>
                            <td class=x-col-5 style='border-top:none;border-left:none;'></td>
                            <td class=x-col-6 style='border-top:none;border-left:none;'></td>
                        </tr>
                    @endforeach
                    {{-- temporary --}}
                    <tr class="after-lastitem-notice">
                        <td class=x-col-1 style='border-top:none;'></td>
                        <td class=x-col-2 style='border-top:none;border-left:none;'></td>
                        <td class=x-col-3 style='border-right:.5pt solid black;border-left:none;font-size: 12px;text-align: center;'></td>
                        <td class=x-col-4 style='border-top:none;border-left:none;' colspan=2></td>
                        <td class=x-col-5 style='border-top:none;border-left:none;'></td>
                        <td class=x-col-6 style='border-top:none;border-left:none;'></td>
                        <td class=x-col-6 style='border-top:none;border-left:none;'></td>
                        <td class=x-col-6 style='border-top:none;border-left:none;'></td>
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
                </tr>

                <tr height=34 style='height:15.5pt;'>
                    <td class=xl297-b height=34 style='height:25.5pt;vertical-align:middle;' colspan=2 rowspan=2></td>
                    <td class=xl297-b height=34 style='height:25.5pt;vertical-align:middle;' colspan=2 rowspan=2></td>
                    <td class=xl297-b height=34 style='height:25.5pt;vertical-align:middle;' colspan=2 rowspan=2></td>
                    <td id="pr-template__purpose-value-id" class=x-purpose-slot colspan=5></td>
                </tr>



            </table>
        </div>
    </body>
    <script>
        window.print();
    </script>
</html>
