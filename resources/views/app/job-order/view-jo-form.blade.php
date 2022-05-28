<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>JO | FORM</title>
        <link rel="stylesheet" href="{{ asset('css/new-job-order/view-jo-form/view-jo-form.css') }}">
    </head>

    <body>

        <div class="form__view">

            <img src="{{ asset('images/form-header-thin.png') }}" alt="form-header">

            <table id="table-main" border=0 cellpadding=0 cellspacing=0>
            
                <tr height=20 style='height:15.0pt;'>
                    <td height=20 colspan=7 style='height:15.0pt;'></td>
                </tr>
                <tr height=25 style='height:18.75pt;'>
                    <td class=xl181 colspan=7 height=25 width=658 style='height:18.75pt;width:495pt;'>JOB ORDER</td>
                </tr>
                <tr height=20 style='height:15.0pt;'>
                    <td height=20 colspan=7 style='height:15.0pt;'></td>
                </tr>


                <!-- FORM FIRST PART -->
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
                    <td class=xl300 height=20 style='height:15.0pt;' colspan=2>&nbsp;&nbsp;Supplier</td>
                    <td id="pr-template__supplier-value-id" class=x-division-slot colspan=1 style='border-right:2.0pt double black;max-width: 112pt;'>LOADING...</td>
                    <td class=xl66 colspan=1>&nbsp;&nbsp;JO. NO.</td>
                    <td class=x-jo-number-slot style="max-width:25pt;" colspan=2>LOADING...</td>
                    <td class=x-date-slot style="max-width:58pt;"></td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;' colspan=2>&nbsp;&nbsp;Address</td>
                    <td id="jo-template__address-value-id" class=x-office-slot colspan=1 style='border-right:2.0pt double black;max-width:112pt;'>LOADING...</td>
                    <td class=xl66>&nbsp;&nbsp;Date</td>
                    <td id="jo-template__date-value-id" class=x-jo-number-slot style="max-width:25pt;" colspan=2>{{ $JoFormData['date'] }}</td>
                    <td class=xl303></td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;' colspan=2>&nbsp;&nbsp;Mode of Procurement</td>
                    <td id="jo-template__procurement-value-id" class=x-office-slot colspan=1 style='border-right:2.0pt double black;max-width:112pt;'>LOADING...</td>
                    <td class=xl66></td>
                    <td style='max-width:25pt;'></td>
                    <td class=xl66></td>
                    <td class=xl303></td>
                </tr>


                <!-- FORM SECOND PART -->
                <tr height=20 style='height:15.0pt;'>
                    <td class=xl297 height=20 style='height:15.0pt;'></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl299></td>
                </tr>
                <tr height=20 style='height:15.0pt;'>
                    <td class=xl300 height=20 style='height:15.0pt; font-size: 10.0pt;'>&nbsp;&nbsp;Gentlemen:</td>
                    <td colspan=2 style='max-width: 112pt;'></td>
                    <td class=xl66></td>
                    <td style="max-width:25pt;"></td>
                    <td class=xl119></td>
                    <td style="max-width:58pt;border-right:2.0pt double black;"></td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt; font-size: 10.0pt;border-right:2.0pt double black;' colspan=7>&nbsp;&nbsp;Please furnish this office the following articles subject to the terms and conditions contained herein:</td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;'></td>
                    <td colspan=2 style='max-width:112pt;'></td>
                    <td class=xl66></td>
                    <td style='max-width:25pt;'></td>
                    <td class=xl66></td>
                    <td class=xl303></td>
                </tr>

                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;' colspan=2>&nbsp;&nbsp;Place of Delivery:</td>
                    <td id="jo-template__placeofdelivery-value-id" class=x-placeofdelivery-slot colspan=1 style='max-width:112pt;'>LOADING...</td>
                    <td class=xl66 colspan=2>&nbsp;&nbsp;Delivery Term:</td>
                    <td id="jo-template__deliveryterm-value-id" class=x-deliveryterm-slot style='max-width:25pt;border-right:2.0pt double black;' colspan=2>LOADING...</td>
                </tr>

                
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;' colspan=2>&nbsp;&nbsp;Date of Delivery:</td>
                    <td id="jo-template__deliverydate-value-id" class=x-placeofdelivery-slot colspan=1 style='max-width:112pt;'>LOADING...</td>
                    <td class=xl66 colspan=2>&nbsp;&nbsp;Payment Term:</td>
                    <td id="jo-template__paymentterm-value-id" class=x-deliveryterm-slot style='max-width:25pt;border-right:2.0pt double black;' colspan=2>LOADING...</td>
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
                </tr>
                
                <tr height=19 style='height:14.25pt;'>
                    <td class=xl310 height=19 style='height:14.25pt;border-top:none;'>Item no.</td>
                    <td class=xl311 width=75 style='border-top:none;width:56pt;'>Unit</td>
                    <td class=xl1225 colspan=2 style='border-right:.5pt solid black;border-left:none;'>Description</td>
                    <td class=xl312 style='border-top:none;border-left:none;'>Qty</td>
                    <td class=xl312 style='border-top:none;border-left:none;'>Unit Cost</td>
                    <td class=xl313 style='border-top:none;'>Amount</td>
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
                    @foreach ($JoFormData['items'] as $item)
                        <tr>
                            <td class=x-col-1 style='border-top:none;max-width: 50pt;'>{{ $item[0] }}</td>
                            <td class=x-col-2 style='border-top:none;border-left:none;max-width: 45pt;'>{{ $item[1] }}</td>
                            <td class=x-col-3 style='border-right:.5pt solid black;border-left:none;max-width:158pt;' colspan=2>{{ $item[2] }}</td>
                            <td class=x-col-4 style='border-top:none;border-left:none;max-width:24pt;'>{{ $item[3] }}</td>
                            <td class=x-col-5 style='border-top:none;border-left:none;max-width: 22pt;'>{{ $item[4] }}</td>
                            <td class=x-col-6 style='border-top:none;border-left:none;max-width: 57pt;'>{{ $item[5] }}</td>
                        </tr>
                    @endforeach
                    <tr class="after-lastitem-notice">
                        <td class=x-col-1 style='border-top:none;max-width: 50pt;'></td>
                        <td class=x-col-2 style='border-top:none;border-left:none;max-width: 45pt;'></td>
                        <td class=x-col-3 style='border-right:.5pt solid black;border-left:none;max-width:158pt;font-size: 12px;text-align: center;' colspan=2>***** Nothing Follows *****</td>
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


                <!-- FORM FOURTH PART -->
                <tr height=34 style='height:15.5pt;'>
                    <td class=xl297 height=34 style='height:25.5pt;border-top:2.0pt double black;width:428pt;;vertical-align:middle;' colspan=2 rowspan=2>&nbsp;&nbsp;&nbsp;&nbsp;(Total Amount in Words)</td>
                    <td id="pr-template__purpose-value-id" class=x-purpose-slot colspan=5 rowspan=2 width=569 style='border-right:2.0pt double black;width:428pt;font-weight:bold'>&nbsp;&nbsp;&nbsp;&nbsp;Two Hundred Pesos</td>
                </tr>


                <tr height=30 style='height:22.5pt;'>
                    <td class=xl338 height=30 style='height:22.5pt;'></td>
                </tr>

                <tr height=20 style='height:15.0pt;'>
                    <td class=xl297 height=20 style='height:15.0pt;'></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl298></td>
                    <td class=xl299></td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt; font-size: 10.0pt;border-right:2.0pt double black;' colspan=7>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In case of failue to make the full delivery within the time specified above, a penalty of one-tenth</td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt; font-size: 10.0pt;border-right:2.0pt double black;' colspan=7>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(1/10) of one percernt for every day of delay shall be imposed.</td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt; font-size: 10.0pt;border-right:2.0pt double black;' colspan=7>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Very Yours Truly,</td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;'></td>
                    <td colspan=2 style='max-width:112pt;'></td>
                    <td class=xl66></td>
                    <td style='max-width:25pt;'></td>
                    <td class=xl66></td>
                    <td class=xl303></td>
                </tr>

                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;' colspan=2></td>
                    <td colspan=1 style='max-width:112pt;'></td>
                    <td class="xl66 x-authorizedofficial-slot" colspan=2>Sittie Rahma Alawi</td>
                    <td style='max-width:25pt;'  colspan=1></td>
                    <td class=xl303></td>
                </tr>

                
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;' colspan=2></td>
                    <td colspan=1 style='max-width:112pt;'></td>
                    <td class=xl66 colspan=4 style="border-right:2.0pt double black;">(AUTHORIZED OFFICIAL)</td>
                </tr>

                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;' colspan=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Conforme:</td>
                    <td colspan=1 style='max-width:112pt;'></td>
                    <td class=xl66 colspan=2></td>
                    <td style='max-width:25pt;'  colspan=1></td>
                    <td class=xl303></td>
                </tr>

                
                <tr height=21 style='height:15.75pt;'>
                    <td id="jo-template__conforme-value-id" class="xl302 x-conforme-slot" height=21 style='height:15.75pt;' colspan=4>{{ $JoFormData['conforme'] }}</td>
                    <td colspan=1 style='max-width:112pt;'></td>
                    <td style='max-width:25pt;'  colspan=1></td>
                    <td class=xl303></td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;' colspan=4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature Over Printed Name</td>
                    <td colspan=1 style='max-width:112pt;'></td>
                    <td class=xl66 colspan=2  style="border-right:2.0pt double black;"></td>
                </tr>
                <tr height=21 style='height:15.75pt;'>
                    <td class=xl302 height=21 style='height:15.75pt;' colspan=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:</td>
                    <td id="jo-template__bottomdate-value-id" class=x-bottomdate-slot colspan=3 style='max-width:112pt;'>{{ $JoFormData['date'] }}</td>
                    <td class=xl66 colspan=3  style="border-right:2.0pt double black;"></td>
                </tr>


                <!-- FORM FIFTH PART-->
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
                    <td class=xl1240 colspan=2 style='border-right:.5pt solid black;'></td>
                    <td class=xl1240 colspan=2></td>
                    <td class=xl1240 colspan=2 style='border-right:2.0pt double black;border-left:none;'></td>
                </tr>

                <tr height=21 style='height:15.75pt;'>
                    <td class=xl346 height=21 style='height:15.75pt;'></td>
                    <td class=xl347 style='border-left:none;'></td>
                    <td class=xl186></td>
                    <td class=xl347></td>
                    <td class=xl186></td>
                    <td ></td>
                    <td class=xl348></td>
                </tr>

                <tr height=22 style='height:16.5pt'>
                    <td class="xl346 x-req-slot" height=22 style='height:16.5pt;'>{{ $JoFormData['req_A'] }}</td>
                    <td colspan=2 style='border-right:.5pt solid black;border-left:.5pt solid black;max-width:90pt;'></td>
                    <td class=x-amount-slot colspan=3 style='border-left:none;max-width:119.7pt;'>Amount</td>
                    <td colspan=1 style='border-right:2.0pt double black;border-left:none;max-width:80pt;'></td>
                </tr>

                <tr height=22 style='height:16.5pt;'>
                    <td class=xl349  height=22 style='height:16.5pt; text-align:center'>{{ $JoFormData['req_B'] }}</td>
                    <td class=x-designation-slot colspan=2 style='border-right:.5pt solid black;border-left:none;max-width:90pt;'></td>
                    <td class=x-designation-slot colspan=3 style='border-left:none;max-width:119.7pt;'>A.L.O.B.S. No.</td>
                    <td class=x-designation-slot colspan=1 style='border-right:2.0pt double black;border-left:none;max-width:80pt;'></td>
                </tr>

            </table>
        </div>
    </body>
    <script>
        window.print();
    </script>
</html>
