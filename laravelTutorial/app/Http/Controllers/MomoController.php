<?php

namespace App\Http\Controllers;

use App\Models\InvoiceDetails;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class MomoController extends Controller
{
    private $endpoint = 'https://test-payment.momo.vn/v2/gateway/api/create';
    private $accessKey = 'F8BBA842ECF85';
    private $secretKey = 'K951B6PE1waDMi640xX08PD3vg6EkVlz';
    private $partnerCode = 'MOMO';
    private $ipnUrl = 'https://1fa7-2001-ee0-d78a-f240-9051-d8da-50de-2d45.ngrok-free.app/api/momo-ipn'; //Chạy ngrok: ngrok http 8000
    private $redirectUrl = 'http://127.0.0.1:8000/invoices';

    public function process(Request $request)
    {
        // Lấy sản phẩm đầu tiên làm đại diện nếu có
        $selectedProducts = $request->selectedProducts;

        $productId = 'DEFAULT123';
        $product = null;

        if (is_array($selectedProducts) && !empty($selectedProducts)) {
            $product = collect($selectedProducts)->first();
            $productId = preg_replace('/[^0-9a-zA-Z\-_.:]/', '', (string) ($product['id'] ?? 'DEFAULT123'));
        }

        // dd($product, $productId, $request->selectedProducts);

        // Lấy tổng tiền
        $amount = $request->totalPrice ?? 1000;

        // Tạo các thông tin cần thiết
        $requestId = (string) Str::uuid();
        $orderId = 'INV-' . now()->format('YmdHis') . '-' . $productId;
        $orderInfo = "Thanh toán đơn hàng #$orderId";
        $requestType = "captureWallet";

        // Extra dữ liệu riêng để MoMo gửi lại khi IPN
        $extraData = json_encode([
            'userId' => $request->userId,
            'description' => $request->description,
            'status_payment' => $request->status_payment,
            'method_payment' => $request->method_payment,
            'signature' => $request->signature,
            'selectedProducts' => $request->selectedProducts,
            'discountId' => $request->discountId,
        ]);

        $redirect = $this->redirectUrl;

        // Tạo signature cho yêu cầu
        $rawHash = "accessKey={$this->accessKey}&amount={$amount}&extraData={$extraData}&ipnUrl={$this->ipnUrl}&orderId={$orderId}&orderInfo={$orderInfo}&partnerCode={$this->partnerCode}&redirectUrl={$redirect}&requestId={$requestId}&requestType={$requestType}";
        $signature = hash_hmac('sha256', $rawHash, $this->secretKey);

        $body = [
            "partnerCode" => $this->partnerCode,
            "partnerName" => "Test",
            "storeId" => "MomoTestStore",
            "requestId" => $requestId,
            "amount" => $amount,
            "orderId" => $orderId,
            "orderInfo" => $orderInfo,
            "redirectUrl" => $redirect,
            "ipnUrl" => $this->ipnUrl,
            "lang" => "vi",
            "extraData" => $extraData,
            "requestType" => $requestType,
            "signature" => $signature,
            "orderExpireTime" => 300000,
        ];

        $response = Http::post($this->endpoint, $body);

        return response()->json(json_decode($response->body(), true));
    }

    public function ipn(Request $request)
    {
        Log::info('IPN Momo:', $request->all());

        if ($request->resultCode == 0) {
            // Thanh toán thành công
            $parsed = json_decode($request->extraData, true);

            $userId = $parsed['userId'] ?? null;
            $description = $parsed['description'] ?? null;
            $statusPayment = $parsed['status_payment'] ?? null;
            $methodPayment = $parsed['method_payment'] ?? 'MOMO';
            $signature = $parsed['signature'] ?? null;
            $selectedProducts = $parsed['selectedProducts'] ?? [];
            $discountId = $parsed['discountId'] ?? null;

            if (!$userId || !$selectedProducts) {
                return response()->json(['message' => 'Missing userId or selectedProducts'], 422);
            }

            // Tạo hóa đơn
            $invoice = Invoices::create([
                'user_id' => $userId,
                'description' => $description,
                'total_amount' => $request->amount,
                'signature' => $signature,
            ]);

            // Tạo chi tiết hóa đơn
            foreach ($selectedProducts as $productId => $product) {
                $sizeId = $product['size_id'] ?? null;
                $colorId = $product['color_id'] ?? null;

                InvoiceDetails::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $productId,
                    'discount_id' => $discountId,
                    'quantity' => $product['quantity'],
                    'unit_price' => $product['price'],
                    'status_payment' => $statusPayment,
                    'method_payment' => $methodPayment,
                    'size_id' => $sizeId,
                    'color_id' => $colorId,
                ]);
            }

            return response()->json(['message' => 'Payment success'], 200) - with('success', 'Thanh toán thành công');
        }

        return response()->json(['message' => 'Payment failed'], 400);
    }
}