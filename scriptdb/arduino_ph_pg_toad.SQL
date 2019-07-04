/*
Created: 29/6/2019
Modified: 29/6/2019
Model: arduino_ph_pg
Database: PostgreSQL 9.5
*/


-- Create user data types section -------------------------------------------------

CREATE TYPE "user_type" AS ENUM
 ( 'admin', 'user' )
;

-- Create tables section -------------------------------------------------

-- Table ph_list

CREATE TABLE "ph_list"(
 "id" Serial NOT NULL,
 "value" Numeric(7,4) NOT NULL,
 "creation_date" Timestamp,
 "category_id" Integer
)
WITH (
 autovacuum_enabled=true)
;

-- Create indexes for table ph_list

CREATE INDEX "IX_Relationship1" ON "ph_list" ("category_id")
;

-- Add keys for table ph_list

ALTER TABLE "ph_list" ADD CONSTRAINT "Key1" PRIMARY KEY ("id")
;

-- Table ph_categories

CREATE TABLE "ph_categories"(
 "id" Serial NOT NULL,
 "description" Character varying(50) NOT NULL
)
WITH (
 autovacuum_enabled=true)
;

-- Add keys for table ph_categories

ALTER TABLE "ph_categories" ADD CONSTRAINT "Key2" PRIMARY KEY ("id")
;

-- Table users

CREATE TABLE "users"(
 "id" Serial NOT NULL,
 "fullname" Character varying(55),
 "username" Character varying(35) NOT NULL,
 "password" Character varying(35) NOT NULL,
 "type" "user_type" NOT NULL
)
WITH (
 autovacuum_enabled=true)
;

-- Add keys for table users

ALTER TABLE "users" ADD CONSTRAINT "PK_users" PRIMARY KEY ("id")
;
-- Create foreign keys (relationships) section ------------------------------------------------- 

ALTER TABLE "ph_list" ADD CONSTRAINT "Relationship1" FOREIGN KEY ("category_id") REFERENCES "ph_categories" ("id") ON DELETE RESTRICT ON UPDATE RESTRICT
;




