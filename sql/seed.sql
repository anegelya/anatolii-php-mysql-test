INSERT INTO `customers` (`customer_id`, `full_name`, `date_of_birth`, `email`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', '1985-02-15', 'johndoe@example.com', '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(2, 'Jane Smith', '1990-07-22', 'janesmith@example.com', '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(3, 'Alice Johnson', '1982-11-05', 'alicejohnson@example.com', '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(4, 'Mark Smith', '1992-09-26', 'marksmith@example.com', '2024-02-28 12:06:46', '2024-02-28 12:06:46');

INSERT INTO `address_history` (`address_id`, `customer_id`, `address`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 1, '123 Main St, Anytown, USA', '2018-01-01', NULL, '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(2, 2, '456 Elm St, Anytown, USA', '2019-01-01', NULL, '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(3, 3, '789 Pine St, Anytown, USA', '2020-01-01', '2020-12-31', '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(4, 3, '101 Oak St, Anytown, USA', '2021-01-01', NULL, '2024-02-28 12:06:46', '2024-02-28 12:06:46');

INSERT INTO `brokers` (`broker_id`, `name`, `email`, `company_address`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Broker One', 'brokerone@example.com', '123 Broker Lane', 'A', '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(2, 'Broker Two', 'brokertwo@example.com', '456 Broker Street', 'B,C', '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(3, 'Broker Three', 'brokerthree@example.com', '833 Broker Street', 'A,C', '2024-02-28 12:40:13', '2024-02-28 12:40:13');

INSERT INTO `products` (`product_id`, `name`, `interest_rate`, `term`, `created_at`, `updated_at`) VALUES
(1, 'Home Loan', 5.50, 30, '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(2, 'Car Loan', 4.00, 5, '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(3, 'Personal Loan', 6.50, 3, '2024-02-28 12:06:46', '2024-02-28 12:06:46');

INSERT INTO `applications` (`application_id`, `loan_amount`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 200000.00, 1, '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(2, 30000.00, 2, '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(3, 5000.00, 3, '2024-02-28 12:06:46', '2024-02-28 12:06:46');

INSERT INTO `application_applicants` (`app_applicant_id`, `application_id`, `customer_id`, `broker_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(2, 2, 2, 2, '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(3, 3, 3, NULL, '2024-02-28 12:06:46', '2024-02-28 12:06:46'),
(4, 2, 3, 2, '2024-02-28 12:23:18', '2024-02-28 12:24:09');

INSERT INTO `application_status_history` (`status_history_id`, `application_id`, `status`, `changed_at`) VALUES
(1, 1, 'NEW', '2024-02-28 12:06:46'),
(2, 2, 'PROCESSING', '2024-02-28 12:06:46'),
(3, 3, 'APPROVED', '2024-02-28 12:06:46'),
(4, 2, 'CANCELLED', '2024-02-28 12:44:32');
