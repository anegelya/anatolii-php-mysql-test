-- Task 8
SELECT
  b.name,
  -- NOTE: DISTINCT can be used if we need to count unique applications in case when the same broker used by multiple customers for same application
  count(aa.application_id) AS total_applications
FROM
  brokers b
  LEFT JOIN application_applicants aa ON b.broker_id = aa.broker_id
GROUP BY
  b.broker_id;


-- Task 9
SELECT
  b.broker_id,
  b.name,
  a.application_id,
  GROUP_CONCAT(ash.status) AS status_transactions
FROM
  brokers b
  JOIN application_applicants aa ON aa.broker_id = b.broker_id
  JOIN applications a ON a.application_id = aa.application_id
  JOIN application_status_history ash ON ash.application_id = a.application_id
GROUP BY
  b.broker_id,
  a.application_id;


-- Task 10
SELECT
  c.*
FROM
  customers c
  LEFT JOIN (
    SELECT
      customer_id,
      SUM(DATEDIFF( IF(end_date IS NULL, CURDATE(), end_date), start_date)) AS total_days_covered
    FROM
      address_history
    GROUP BY
      customer_id) AS ah ON ah.customer_id = c.customer_id
WHERE
  ah.total_days_covered < 1825 OR ah.total_days_covered IS NULL;
