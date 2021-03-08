<?php


namespace App\Processors;


use GuzzleHttp\Client;

class CouponCodeVerifyProcessor
{
    public $response;
    public $request;
    public $host;

    public function __construct($host)
    {
        $this->host = env('COUPON_CODE_VERIFICATION_URL');
    }

    public function verify($username, $coupon_code)
    {
        $client = new Client();
        try {
            $url = $this->host.'/coupon_system/verify';

            $this->response = $client->request('POST', $url, [
                'json' => [
                    'username' => $username,
                    'coupon_code' => $coupon_code
                ],
                'verify' => false,
                'headers' => [
                    'User-Agent' => 'HTTPie/0.9.8',
                    'Accepts'     => '*/*',
                ]
            ]);
            return $this->response->getBody()->read($this->response->getBody()->getSize());
        } catch ( \Exception $exception) {
            flash()->error($exception->getMessage());
            return false;
        }
    }
}
