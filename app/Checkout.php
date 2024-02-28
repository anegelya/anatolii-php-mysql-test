<?php

/**
 * Class Checkout
 * 
 * Represents the checkout system in a supermarket,
 * handling the scanning of items and calculation
 * of the total price based on pricing rules.
 */
class Checkout
{
  /**
   * @var array The price list for items.
   */
  protected $prices = [
    'FR1' => 3.11,
    'SR1' => 5.00,
    'CF1' => 11.23,
  ];

  /**
   * @var array The items that have been scanned.
   */
  protected $items = [];

  /**
   * @var array The pricing rules for discounts.
   */
  protected $pricing_rules;

  /**
   * @var float The total price of the scanned items.
   */
  public $total;

  /**
   * Constructor for the Checkout class.
   * 
   * @param array $pricing_rules The pricing rules for discounts.
   */
  public function __construct(array $pricing_rules)
  {
    $this->pricing_rules = $pricing_rules;
  }

  /**
   * Scans an item and adds it to the basket, recalculating the total price.
   * 
   * @param string $item The product code of the item being scanned.
   * @return void
   */
  public function scan(string $item): void
  {
    $this->items[] = $item;
    $this->total = $this->calculate_total($this->items);
  }

  /**
   * Calculates the total price for the scanned items, applying any discounts.
   * 
   * @param array $items The list of item codes that have been scanned.
   * @return float The total price after applying discounts.
   */
  private function calculate_total(array $items): float
  {
    $totals = [];
    $item_counts = array_count_values($items);

    foreach ($item_counts as $item => $count) {

      $total_price_for_item = $count * $this->prices[$item];

      foreach ($this->pricing_rules[$item] ?? [] as $discount) {
        switch ($discount['type']) {
          case 'bogo':
            $payable_items = ceil($count / 2);
            $bogo_price = $payable_items * $this->prices[$item];
            $total_price_for_item = min($total_price_for_item, $bogo_price);
            break;

          case 'bulk':
            if ($count >= $discount['threshold']) {
              if (
                array_key_exists('discounted_product', $discount) &&
                array_key_exists($discount['discounted_product'], $item_counts)
              ) {
                $bulk_price = $item_counts[$discount['discounted_product']] * $discount['discounted_price'];
                $totals[$discount['discounted_product']] = min($totals[$discount['discounted_product']] ?? $bulk_price, $bulk_price);
              } else {
                $bulk_price = $count * $discount['discounted_price'];
                $total_price_for_item = min($total_price_for_item, $bulk_price);
              }
            }
            break;
        }
      }

      $totals[$item] = $total_price_for_item;
    }

    return array_sum($totals);
  }
}
