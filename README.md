# Anatolii Nehelia Test

## PHP Test

Rules can be stored in database and fetched per product.

The checkout system is flexible and accepts multiple rules per product (if needed). For example, check the test `testMultipleRulesDiscount`. When multiple discount rules are applied, the lowest price is selected.

Also, a bulk discount can be applied to another product by setting `discounted_product` (see `testCrossBulkRulesDiscount` for an example). If there is no `discounted_product`, then the discount is applied to the product itself.

### Testing

1. Install composer dependencies for tests

2. Run tests

```bash
./vendor/bin/phpunit --coverage-text tests
```

## MySQL Test

SQL files located in `sql` folder.

Run MySQL in docker if needed by:

```bash
docker-compose up
```

Please take a look into `NOTES` I left in `schema.sql`, `seed.sql` and `queries.sql`
