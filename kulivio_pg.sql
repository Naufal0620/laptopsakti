-- PostgreSQL SQL Dump
-- Derived from MySQL Dump

-- Set standard settings
SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

-- --------------------------------------------------------

--
-- Table structure for table "coupons"
--

DROP TABLE IF EXISTS "coupons" CASCADE;
CREATE TABLE "coupons" (
  "id" BIGSERIAL PRIMARY KEY,
  "code" varchar(255) NOT NULL,
  "type" varchar(255) NOT NULL CHECK ("type" IN ('percentage','fixed')),
  "value" int NOT NULL,
  "max_discount" int DEFAULT NULL,
  "min_order" int NOT NULL DEFAULT 0,
  "start_date" timestamp DEFAULT NULL,
  "end_date" timestamp DEFAULT NULL,
  "usage_limit" int DEFAULT NULL,
  "limit_per_user" int NOT NULL DEFAULT 1,
  "is_active" boolean NOT NULL DEFAULT TRUE,
  "created_at" timestamp DEFAULT NULL,
  "updated_at" timestamp DEFAULT NULL,
  CONSTRAINT "coupons_code_unique" UNIQUE ("code")
);

--
-- Dumping data for table "coupons"
--

INSERT INTO "coupons" ("id", "code", "type", "value", "max_discount", "min_order", "start_date", "end_date", "usage_limit", "limit_per_user", "is_active", "created_at", "updated_at") VALUES
(1, 'HEMAT10', 'percentage', 10, 10000, 50000, '2026-05-21 09:33:16', '2026-06-21 09:33:16', 100, 1, TRUE, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(2, 'DISKON5RB', 'fixed', 5000, NULL, 20000, NULL, NULL, NULL, 1, TRUE, '2026-05-21 02:33:16', '2026-05-21 02:33:16');

-- Reset sequence for "coupons"
SELECT setval('coupons_id_seq', (SELECT max(id) FROM "coupons"));

-- --------------------------------------------------------

--
-- Table structure for table "products"
--

DROP TABLE IF EXISTS "products" CASCADE;
CREATE TABLE "products" (
  "id" BIGSERIAL PRIMARY KEY,
  "name" varchar(255) NOT NULL,
  "description" text NOT NULL,
  "price" int NOT NULL,
  "discount_type" varchar(255) NOT NULL DEFAULT 'none' CHECK ("discount_type" IN ('none','percentage','fixed')),
  "discount_value" int NOT NULL DEFAULT 0,
  "pre_order_days" int NOT NULL DEFAULT 1,
  "is_active" boolean NOT NULL DEFAULT TRUE,
  "created_at" timestamp DEFAULT NULL,
  "updated_at" timestamp DEFAULT NULL
);

--
-- Dumping data for table "products"
--

INSERT INTO "products" ("id", "name", "description", "price", "discount_type", "discount_value", "pre_order_days", "is_active", "created_at", "updated_at") VALUES
(1, 'Sayur Segar', 'Paket sayuran segar pilihan langsung dari petani lokal, cocok untuk masakan rumahan sehat.', 15000, 'none', 0, 1, TRUE, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(2, 'Cookie Ice Cream Sandwich', 'Kombinasi sempurna antara soft cookie cokelat dan es krim vanilla premium di tengahnya.', 25000, 'percentage', 10, 2, TRUE, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(3, 'Dorito Chips', 'Keripik jagung renyah dengan bumbu keju nacho yang melimpah dan gurih.', 12000, 'none', 0, 1, TRUE, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(4, 'Sour Bread', 'Roti sourdough autentik dengan tekstur kenyal dan rasa sedikit asam yang khas, tanpa pengawet.', 30000, 'fixed', 5000, 2, TRUE, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(5, 'Pizza', 'Pizza artisan dengan topping mozzarella lumer, daging pilihan, dan saus tomat rahasia.', 85000, 'none', 0, 1, TRUE, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(6, 'Sugar Sour Bread', 'Varian sourdough dengan sentuhan gula karamel di bagian kulit luar yang renyah.', 35000, 'none', 0, 2, TRUE, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(7, 'Kebab', 'Kebab isi daging sapi panggang melimpah, sayuran segar, dan saus spesial kulivio.', 22000, 'percentage', 15, 1, TRUE, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(8, 'Sop Dumpling', 'Sop kaldu ayam bening dengan dumpling isi ayam udang yang lembut dan hangat.', 45000, 'none', 0, 2, TRUE, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(9, 'Cheese Cake', 'New York style cheesecake yang creamy dan lembut dengan crust biskuit yang gurih.', 150000, 'fixed', 20000, 3, TRUE, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(10, 'Ribs and Fries', 'Iga sapi panggang empuk dengan bumbu BBQ meresap, disajikan dengan kentang goreng renyah.', 125000, 'none', 0, 2, TRUE, '2026-05-21 02:33:16', '2026-05-21 02:33:16');

-- Reset sequence for "products"
SELECT setval('products_id_seq', (SELECT max(id) FROM "products"));

-- --------------------------------------------------------

--
-- Table structure for table "users"
--

DROP TABLE IF EXISTS "users" CASCADE;
CREATE TABLE "users" (
  "id" BIGSERIAL PRIMARY KEY,
  "name" varchar(255) NOT NULL,
  "email" varchar(255) NOT NULL,
  "email_verified_at" timestamp DEFAULT NULL,
  "password" varchar(255) NOT NULL,
  "phone" varchar(255) DEFAULT NULL,
  "role" varchar(255) NOT NULL DEFAULT 'customer' CHECK ("role" IN ('admin','customer','courier')),
  "remember_token" varchar(100) DEFAULT NULL,
  "created_at" timestamp DEFAULT NULL,
  "updated_at" timestamp DEFAULT NULL,
  CONSTRAINT "users_email_unique" UNIQUE ("email")
);

--
-- Dumping data for table "users"
--

INSERT INTO "users" ("id", "name", "email", "email_verified_at", "password", "phone", "role", "remember_token", "created_at", "updated_at") VALUES
(1, 'Administrator Kulivio', 'admin@kulivio.com', '2026-05-21 02:33:16', '$2y$12$J8XZPsokEooH/qyOz9NCy.zDXqbzz9R7zQNmAt48OtitGURYePdBy', '628111111111', 'admin', 'rTS31S9nKO', '2026-05-21 02:33:17', '2026-05-21 02:33:17'),
(2, 'Budi Pelanggan', 'user@kulivio.com', '2026-05-21 02:33:17', '$2y$12$t2XcWTyhOcecW1EB.dfmgOSra1pPdzwCcl/VeWb.cpkESHtApICsy', '628222222222', 'customer', 'rDVsp5CXng', '2026-05-21 02:33:17', '2026-05-21 02:33:17'),
(3, 'Keyshawn Homenick', 'imedhurst@example.net', '2026-05-21 02:33:17', '$2y$12$Jdbq6brSEqpNYaC5K7TvP.CB7IOpMX/dpoutMd4bdEkE3D9nKV3R2', '1-864-864-1835', 'customer', 'oFCBAorCyL', '2026-05-21 02:33:18', '2026-05-21 02:33:18'),
(4, 'Marlen Kuhic', 'theidenreich@example.com', '2026-05-21 02:33:18', '$2y$12$eqwN0VRZQTLxrrWE7BzIleLYrNYwagWnIZS6wiGV8oHHYF5GQM21u', '321-667-8218', 'customer', 'Hwe5fC1Sh4', '2026-05-21 02:33:18', '2026-05-21 02:33:18'),
(5, 'Telly Lakin', 'herminio67@example.org', '2026-05-21 02:33:18', '$2y$12$x3hIKJOJDrsIYnOyWcr6RucRq.ukZM1fqL/xgHZQqhvw6sXJA27sK', '608.615.9679', 'customer', 'Un9WbLx3VT', '2026-05-21 02:33:19', '2026-05-21 02:33:19'),
(6, 'Mr. Jesse Hoppe', 'liana.lind@example.net', '2026-05-21 02:33:19', '$2y$12$XU6xrPPKZqawMnFxyTCvfeSElYVAembBKHmDYrDdf/OKhQ.BmYpNC', '+1-830-750-0981', 'customer', 'BIMDA07YUv', '2026-05-21 02:33:19', '2026-05-21 02:33:19'),
(7, 'Shania Wuckert', 'ohara.maverick@example.org', '2026-05-21 02:33:19', '$2y$12$VprIvSMRn2WlgCprxoISoeMZs.mqKZg69wdmP49VNZezbB75epZru', '+1-351-613-8383', 'customer', '6XcrZOc5AQ', '2026-05-21 02:33:19', '2026-05-21 02:33:19'),
(8, 'Anastacio Carter DDS', 'kane.gislason@example.net', '2026-05-21 02:33:19', '$2y$12$ktGxXMyOh8pAlDFAZOmbCucFMT81wnevB.VDV5XXxO2NJHG6woSc.', '253.902.0824', 'customer', '5u1Tt1Hiin', '2026-05-21 02:33:20', '2026-05-21 02:33:20'),
(9, 'Meggie Price', 'runolfsson.justyn@example.net', '2026-05-21 02:33:20', '$2y$12$zfYc0ghJCxpQo.Uv7.CyhOhf.CTHTjNwow7ms/P6L8MohPC9nOr1a', '(623) 788-5494', 'customer', 'GpM8xPefc1', '2026-05-21 02:33:20', '2026-05-21 02:33:20'),
(10, 'Dr. Santina Kunze II', 'macejkovic.floy@example.org', '2026-05-21 02:33:20', '$2y$12$A/5/a7vdsUvO4RyHKsy9cuDL3VNmjrYypxc8Urb3QBrLd1F3R7ad2', '(313) 507-5597', 'customer', '00YaBgToLw', '2026-05-21 02:33:20', '2026-05-21 02:33:20'),
(11, 'Modesto Zemlak II', 'hermann58@example.org', '2026-05-21 02:33:20', '$2y$12$AQx3Rv84pNAlxLGrCJfFxOZxACgXWPEpEMN9nDpqyCAiKcsnapkCa', '870.281.3696', 'customer', 'WqVrlcQutJ', '2026-05-21 02:33:21', '2026-05-21 02:33:21'),
(12, 'Wilson Buckridge', 'tillman.gage@example.com', '2026-05-21 02:33:21', '$2y$12$F5aETx9SBl2y4nwEuiYp.ueR.1Yj5VNhCnlsUmMlW5R9f/KLQlkY.', '(940) 616-9897', 'customer', 'y9GYllcBJp', '2026-05-21 02:33:21', '2026-05-21 02:33:21'),
(13, 'Kurir Ahmad', 'kurir1@kulivio.com', '2026-05-21 02:33:21', '$2y$12$j53BIb/yfe382OLGLhe2/O4Ih7/4EdvS7XeL99oBvzljCchx7siOC', '628333333333', 'courier', 'vYIgHwgi0A', '2026-05-21 02:33:22', '2026-05-21 02:33:22'),
(14, 'Kurir Siti', 'kurir2@kulivio.com', '2026-05-21 02:33:22', '$2y$12$3SDLDZNS.iRQ2mM8XlgZdOCY8r3ctLGdLooOnNgMA9pIZ1xF.e1DC', '628444444444', 'courier', 'QwfsbfMNNd', '2026-05-21 02:33:22', '2026-05-21 02:33:22'),
(15, 'Novella Abbott', 'tavares21@example.org', '2026-05-21 02:33:22', '$2y$12$j/Ozd4f4ILWE0yA1IzlwlelRqtSyHj2MhrcTWODIsIIQnGySZ1yiG', '+1-341-908-4284', 'courier', 'ERlCHuBpQa', '2026-05-21 02:33:22', '2026-05-21 02:33:22'),
(16, 'Wilson Yost', 'rjerde@example.com', '2026-05-21 02:33:22', '$2y$12$f2U4wODD.3LalNBBv0zcZOdeHFtoWNXAtn0rCbOFy82lntEBexklS', '831.929.0795', 'courier', 'xK5qaoZhi3', '2026-05-21 02:33:23', '2026-05-21 02:33:23'),
(17, 'Lester Jacobson', 'yasmine.adams@example.org', '2026-05-21 02:33:23', '$2y$12$L/gh2tLdtdo6i.PDdkPFReMz.o1F02eQ0BJ4iNWXnP7wp6KB55KKq', '(248) 991-5938', 'courier', 'zhAAfL6fzZ', '2026-05-21 02:33:23', '2026-05-21 02:33:23');

-- Reset sequence for "users"
SELECT setval('users_id_seq', (SELECT max(id) FROM "users"));

COMMIT;
