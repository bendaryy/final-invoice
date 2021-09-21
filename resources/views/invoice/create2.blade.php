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
<link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
<link href="../assets/css/loader.css" rel="stylesheet" type="text/css" />
<script src="../assets/js/loader.js"></script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
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


<style>
    .select2-dropdown {
        background: #0E1726;
        color: white
    }

    .select2-selection__rendered {
        background: #1B2E4B;
        color: #6C757D !important;
    }
</style>
<script>
    function mult(value) {
            var x,y,z;
         var quantity  = document.getElementById('quantity').value;
         x = value * quantity;
             document.getElementById('salesTotal').value = x;
        }
        function mult2(value){
            var x,y,z;
        var amounEGP = document.getElementById('amountEGP').value;
        y = value * amounEGP;
            document.getElementById('salesTotal').value = y
        }
        function discount(value){
            var salesTotal,netTotal,z,t2valueEnd,t1Value,rate,t4rate,t4Amount;
            salesTotal = document.getElementById('salesTotal').value;
            netTotal = salesTotal - value;

           netTotalEnd =  document.getElementById('netTotal').value = netTotal;
            rate = document.getElementById('rate').value;
            t4rate = document.getElementById('t4rate').value;
            t2valueEnd =  document.getElementById('t2').value = netTotalEnd * rate/100;
            t4Amount = document.getElementById('t4Amount').value = netTotal * t4rate/100;
            // t1Value = parseFloat(netTotalEnd) + parseFloat(t2valueEnd);
            // document.getElementById('t1').value = t1Value * 0.14;
        }
        // function nettotal(value){
        //     var t2amount;
        //     t2amount = value * 10/100;
        //     document.getElementById('t2').value = t2amount;
        // }

        // function t2value(value){
        //     var x,netTotal,t1,t2;
        //     netTotal = document.getElementById('netTotal').value;
        //     t1Amount =  parseFloat(netTotal) + parseFloat(value);
        //     document.getElementById('t1').value = t1Amount * 0.14;
        // }
        function itemsDiscountValue(value){
            var x,netTotal,t1amount,t2amount,t4Amount;
            netTotal = document.getElementById('netTotal').value;
            // t1amount = document.getElementById('t1').value;
            t2amount =  document.getElementById('t2').value;
            t4Amount = document.getElementById('t4Amount').value;
            // x = parseFloat(netTotal) + parseFloat(t1amount) + parseFloat(t2amount) - parseFloat(value);  this is an old value of x with t1
            x = parseFloat(netTotal) +parseFloat(t2amount) - parseFloat(t4Amount) - parseFloat(value);
            document.getElementById("totalItemsDiscount").value = x;

        }
        function Extradiscount(value){
            var totalDiscount,x;
            totalDiscount = document.getElementById("totalItemsDiscount").value;
            x = totalDiscount - value;
            document.getElementById('totalAmount').value = x;
        }





</script>

<style>
    th,
    td {
        padding: 15px
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
</style>
@endsection




@section('content')

<form action="{{route('createInvoice3')}}" method="GET">
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
        <button type="submit" class="btn btn-success">ملئ بيانات الشركة</button>
    </div>
</form>


<form method="POST" action="{{ route('storeInvoice') }}">
    @method("POST")
    @csrf

    <div class="row justify-content-center">



        <div class="col-xl-5 invoice-address-client">

            <h3 style="text-align: center;margin:40px">الفاتورة الى</h3>


            <div class="form-group row">
                <label class="col-sm-3 col-form-label col-form-label-sm">اسم الشركة</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm text-center" name="receiverName"
                        placeholder="اسم الشركة">
                </div>
            </div>



            <div class="invoice-address-client-fields">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label col-form-label-sm">الرقم الضريبى </label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control form-control-sm text-center" name="receiverId"
                            placeholder="الرقم الضريبى">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-3 col-form-label col-form-label-sm">عنوان الشركة</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm text-center"
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
                    <label for="payment-method-country" class="col-sm-3 col-form-label col-form-label-sm">نوع الوثيقة
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
                        <input type="number" class="form-control form-control-sm text-center" name="internalId"
                            placeholder="الرقم الداخلى للفاتورة">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-3 col-form-label col-form-label-sm"> تاريخ الفاتورة</label>
                    <div class="col-sm-9">
                        <input type="date" value="{{ date("Y-m-d") }}" class="form-control form-control-sm text-center"
                            name="date" placeholder="">
                    </div>
                </div>

                <div class="form-group row invoice-note" style="margin-top: 40px;margin-right:100px">
                    <label for="invoice-detail-notes" class="col-sm-12 col-form-label col-form-label-sm text-left">وصف
                        الفاتورة</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" name="invoiceDescription" placeholder='وصف تفصيلى لصرف الفاتورة'
                            style="height: 88px;width: 360px;text-align: center"></textarea>
                    </div>
                </div>





            </div>

        </div>


    </div>
    <hr style="border: 1px solid white;margin:50px 20px">

    <table style="margin: auto">
        <tr>
            <th>قيمة الضريبة (النسبية) %</th>

            <td>
                <select name="rate" id="rate" class="form-control form-control-sm">
                    <option value=10 selected>10%</option>
                    <option value=0>0%</option>

                </select>
            </td>
        </tr>
        <tr>
            <th>قيمة ضريبة المنبع %</th>
            <td>
                {{-- <select name="t4rate" id="t4rate" class="form-control form-control-sm">
                    <option value=5 selected>5%</option>
                    <option value=0>0%</option>
                </select> --}}

                <input type="number" name="t4rate" id="t4rate">
            </td>
        </tr>
    </table>





    <div class="container-fluid" style="text-align: center;margin: auto">



        <div class="row">
            <div class="col">
                <table border="1" style="text-align: center;margin:auto">
                    <tr>
                        <th>الكمـــية</th>
                        <td><input type=number step="any" name="quantity" id="quantity" onkeyup="mult2(this.value)"
                                onmouseover="mult2(this.value)"></td>
                    </tr>
                    <tr>
                        <th>المبلغ بالجنيه المصرى</th>
                        <td><input type=number step="any" name="amountEGP" id="amountEGP" onkeyup="mult(this.value);"
                                onmouseover="mult(this.value);"></td>
                    </tr>
                    <tr>
                        <th>إجمالي المبيعات</th>
                        <td><input type=number step="any" name="salesTotal" readonly id="salesTotal"></td>
                    </tr>
                    <tr>
                        <th>الخصـــم</th>
                        <td><input type="number" step="any" name="discountAmount" id="discountAmount"
                                onkeyup="discount(this.value)" onmouseover="discount(this.value)"></td>
                    </tr>
                    <tr>
                        <th>الإجمالى الصافى</th>
                        <td><input type="number" step="any" readonly name="netTotal" id="netTotal"
                                onkeyup="nettotal(this.value)" onmouseover="nettotal(this.value)"></td>
                    </tr>

                    <tr>

                        <th>قيمة الضريبة (النسبية) </th>
                        <td> <input type="number" step="any" name="t2Amount" readonly id="t2"
                                {{-- onkeyup="t2value(this.value)" onmouseover="t2value(this.value)" --}}>
                        </td>
                    </tr>


                    <tr>
                        <th> قيمة ضريبة (المنبع) </th>
                        <td> <input type="number" step="any" name="t4Amount" readonly id="t4Amount">
                        </td>
                    </tr>


                    <tr>
                        <th>خصــم الأصنــاف</th>
                        <td><input type="number" step="any" name="itemsDiscount" id="itemsDiscount"
                                onkeyup="itemsDiscountValue(this.value)" onmouseover="itemsDiscountValue(this.value)">
                        </td>
                    </tr>
                    <tr>
                        <th>إجمالي خصم الأصناف</th>
                        <td><input type="number" step="any" name="totalItemsDiscount" readonly id="totalItemsDiscount">
                        </td>
                    </tr>

                    <tr>
                        <th>خصم اضافي</th>
                        <td><input type="number" step="any" name="ExtraDiscount" id="ExtraDiscount"
                                onkeyup="Extradiscount(this.value)" onmouseover="Extradiscount(this.value)"></td>
                    </tr>
                    <th>المبلغ الإجمالي</th>
                    <td><input type="number" step="any" name="totalAmount" readonly id="totalAmount"></td>
                    </tr>

                    {{-- <td> <input type="number" step="any" name="t1Amount" readonly id="t1"></td> --}}


                </table>
            </div>
        </div>
    </div>



    <div style="text-align: center;margin:50px auto">
        <button type="submit" class="btn btn-success" style="font-size: 30px">إرسال الفاتـــورة</button>
    </div>


</form>

@endsection







@section('js')
<script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("#receiverName").select2({
        dir:"rtl"
    });
</script>
@endsection
