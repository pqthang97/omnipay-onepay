<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\OnePay\Message\PurchaseResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new PurchaseResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ], 'john doe');

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
        $this->assertEquals('john doe', $response->getRedirectUrl());
    }

    public function testPurchase()
    {
        $response = new PurchaseResponse($this->getMockRequest(), [
            'vpc_MerchTxnRef' => 123,
        ], 'john doe');

        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('123', $response->getTransactionId());
        $this->assertEquals('GET', $response->getRedirectMethod());
        $this->assertEquals('123', $response->vpc_MerchTxnRef);
        $this->assertEquals('123', $response->vpcMerchTxnRef);
    }
}
