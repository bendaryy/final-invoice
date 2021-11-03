@extends('main')
@section('image')
<img src="../assets/img/sora.jpg" class="navbar-logo" alt="logo">
@endsection
@section('page')
انشاء فاتورة جديدة



@endsection
@section('head')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<title>الفاتورة الإلكترونية </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
<link href="../assets/css/loader.css" rel="stylesheet" type="text/css" />
<script src="../assets/js/loader.js"></script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
<link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
<link href="../assets/css/loader.css" rel="stylesheet" type="text/css" />
<script src="../assets/js/loader.js"></script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_html5.css">
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">



{{-- <script src="{{ asset('assets/js/invoice.js') }}"></script> --}}

<style>
    th,
    td {
        padding: 5px;
        text-align: center;
    }

    .borderNone {
        border: none
    }

    .borderNone:focus {
        outline: none;
    }

    .online-actions {
        display: none;
    }

    .navbar-expand-sm {
        justify-content: center
    }

    input[type="number"] {
        width: 150;
        text-align: center
    }

    hr {
        border: 4px solid white;
    }
</style>
@endsection




@section('content')

{{-- <form action="{{route('createInvoice3')}}" method="GET">
    <div class="form-group row">
        <div class="col-sm-6" style="text-align: center;margin:auto">
            <label class="col-sm-3 col-form-label col-form-label-sm">اسم الشركة</label>

            <select name="receiverName" class="form-control" id="receiverName">
                <option selected disabled>اختر اسم الشركة</option>
                @foreach ($allCompanies as $company)
                <option value="{{ $company->id }}" class="form-control">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group" style="text-align: center">
        <button type="submit" class="btn btn-success">filter</button>
    </div>
</form> --}}
<div style="position: fixed;z-index:100;">

    <button type="button" class="rounded-sm btn btn-info" id="addNewOne">اضافة</button>

</div>
<div style="text-align: center">

    <a class="btn btn-primary" href="{{ route('createInvoice') }}" style="text-align: center">الرجوع لاختيار الشركة</a>
</div>

<form method="POST" action="{{ route('storeInvoice') }}">
    @method("POST")
    @csrf



    <div class="row justify-content-center">



        <div class="col-xl-5 invoice-address-client">

            <h3 style="text-align: center;margin:40px">الفاتورة الى</h3>


            @foreach ($companies as $item)




            <div class="invoice-address-client-fields">

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label col-form-label-sm">أسم الشركة </label>
                    <div class="col-sm-9">
                        <input type="text" name="receiverName" class="text-center form-control form-control-sm"
                            value="{{ $item->name }}">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-3 col-form-label col-form-label-sm">الرقم الضريبى </label>
                    <div class="col-sm-9">
                        <input type="number" class="text-center form-control form-control-sm"
                            value="{{ $item->BetakaDriba }}" name="receiverId" placeholder="الرقم الضريبى">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-3 col-form-label col-form-label-sm">عنوان الشركة</label>
                    <div class="col-sm-9">
                        <input type="text" value="{{ $item->AddrCo }}" class="text-center form-control form-control-sm"
                            name="street" placeholder="عنوان الشركة">
                    </div>
                </div>


                <div class="form-group row invoice-created-by">
                    <label for="payment-method-country" class="col-sm-3 col-form-label col-form-label-sm">نوع
                        المتلقى</label>
                    <div class="col-sm-9">
                        <select name="receiverType" class="form-control form-control-sm">
                            <option value="B" style="font-size: 20px">أعمال</option>
                            <option value="P" style="font-size: 20px">شخص</option>
                            <option value="F" style="font-size: 20px">أجنبى</option>

                        </select>
                    </div>
                </div>




                <div class="form-group row invoice-created-by">
                    <label for="payment-method-country" class="col-sm-3 col-form-label col-form-label-sm">نوع العنصر
                    </label>
                    <div class="col-sm-9">
                        <select name="itemType" class="form-control form-control-sm">
                            <option value="EGS">EGS</option>
                            <option value="GS1">GS1</option>

                        </select>
                    </div>
                </div>

                <div class="form-group row invoice-created-by">
                    <label for="payment-method-country" class="col-sm-3 col-form-label col-form-label-sm">نوع
                        الوثيقة
                    </label>
                    <div class="col-sm-9">
                        <select name="DocumentType" class="form-control form-control-sm">
                            <option value="I" selected>فاتورة</option>
                            <option value="C">إشعار دائن</option>
                            <option value="D">إشعار مدين</option>

                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-3 col-form-label col-form-label-sm">الرقم الداخلى للفاتورة</label>
                    <div class="col-sm-9">
                        <input type="number" class="text-center form-control form-control-sm" name="internalId"
                            placeholder="الرقم الداخلى للفاتورة">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-3 col-form-label col-form-label-sm"> تاريخ الفاتورة</label>
                    <div class="col-sm-9">
                        <input type="date" value="{{ date('Y-m-d') }}" class="text-center form-control form-control-sm"
                            name="date" placeholder="">
                    </div>
                </div>
            </div>

        </div>


    </div>
    <hr style="border: 1px solid white;margin:50px 20px">

    <div id="newOne">



        <div class="form-group row invoice-note" style="margin-top: 40px;">
            <label for="invoice-detail-notes" class="text-center col-sm-12 col-form-label col-form-label-sm"
                style="text-align: center">وصف
                الفاتورة</label>
            <div class="col-sm-12">
                <textarea class="form-control" name="invoiceDescription[]" placeholder="وصف تفصيلى لصرف الفاتورة"
                    style="height: 88px;width: 360px;text-align: center;margin:auto"></textarea>
            </div>
        </div>



        <table style="margin: auto" border="1">

            <tr>

                <th>قيمة الضريبة (النسبية) %</th>
                <th>قيمة ضريبة المنبع %</th>
                <th>الكمـــية</th>
                <th>المبلغ بالجنيه المصرى</th>
                <th>الخصـــم</th>
                <th>خصــم الأصنــاف</th>
            </tr>
            <tr>
                <td>
                    <select name="rate[]" id="rate" class="form-control form-control-sm" onkeyup="findTotalt2Amount()"
                        onmouseover="findTotalt2Amount()">
                        <option value=10 selected>10%</option>
                        <option value=0>0%</option>
                    </select>
                </td>
                <td>
                    <input type="number" width="1px" name="t4rate[]" id="t4rate" onkeyup="findTotalt4Amount()"
                        onmouseover="findTotalt4Amount()">
                </td>
                <td><input type="number" step="any" name="quantity[]" id="quantity"
                        onkeyup="proccess(this.value),findTotalSalesAmount();"
                        onmouseover="proccess(this.value),findTotalSalesAmount();"></td>
                <td><input type=number step="any" name="amountEGP[]" id="amountEGP"
                        onkeyup="operation(this.value),findTotalSalesAmount();;"
                        onmouseover="operation(this.value),findTotalSalesAmount();;"></td>
                <td><input type="number" step="any" name="discountAmount[]" id="discountAmount"
                        onkeyup="discount(this.value),findTotalDiscountAmount(),findTotalNetAmount(),findTotalt4Amount(),findTotalt2Amount()"
                        onmouseover="discount(this.value),findTotalDiscountAmount(),findTotalNetAmount(),findTotalt4Amount(),findTotalt2Amount()">
                </td>
                <td><input type="number" step="any" name="itemsDiscount[]" id="itemsDiscount"
                        onkeyup="itemsDiscountValue(this.value),findTotalAmount(),findTotalItemsDiscountAmount()"
                        onmouseover="itemsDiscountValue(this.value),findTotalAmount(),findTotalItemsDiscountAmount()">
                </td>

            </tr>
            <tr>
                <th>قيمة الضريبة (النسبية) </th>
                <th> قيمة ضريبة (المنبع) </th>
                <th>إجمالي المبيعات</th>
                <th>الإجمالى الصافى</th>
                <th colspan="2">الإجمالى</th>
            </tr>
            <tr>
                <td> <input type="number" step="any" name="t2Amount[]" readonly id="t2" onkeyup="findTotalt2Amount()"
                        onmouseover="findTotalt2Amount()">
                </td>
                <td> <input type="number" step="any" name="t4Amount[]" readonly id="t4Amount"
                        onkeyup="findTotalt4Amount()" onmouseover="findTotalt4Amount()">

                </td>
                <td><input type=number step="any" name="salesTotal[]" readonly id="salesTotal"></td>
                <td><input type="number" step="any" readonly name="netTotal[]" id="netTotal"
                        onkeyup="nettotal(this.value),findTotalNetAmount()"
                        onmouseover="nettotal(this.value),findTotalNetAmount()"></td>
                <td colspan="2"><input type="number" step="any" name="totalItemsDiscount[]" readonly
                        id="totalItemsDiscount" onkeyup="findTotalAmount()" onmouseover="findTotalAmount()">
            </tr>

        </table>
        <hr>
    </div>
    <br style="margin-bottom: 50px">
    <table border="1" style="margin:auto;margin-top: 20px">
        <tr>
            <th style="margin-top: 30px">إجمالى ضريبة المنبع</th>
            <th style="margin-top: 30px">إجمالى الضريبة النسبية</th>
            <th style="margin-top: 30px">إجمالى مبلغ الخصم</th>
            <th style="margin-top: 30px">إجمالى مبلغ المبيعات</th>
            <th style="margin-top: 30px">إجمالى المبلغ الصافى</th>
            <th style="margin-top: 30px">إجمالى خصم الأصناف</th>
        </tr>


        <tr>
            <td><input type="number" step="any" name="totalt4Amount" onmouseover="findTotalt4Amount()"
                    onkeyup="findTotalt4Amount()" readonly id="totalt4Amount"></td>
            <td><input type="number" step="any" name="totalt2Amount" onmouseover="findTotalt2Amount()"
                    onkeyup="findTotalt2Amount()" readonly id="totalt2Amount"></td>
            <td><input type="number" step="any" name="totalDiscountAmount" onmouseover="findTotalDiscountAmount()"
                    onkeyup="findTotalDiscountAmount()" readonly id="totalDiscountAmount"></td>
            <td><input type="number" step="any" name="TotalSalesAmount" onmouseover="findTotalSalesAmount()"
                    onkeyup="findTotalSalesAmount()" readonly id="TotalSalesAmount"></td>
            <td><input type="number" step="any" name="TotalNetAmount" onmouseover="findTotalNetAmount()"
                    onkeyup="findTotalNetAmount()" readonly id="TotalNetAmount"></td>
            <td><input type="number" step="any" name="totalItemsDiscountAmount"
                    onmouseover="findTotalItemsDiscountAmount()" onkeyup="findTotalItemsDiscountAmount()" readonly
                    id="totalItemsDiscountAmount"></td>
        </tr>
        <tr>
            <th>خصم اضافي</th>
            <th colspan="2"> المبلغ الإجمالى قبل الخصم </th>
            <th colspan="3" style="direction: rtl">(المدفوع) المبلغ الإجمالى بعد الخصم </th>
        </tr>

        <tr>
            <td><input type="number" step="any" name="ExtraDiscount" id="ExtraDiscount"
                    onkeyup="Extradiscount(this.value),findTotalAmount()"
                    onmouseover="Extradiscount(this.value),findTotalAmount()"></td>
            </td>
            <td colspan="2"><input width="40" type="number" step="any" name="totalAmount" readonly id="totalAmount">
            </td>

            <td colspan="3"><input width="40" style="color: red;font-weight: bold;font-size: 20px" type="number"
                    step="any" name="totalAmount2" readonly id="totalAmount2">


            </td>

        </tr>
    </table>
    </tr>

    <div style="text-align: center;margin:50px auto">
        <button type="submit" class="btn btn-success" style="font-size: 30px">إرسال الفاتـــورة</button>
    </div>
</form>
@endforeach

@endsection






@section('js')
<script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("#receiverName").select2({
        dir: "rtl"
    });

</script>
<script src="../bootstrap/js/popper.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../assets/js/app.js"></script>

<script>
    $(document).ready(function() {
        App.init();
    });

</script>
<script src="../assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<script src="../plugins/dropify/dropify.min.js"></script>
<script src="../plugins/fullcalendar/flatpickr.js"></script>
<script src="../assets/js/apps/invoice-add.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<script>
    $(document).ready(function() {
        let i = 1
        $("#addNewOne").click(function() {
            i++;
            $('#newOne').append(
                `<div id="row${i}">
                    <button type="button" name="remove" id="${i}"  class="btn btn-danger btn_remove">x</button>
                    <div class="form-group row invoice-note" style="margin-top: 40px;">
                        <label for="invoice-detail-notes" class="text-center col-sm-12 col-form-label col-form-label-sm" style="text-align: center">وصف
                            الفاتورة</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="invoiceDescription[]" placeholder="وصف تفصيلى لصرف الفاتورة" style="height: 88px;width: 360px;text-align: center;margin:auto"></textarea>
                        </div>
                    </div>

                    <table style="margin: auto" border="1">
                        <tr>
                            <th>قيمة الضريبة (النسبية) %</th>
                            <th>قيمة ضريبة المنبع %</th>
                            <th>الكمـــية</th>
                            <th>المبلغ بالجنيه المصرى</th>
                            <th>الخصـــم</th>
                            <th>خصــم الأصنــاف</th>


                        </tr>
                        <tr>
                            <td>
                                <select name="rate[]" id="rate${i}" class="form-control form-control-sm">
                                    <option value=10 selected>10%</option>
                                    <option value=0>0%</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" width="1px" name="t4rate[]" id="t4rate${i}">

                            </td>
                            <td><input type="number" step="any" name="quantity[]" id="quantity${i}" onkeyup="proccess${i}(this.value),findTotalSalesAmount()" onmouseover="proccess${i}(this.value),findTotalSalesAmount()"></td>
                            <td><input type=number step="any" name="amountEGP[]" id="amountEGP${i}" onkeyup="operation${i}(this.value),findTotalSalesAmount();" onmouseover="operation${i}(this.value),findTotalSalesAmount();"></td>
                            <td><input type="number" step="any" name="discountAmount[]" id="discountAmount${i}" onkeyup="discount${i}(this.value),findTotalDiscountAmount(),findTotalNetAmount(),findTotalt4Amount(),findTotalt2Amount()" onmouseover="discount${i}(this.value),findTotalDiscountAmount(),findTotalNetAmount(),findTotalt4Amount(),findTotalt2Amount()"></td>

                            <td><input type="number" step="any" name="itemsDiscount[]" id="itemsDiscount${i}" onkeyup="itemsDiscountValue${i}(this.value),findTotalAmount(),findTotalItemsDiscountAmount()" onmouseover="itemsDiscountValue${i}(this.value),findTotalAmount(),findTotalItemsDiscountAmount()">
                        </tr>
                        <tr>
                            <th>قيمة الضريبة (النسبية) </th>
                            <th> قيمة ضريبة (المنبع) </th>
                            <th>إجمالي المبيعات</th>
                            <th>الإجمالى الصافى</th>
                            <th colspan="2"> الإجمالي</th>
                        </tr>
                        <tr>
                            <td> <input type="number" step="any" name="t2Amount[]" readonly id="t2${i}" {{--
                        onkeyup="t2value(this.value)" onmouseover="t2value(this.value)" --}}>
                            </td>
                            <td> <input type="number" step="any" name="t4Amount[]" readonly id="t4Amount${i}">
                            </td>
                            <td><input type=number step="any" name="salesTotal[]" readonly id="salesTotal${i}"></td>
                            <td><input type="number" step="any" readonly name="netTotal[]" id="netTotal${i}" onkeyup="nettotal${i}(this.value),findTotalNetAmount()" onmouseover="nettotal${i}(this.value),findTotalNetAmount()"></td>
                            <td colspan="2"><input type="number" step="any" name="totalItemsDiscount[]" readonly id="totalItemsDiscount${i}">
                        </tr>
                    </table>


                <hr>
                </div> `


            )


            $('<script> function operation' + i + '(value) {var x, y, z;  var quantity = document.getElementById("quantity' + i + '").value; x = value * quantity; document.getElementById("salesTotal' + i + '").value = x;};  function proccess' + i + '(value) {var x, y, z;  var amounEGP = document.getElementById("amountEGP' + i + '").value; y = value * amounEGP; document.getElementById("salesTotal' + i + '").value = y;};function discount' + i + '(value) {var salesTotal, netTotal, z, t2valueEnd, t1Value, rate, t4rate, t4Amount; salesTotal = document.getElementById("salesTotal' + i + '").value; netTotal = salesTotal - value; netTotalEnd = document.getElementById("netTotal' + i + '").value = netTotal; rate = document.getElementById("rate' + i + '").value; t4rate = document.getElementById("t4rate' + i + '").value;  t2valueEnd = document.getElementById("t2' + i + '").value = (netTotalEnd * rate) / 100; t4Amount = document.getElementById("t4Amount' + i + '").value = (netTotal * t4rate) / 100;}; function itemsDiscountValue' + i + '(value) {var x, netTotal, t1amount, t2amount, t4Amount;netTotal = document.getElementById("netTotal' + i + '").value;t2amount = document.getElementById("t2' + i + '").value;t4Amount = document.getElementById("t4Amount' + i + '").value;x = parseFloat(netTotal) + parseFloat(t2amount) - parseFloat(t4Amount) - parseFloat(value);document.getElementById("totalItemsDiscount' + i + '").value = x;};  </' + 'script>').appendTo('#test123');
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $("#row" + button_id + "").remove()
                findTotalDiscountAmount();
                findTotalSalesAmount();
                findTotalNetAmount();
                findTotalt4Amount();
                findTotalt2Amount();
                findTotalAmount();
                findTotalItemsDiscountAmount();
            })
        });
    });

</script>



@endsection


<script id="test123">
    // this is invoice 1

    function operation(value) {
        var x, y, z;

        var quantity = document.getElementById("quantity").value;
        x = value * quantity;
        document.getElementById("salesTotal").value = x;
    };

    function proccess(value) {
        var x, y, z;
        var amounEGP = document.getElementById("amountEGP").value;
        y = value * amounEGP;
        document.getElementById("salesTotal").value = y;
    };

    function discount(value) {
        var salesTotal, netTotal, z, t2valueEnd, t1Value, rate, t4rate, t4Amount;
        salesTotal = document.getElementById("salesTotal").value;
        netTotal = salesTotal - value;

        netTotalEnd = document.getElementById("netTotal").value = netTotal;
        rate = document.getElementById("rate").value;
        t4rate = document.getElementById("t4rate").value;
        t2valueEnd = document.getElementById("t2").value =
            (netTotalEnd * rate) / 100;
        t4Amount = document.getElementById("t4Amount").value =
            (netTotal * t4rate) / 100;
    }

    function itemsDiscountValue(value) {
        var x, netTotal, t1amount, t2amount, t4Amount;
        netTotal = document.getElementById("netTotal").value;
        t2amount = document.getElementById("t2").value;
        t4Amount = document.getElementById("t4Amount").value;
        x =
            parseFloat(netTotal) +
            parseFloat(t2amount) -
            parseFloat(t4Amount) -
            parseFloat(value);
        document.getElementById("totalItemsDiscount").value = x;
    }

    function Extradiscount(value) {
        var totalDiscount, x;
        totalDiscount = document.getElementById("totalAmount").value;
        x = totalDiscount - value;
        document.getElementById("totalAmount2").value = x;
    }

    function findTotalDiscountAmount() {
        var arr = document.getElementsByName("discountAmount[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("totalDiscountAmount").value = tot;

    }

    function findTotalSalesAmount() {
        var arr = document.getElementsByName("salesTotal[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("TotalSalesAmount").value = tot;

    }

    function findTotalNetAmount() {
        var arr = document.getElementsByName("netTotal[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("TotalNetAmount").value = tot;

    }

    function findTotalt4Amount() {
        var arr = document.getElementsByName("t4Amount[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("totalt4Amount").value = tot;
    }

    function findTotalt2Amount() {
        var arr = document.getElementsByName("t2Amount[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("totalt2Amount").value = tot;
    }
    function findTotalAmount() {
        var arr = document.getElementsByName("totalItemsDiscount[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("totalAmount").value = tot;
    }
    function findTotalItemsDiscountAmount() {
        var arr = document.getElementsByName("itemsDiscount[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("totalItemsDiscountAmount").value = tot;
    }

</script>
