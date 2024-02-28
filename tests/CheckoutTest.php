<?php

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../app/Checkout.php';

class CheckoutTest extends TestCase
{
  protected $pricingRules;

  protected function setUp(): void
  {
    $this->pricingRules = [
      'FR1' => [
        ['type' => 'bogo'],
      ],
      'SR1' => [
        ['type' => 'bulk', 'threshold' => 3, 'discounted_price' => 4.50],
      ],
    ];
  }

  public function testSingleItemNoDiscount()
  {
    $checkout = new Checkout($this->pricingRules);
    $checkout->scan('CF1');
    $this->assertEquals(11.23, $checkout->total);
  }

  public function testBOGODiscount()
  {
    $checkout = new Checkout($this->pricingRules);
    $checkout->scan('FR1');
    $checkout->scan('FR1');
    $this->assertEquals(3.11, $checkout->total);
  }

  public function testBulkDiscount()
  {
    $checkout = new Checkout($this->pricingRules);
    $checkout->scan('SR1');
    $checkout->scan('SR1');
    $checkout->scan('SR1');
    $this->assertEquals(13.50, $checkout->total);
  }

  public function testTotalPrice()
  {
    $co = new Checkout($this->pricingRules);
    $co->scan('FR1');
    $co->scan('SR1');
    $co->scan('FR1');
    $co->scan('FR1');
    $co->scan('CF1');
    $this->assertEquals(22.45, $co->total);

    $co = new Checkout($this->pricingRules);
    $co->scan('FR1');
    $co->scan('FR1');
    $this->assertEquals(3.11, $co->total);

    $co = new Checkout($this->pricingRules);
    $co->scan('SR1');
    $co->scan('SR1');
    $co->scan('FR1');
    $co->scan('SR1');
    $this->assertEquals(16.61, $co->total);
  }

  public function testMultipleRulesDiscount()
  {
    // Multiple pricing rules for FR1
    $pricingRules = [
      'FR1' => [
        ['type' => 'bogo'],
        ['type' => 'bulk', 'threshold' => 3, 'discounted_price' => 1],
      ],
      'SR1' => [
        ['type' => 'bulk', 'threshold' => 3, 'discounted_price' => 4.50],
      ],
    ];

    $co = new Checkout($pricingRules);
    $co->scan('FR1');
    $co->scan('FR1');
    $co->scan('FR1');
    $this->assertEquals(3, $co->total);
  }

  public function testCrossBulkRulesNoDiscount()
  {
    $pricingRules = [];

    $co = new Checkout($pricingRules);
    $co->scan('FR1');
    $co->scan('FR1');
    $co->scan('FR1');
    $co->scan('SR1');
    $this->assertEquals(14.33, $co->total);
  }

  public function testCrossBulkRulesDiscount()
  {
    // Cross Bulk discount
    $pricingRules = [
      'FR1' => [
        [
          'type' => 'bulk', 
          'threshold' => 3,
          'discounted_price' => 1,
          'discounted_product' => 'SR1',
        ],
      ],
    ];

    $co = new Checkout($pricingRules);
    $co->scan('FR1');
    $co->scan('SR1');
    $co->scan('FR1');
    $co->scan('FR1');
    $this->assertEquals(14.33, $co->total);
  }
}
