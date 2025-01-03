<?php

namespace App\Http\Controllers;

use App\DTOs\DownloadReceiptDTO;
use App\Http\Requests\DownloadReceiptRequest;
use App\Models\Course;
use App\Models\User;
use App\Services\ReceiptRenderer\ReceiptRenderer;
use App\View\Receipt;
use Stripe\StripeObject;

class DownloadStripeReceiptController extends Controller
{
    public function __construct(
        private readonly ReceiptRenderer $receiptRenderer,
    ) {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(DownloadReceiptRequest $request)
    {
        $dto = DownloadReceiptDTO::fromRequest(request: $request);
        $receipt = new Receipt(
            courseId: $dto->courseId,
            customerId: $dto->customerId,
            date: \DateTimeImmutable::createFromFormat('d M H:i', trim($dto->date)),
            card: StripeObject::constructFrom($dto->card),
        );
        $course = Course::find($dto->courseId);
        $customer = User::where('stripe_id', $dto->customerId)->first();

        return $this->receiptRenderer->render(receipt: $receipt, course: $course, customer: $customer);
    }
}
