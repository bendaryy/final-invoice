<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

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
            var salesTotal,netTotal,z,t2valueEnd,t1Value;
            salesTotal = document.getElementById('salesTotal').value;
            netTotal = salesTotal - value;
           netTotalEnd =  document.getElementById('netTotal').value = netTotal;
            t2valueEnd =  document.getElementById('t2').value = netTotalEnd * 10/100;
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
            var x,netTotal,t1amount,t2amount;
            netTotal = document.getElementById('netTotal').value;
            // t1amount = document.getElementById('t1').value;
            t2amount =  document.getElementById('t2').value;
            // x = parseFloat(netTotal) + parseFloat(t1amount) + parseFloat(t2amount) - parseFloat(value);  this is an old value of x with t1
            x = parseFloat(netTotal) +parseFloat(t2amount) - parseFloat(value);
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

        .min-h-screen {
            min-height: 0px !important;
        }
    </style>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                {{ __('create new invoice') }}
            </h2>
            <div style="text-align: right">
                <a class="btn btn-success" href="{{ route('showAllInvoices') }}">show all invoices</a>
            </div>
        </x-slot>
    </x-app-layout>


    <form method="POST" action="{{ route('storeInvoice') }}">
        @method("POST")
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12" style="margin: auto;text-align: center">
                    <fieldset class="border p-3" style="border: 3px solid gold !important">
                        <legend class="w-auto p-3">issuer</legend>

                        <table style="margin: auto;text-align: center;">
                            <tr>
                                <th>governate</th>
                                <td><input class="borderNone" type="text" name="governate" placeholder="governate"></td>
                            </tr>
                            <tr>
                                <th>regionCity</th>
                                <td><input class="borderNone" type="text" name="regionCity" placeholder="regionCity">
                                </td>
                            </tr>
                            <tr>
                                <th>street</th>
                                <td><input class="borderNone" type="text" name="street" placeholder="street"></td>
                            </tr>
                            <tr>
                                <th>building Number</th>
                                <td><input class="borderNone" type="text" name="buildingNumber"
                                        placeholder="buildingNumber"></td>
                            </tr>
                            <tr>
                                <th>issuer Type</th>
                                <td>
                                    <select name="issuerType">
                                        <option value="B">Bussiness</option>
                                        <option value="p">person</option>
                                        <option value="f">foriegn</option>
                                    </select>
                                </td>
                            </tr>

                        </table>
                    </fieldset>
                </div>

                <div class="col-md-6 col-sm-12" style="margin: auto;text-align: center">

                    <fieldset class="border p-3" style="border: 3px solid gold !important">
                        <legend class="w-auto p-3">receiver</legend>
                        <table style="margin: auto">
                            <tr>
                                <th> governate</th>
                                <td> <input class="borderNone" type="text" name="governate"
                                        placeholder="governate of reciever"></td>
                            </tr>
                            <tr>
                                <th>region City</th>
                                <td> <input class="borderNone" type="text" name="regionCity"
                                        placeholder="regionCity of reciever"></td>
                            </tr>
                            <tr>
                                <th>street</th>
                                <td><input class="borderNone" type="text" name="street" placeholder="street"></td>
                            </tr>
                            <tr>
                                <th>building Number</th>
                                <td><input class="borderNone" type="text" name="buildingNumber"
                                        placeholder="buildingNumber"></td>
                            </tr>
                            <tr>
                                <th>receiver type</th>
                                <td>
                                    <select name="receiverType">
                                        <option value="B">Bussiness</option>
                                        <option value="P">person</option>
                                        <option value="F">foriegn</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>receiver id</th>
                                <td><input type="text" class="borderNone" name="receiverId" placeholder="receiver id">
                                </td>
                            </tr>
                            <tr>
                                <th>receiver name</th>
                                <td><input class="borderNone" type="text" name="receiverName"
                                        placeholder="receiver name"></td>
                            </tr>
                            <tr>
                                <th>item type</th>
                                <td>
                                    <select name="itemType">
                                        <option value="GS1">GS1</option>
                                        <option value="EGS">EGS</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </div>

            </div>
        </div>

        <hr style="border: 1px solid black;margin:50px 20px">



        <div class="container-fluid" style="text-align: center;margin: auto">
            <div class="row">
                <div class="col">
                    <table border="1" style="text-align: center;margin:auto">
                        <tr>
                            <th>quanity</th>
                            <th>amout EGP</th>
                            <th> sales total</th>
                            <th>discount</th>
                            <th>net total</th>
                            <th>t2 amount</th>
                            {{-- <th>t1 amount</th> --}}
                            <th>items discount</th>
                            <th>total items discount</th>
                            <th>extra discount</th>
                            <th>total amount</th>
                        </tr>
                        <tr>
                            <td><input type=number step="any" name="quantity" id="quantity" onkeyup="mult2(this.value)"
                                    onmouseover="mult2(this.value)"></td>
                            <td><input type=number step="any" name="amountEGP" id="amountEGP"
                                    onkeyup="mult(this.value);" onmouseover="mult(this.value);"></td>
                            <td><input type=number step="any" name="salesTotal" readonly id="salesTotal"></td>
                            <td><input type="number" step="any" name="discountAmount" id="discountAmount"
                                    onkeyup="discount(this.value)" onmouseover="discount(this.value)"></td>
                            <td><input type="number" step="any" readonly name="netTotal" id="netTotal"
                                    onkeyup="nettotal(this.value)" onmouseover="nettotal(this.value)"></td>
                            <td> <input type="number" step="any" name="t2Amount" readonly id="t2"
                                    onkeyup="t2value(this.value)" onmouseover="t2value(this.value)">
                            </td>
                            {{-- <td> <input type="number" step="any" name="t1Amount" readonly id="t1"></td> --}}
                            <td><input type="number" step="any" name="itemsDiscount" id="itemsDiscount"
                                    onkeyup="itemsDiscountValue(this.value)"
                                    onmouseover="itemsDiscountValue(this.value)"></td>
                            <td><input type="number" step="any" name="totalItemsDiscount" id="totalItemsDiscount"></td>
                            <td><input type="number" step="any" name="ExtraDiscount" id="ExtraDiscount"
                                    onkeyup="Extradiscount(this.value)" onmouseover="Extradiscount(this.value)"></td>
                            <td><input type="number" step="any" name="totalAmount" id="totalAmount"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>



        <div style="text-align: center;margin:50px auto">
            <button type="submit" class="btn btn-success">Send invoice</button>
        </div>


    </form>


    <script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    </script>
</body>

</html>
