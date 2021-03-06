<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invoice;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
                    "governate" => auth()->user()->details->governate,

                    "regionCity" => auth()->user()->details->regionCity,
                    "street" => auth()->user()->details->street,
                    "buildingNumber" => auth()->user()->details->buildingNumber,
                ),
                "type" => auth()->user()->details->issuerType,
                "id" => auth()->user()->details->company_id,
                "name" => auth()->user()->details->company_name,
            ),
            "receiver" => array(
                "address" => array(
                    "country" => "EG",
                    "governate" => "-",
                    "regionCity" => "-",
                    "street" => $request->street,
                    "buildingNumber" => "-",
                ),
                "type" => $request->receiverType,
                "id" => $request->receiverId,
                "name" => $request->receiverName,
            ),
            "documentType" => $request->DocumentType,
            "documentTypeVersion" => "1.0",
            "dateTimeIssued" => $request->date . "T" . date("h:i:s") . "Z",
            "taxpayerActivityCode" => "6920",
            "internalID" => $request->internalId,
            "invoiceLines" => [

                // array(
                //     "description" => $request->invoiceDescription,
                //     "itemType" => $request->itemType,
                //     "itemCode" => "EG-410973742-100",
                //     "internalCode" => "100",
                //     "unitType" => "EA",
                //     "quantity" => floatval($request->quantity),
                //     "unitValue" => array(
                //         "currencySold" => "EGP",
                //         "amountSold" => 0.00,
                //         "currencyExchangeRate" => 0.00,
                //         "amountEGP" => floatval($request->amountEGP)
                //     ),
                //     "salesTotal" => floatval($request->salesTotal),
                //     "discount" => array(
                //         "rate" => 0.00,
                //         "amount" => floatval($request->discountAmount)
                //     ),
                //     "netTotal" => floatval($request->netTotal),
                //     "valueDifference" => 0.00,
                //     "taxableItems" => array(
                //         array(
                //             "taxType" => "T4",
                //             "amount" => floatval($request->t4Amount),
                //             "subType" => "W004",
                //             "rate" => floatval($request->t4rate)
                //         ),
                //         array(
                //             "taxType" => "T2",
                //             "amount" => floatval($request->t2Amount),
                //             "subType" => "TBL01",
                //             "rate" => floatval($request->rate)
                //         )
                //     ),
                //     "totalTaxableFees" => 0.00,
                //     "itemsDiscount" => floatval($request->itemsDiscount),
                //     "total" => floatval($request->totalItemsDiscount)
                // )

                // add second object

            ],
            "totalDiscountAmount" => floatval($request->totalDiscountAmount),
            "totalSalesAmount" => floatval($request->TotalSalesAmount),
            "netAmount" => floatval($request->TotalNetAmount),
            "taxTotals" => array(
                array(
                    "taxType" => "T4",
                    "amount" => floatval($request->totalt4Amount),
                ),
                array(
                    "taxType" => "T2",
                    "amount" => floatval($request->totalt2Amount),
                ),
            ),
            "totalAmount" => floatval($request->totalAmount2),
            "extraDiscountAmount" => floatval($request->ExtraDiscount),
            "totalItemsDiscountAmount" => floatval($request->totalItemsDiscountAmount),
        ];

        for ($i = 0; $i < count($request->quantity); $i++) {
            $Data = [
                "description" => $request->invoiceDescription[$i],
                "itemType" => "EGS",
                "itemCode" => "EG-410973742-100",
                "unitType" => "EA",
                "quantity" => floatval($request->quantity[$i]),
                "internalCode" => "100",
                "salesTotal" => floatval($request->salesTotal[$i]),
                "total" => floatval($request->totalItemsDiscount[$i]),
                "valueDifference" => 0.00,
                "totalTaxableFees" => 0.00,
                "netTotal" => floatval($request->netTotal[$i]),
                "itemsDiscount" => floatval($request->itemsDiscount[$i]),

                "unitValue" => [
                    "currencySold" => "EGP",
                    "amountSold" => 0.00,
                    "currencyExchangeRate" => 0.00,
                    "amountEGP" => floatval($request->amountEGP[$i]),
                ],
                "discount" => [
                    "rate" => 0.00,
                    "amount" => floatval($request->discountAmount[$i]),
                ],
                "taxableItems" => [
                    [

                        "taxType" => "T4",
                        "amount" => floatval($request->t4Amount[$i]),
                        "subType" => "W010",
                        "rate" => floatval($request->t4rate[$i]),
                    ],
                    [
                        "taxType" => "T2",
                        "amount" => floatval($request->t2Amount[$i]),
                        "subType" => "TBL01",
                        "rate" => floatval($request->rate[$i]),
                    ],
                ],

            ];
            $invoice['invoiceLines'][$i] = $Data;
        }

        $trnsformed = json_encode($invoice, JSON_UNESCAPED_UNICODE);
        $myFileToJson = fopen("C:\laragon\www\live\EInvoicing\SourceDocumentJson.json", "w") or die("unable to open file");
        fwrite($myFileToJson, $trnsformed);

        return redirect()->route('cer');
    }
    public function openBat()
    {

        shell_exec('C:\laragon\www\live\EInvoicing\SubmitInvoices2.bat');

        $path = "C:\laragon\www\live\EInvoicing\FullSignedDocument.json";
        $path2 = "C:\laragon\www\live\EInvoicing\Cades.txt";
        $path3 = "C:\laragon\www\live\EInvoicing\CanonicalString.txt";
        $path4 = "C:\laragon\www\live\EInvoicing\SourceDocumentJson.json";

        $fullSignedFile = file_get_contents($path);

        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $invoice = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json",
        ])->withBody($fullSignedFile, "application/json")->post('https://api.invoicing.eta.gov.eg/api/v1/documentsubmissions');

        if ($invoice['submissionId'] == !null) {
            unlink($path);
            unlink($path2);
            unlink($path3);
            unlink($path4);
            return redirect()->route('showAllInvoices')->with('success', ' ???? ?????????? ???????????????? ?????????? ????????' . $invoice['acceptedDocuments'][0]['uuid']);
        } else {
            unlink($path);
            unlink($path2);
            unlink($path3);
            unlink($path4);
            return redirect()->route('showAllInvoices')->with('error', "???????? ?????? ???? ???????????????? ???? ???????? ?????? ??????????????");
        }
    }

    public function getData()
    {

        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
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
            'scope' => "InvoicingAPI",
        ]);

        $showInvoices = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->get('https://api.invoicing.eta.gov.eg/api/v1.0/documents/recent?pageSize=2000000000');

        $allInvoices = $showInvoices['result'];

        $allMeta = $showInvoices['metadata'];
        return view('invoice.showissuer', compact('allInvoices', 'allMeta'));
    }
    public function showInvoices2()
    {
        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $showInvoices = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->get('https://api.invoicing.eta.gov.eg/api/v1.0/documents/recent?pageSize=2000000000');

        $allInvoices = $showInvoices['result'];

        $allMeta = $showInvoices['metadata'];
        return view('invoice.showreciever', compact('allInvoices', 'allMeta'));
    }

    public function showPdfInvoice($uuid)
    {
        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $showPdf = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Accept-Language" => 'ar',
        ])->get("https://api.invoicing.eta.gov.eg/api/v1/documents/" . $uuid . "/pdf");

        return response($showPdf)->header('Content-Type', 'application/pdf');
    }

    public function create()
    {
        $allCompanies = Company::all();
        return view('invoice.create2', compact('allCompanies'));
    }

    public function cancelDocument($uuid)
    {
        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $cancel = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->put(
            'https://api.invoicing.eta.gov.eg/api/v1.0/documents/state/' . $uuid . '/state',
            array(
                "status" => "cancelled",
                "reason" => "???????? ?????? ??????????????????",
            )
        );
        // return ($cancel);
        if ($cancel->ok()) {
            return redirect()->route('showAllInvoices')->with('success', '???? ?????????? ?????? ?????????? ???????????????? ?????????? ???????? ???????????????? ???? ?????????? ???? ???????? 3 ????????');
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
            'scope' => "InvoicingAPI",
        ]);

        $cancel = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->put(
            'https://api.invoicing.eta.gov.eg/api/v1.0/documents/state/' . $uuid . '/state',
            array(
                "status" => "rejected",
                "reason" => "???????? ?????? ??????????????????",
            )
        );
        // return ($cancel);
        if ($cancel->ok()) {
            return redirect()->route('showAllInvoices2')->with('success', '???? ?????????? ?????? ?????? ???????????????? ?????????? ???????? ???????????????? ???? ?????????? ???? ???????? 3 ????????');
        } else {
            return redirect()->route('showAllInvoices2')->with('error', $cancel['error']['details'][0]['message']);
        }
    }

    public function create3(Request $request)
    {
        $allCompanies = Company::all();
        $companies = Company::where('id', $request->receiverName)->get();
        return view('invoice.create3', compact('companies', 'allCompanies'));
    }

    // public function testApi()
    // {

    //     $getData = Http::get("https://solochain.info/test-app/trips/list_cars.php");

    //     $tests = ($getData->json()['cars']);

    //     return view('test', compact('tests'));
    // }
}
