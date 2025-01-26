<?php

namespace Tests\Mock;

use Stripe\HttpClient\ClientInterface;

class StripeClientMock implements ClientInterface
{
    private const CODE = 200;
    private const HEADER = [];
    public function __construct(
        private string $rbody = '{}'
    ) {}

    /**
     * @inheritDoc
     */
    public function request($method, $absUrl, $headers, $params, $hasFile, $apiMode = 'v1')
    {
        if (strtolower($method) === 'post' && $absUrl === 'https://api.stripe.com/v1/customers') {
            $this->rbody = file_get_contents('tests/Mock/responses/checkous_session.json');
        }

        if (strtolower($method) === 'post' && $absUrl === 'https://api.stripe.com/v1/checkout/sessions') {
            $this->rbody = file_get_contents('tests/Mock/responses/checkous_session.json');
        }

        if (strtolower($method) === 'post' && $absUrl === 'https://api.stripe.com/v1/promotion_codes') {
            $this->rbody = file_get_contents('tests/Mock/responses/promotion_code.json');
        }

        if (strtolower($method) === 'post' && \preg_match('/^https:\/\/api\.stripe\.com\/v1\/promotion_codes\/[a-zA-Z0-9_]+$/', $absUrl)) {
            $this->rbody = file_get_contents('tests/Mock/responses/promotion_code.json');
        }

        return [
            $this->rbody,
            self::CODE,
            self::HEADER
        ];
    }
}