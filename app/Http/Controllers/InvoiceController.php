<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Invoice;
use Facade\FlareClient\Http\Response;
use download;

class InvoiceController extends Controller
{
    public function invoice(Request $request)
    {

        $invoice =
            [
                "issuer" => array(
                    "address" => array(
                        "branchID" => "0",
                        "country" => "EG",
                        "governate"
                        => auth()->user()->details->governate,

                        "regionCity" => auth()->user()->details->regionCity,
                        "street" => auth()->user()->details->street,
                        "buildingNumber" => auth()->user()->details->buildingNumber
                    ),
                    "type" => auth()->user()->details->issuerType,
                    "id" => "410973742",
                    "name" => "fouad el watan"
                ),
                "receiver" => array(
                    "address" => array(
                        "country" => "EG",
                        "governate" => $request->governate,
                        "regionCity" => $request->regionCity,
                        "street" => $request->street,
                        "buildingNumber" => $request->buildingNumber
                    ),
                    "type" => $request->receiverType,
                    "id" => $request->receiverId,
                    "name" => $request->receiverName
                ),
                "documentType" => "I",
                "documentTypeVersion" => "1.0",
                "dateTimeIssued" => date("Y-m-d") . "T" . date("h:i:s") . "Z",
                "taxpayerActivityCode" => "6920",
                "internalID" => $request->internalId,
                "invoiceLines" => array(array(
                    "description" => $request->invoiceDescription,
                    "itemType" => $request->itemType,
                    "itemCode" => "EG-410973742-100",
                    "internalCode" => "100",
                    "unitType" => "EA",
                    "quantity" => floatval($request->quantity),
                    "unitValue" => array(
                        "currencySold" => "EGP",
                        "amountSold" => 0.00,
                        "currencyExchangeRate" => 0.00,
                        "amountEGP" => floatval($request->amountEGP)
                    ),
                    "salesTotal" => floatval($request->salesTotal),
                    "discount" => array(
                        "rate" => 0.00,
                        "amount" => floatval($request->discountAmount)
                    ),
                    "netTotal" => floatval($request->netTotal),
                    "valueDifference" => 0.00,
                    "taxableItems" => array(
                        array(
                            "taxType" => "T4",
                            "amount" => floatval($request->t4Amount),
                            "subType" => "W004",
                            "rate" => floatval($request->t4rate)
                        ),
                        array(
                            "taxType" => "T2",
                            "amount" => floatval($request->t2Amount),
                            "subType" => "TBL01",
                            "rate" => floatval($request->rate)
                        )
                    ),
                    "totalTaxableFees" => 0.00,
                    "itemsDiscount" => floatval($request->itemsDiscount),
                    "total" => floatval($request->totalItemsDiscount)
                )),
                "totalSalesAmount" => floatval($request->salesTotal),
                "totalDiscountAmount" => floatval($request->discountAmount),
                "netAmount" => floatval($request->netTotal),
                "taxTotals" => array(
                    array(
                        "taxType" => "T4",
                        "amount" => floatval($request->t4Amount)
                    ),
                    array(
                        "taxType" => "T2",
                        "amount" => floatval($request->t2Amount)
                    )
                ),
                "totalItemsDiscountAmount" => floatval($request->itemsDiscount),
                "extraDiscountAmount" => floatval($request->ExtraDiscount),
                "totalAmount" => floatval($request->totalAmount),
                // "signatures" => array(array(
                //     "signatureType" => "I",
                //     "value" => "no validation"
                // ))
                // ))

            ];

        $trnsformed = json_encode($invoice, JSON_UNESCAPED_UNICODE);
        $myFileToJson = fopen("D:\EInvoicing\SourceDocumentJson.json", "w") or die("unable to open file");
        fwrite($myFileToJson, $trnsformed);


        return redirect()->route('cer');
    }
    public function openBat()
    {


        shell_exec('D:\EInvoicing\SubmitInvoices2.bat');

        $path = "D:\EInvoicing\FullSignedDocument.json";
        $path2 = "D:\EInvoicing\Cades.txt";
        $path3 = "D:\EInvoicing\CanonicalString.txt";
        $path4 = "D:\EInvoicing\SourceDocumentJson.json";


        $fullSignedFile = file_get_contents($path);



        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI"
        ]);

        $invoice =   Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json"
        ])->withBody($fullSignedFile, "application/json")->post('https://api.invoicing.eta.gov.eg/api/v1/documentsubmissions');


        if ($invoice['submissionId'] == !null) {
            unlink($path);
            unlink($path2);
            unlink($path3);
            unlink($path4);
            return redirect()->route('showAllInvoices')->with('success', $invoice['acceptedDocuments'][0]['uuid'] . ' تم تسجيل الفاتورة بنجاح برقم');
        } else {
            unlink($path);
            unlink($path2);
            unlink($path3);
            unlink($path4);
            return redirect()->route('showAllInvoices')->with('error', "يوجد خطأ فى الفاتورة من فضلك اعد تسجيلها");
        }
    }






    public function getData()
    {

        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI"
        ]);

        $getData = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->get("https://api.invoicing.eta.gov.eg/api/v1/documents/" . "F80PMKPW00MQZNGD135ANX9F10" . "/details");
        // $publicUrl = $getData['publicUrl'];
        // return redirect($publicUrl);
        return $getData->getBody();
    }


    public function showInvoices()
    {
        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI"
        ]);

        $showInvoices = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->get('https://api.invoicing.eta.gov.eg/api/v1.0/documents/recent?pageSize=2000000000');




        $allInvoices =  $showInvoices['result'];

        $allMeta =  $showInvoices['metadata'];
        return view('invoice.showissuer', compact('allInvoices', 'allMeta'));
    }
    public function showInvoices2()
    {
        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI"
        ]);

        $showInvoices = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->get('https://api.invoicing.eta.gov.eg/api/v1.0/documents/recent?pageSize=2000000000');




        $allInvoices =  $showInvoices['result'];

        $allMeta =  $showInvoices['metadata'];
        return view('invoice.showreciever', compact('allInvoices', 'allMeta'));
    }

    public function showPdfInvoice($uuid)
    {
        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI"
        ]);


        $showPdf = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Accept-Language" => 'ar'
        ])->get("https://api.invoicing.eta.gov.eg/api/v1/documents/" . $uuid . "/pdf");

        return  response($showPdf)->header('Content-Type', 'application/pdf');
    }

    public function create()
    {
        return view('invoice.create2');
    }

    public function cancelDocument($uuid)
    {
        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI"
        ]);

        $cancel = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->put(
            'https://api.invoicing.eta.gov.eg/api/v1.0/documents/state/' . $uuid . '/state',
            array(
                "status" => "cancelled",
                "reason" => "يوجد خطأ بالفاتورة"
            )
        );
        // return ($cancel);
        if ($cancel->ok()) {
            return redirect()->route('showAllInvoices')->with('success', 'تم تقديم طلب الغاء الفاتورة بنجاح سيتم الموافقة او الرفض فى خلال 3 ايام');
        } else {
            return redirect()->route('showAllInvoices')->with('error', $cancel['error']['details'][0]['message']);
        }
    }

    public function RejectDocument($uuid)
    {
        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI"
        ]);

        $cancel = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->put(
            'https://api.invoicing.eta.gov.eg/api/v1.0/documents/state/' . $uuid . '/state',
            array(
                "status" => "rejected",
                "reason" => "يوجد خطأ بالفاتورة"
            )
        );
        // return ($cancel);
        if ($cancel->ok()) {
            return redirect()->route('showAllInvoices2')->with('success', 'تم تقديم طلب رفض الفاتورة بنجاح سيتم الموافقة او الرفض فى خلال 3 ايام');
        } else {
            return redirect()->route('showAllInvoices2')->with('error', $cancel['error']['details'][0]['message']);
        }
    }


    // public function testApi()
    // {

    //     $getData = Http::get("https://solochain.info/test-app/trips/list_cars.php");

    //     $tests = ($getData->json()['cars']);

    //     return view('test', compact('tests'));
    // }
}