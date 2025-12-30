# FinanControl PHP - Walkthrough

## Overview
This document outlines the implementation of the FinanControl application, a financial management tool built with PHP, Laravel, Livewire, Alpine.js, and Tailwind CSS.


## Architecture
The application follows a Service-Oriented Architecture within Laravel:

. Models: Eloquent models representing the database entities (User, Goal, ExpenseCategory, Expense, Income).
. Services: Business logic is encapsulated in service classes (ExpenseServic, IncomeService, GoalService, AuthService) to keep controllers/components light.
. Livewire Components: Frontend interaction is handled by Livewire components (ExpenseManager, IncomeManager,GoalManager, Dashboard), utilizing Alpine.js for minor interactions and Tailwind CSS for styling.


## Database Schema
The following tables have been created:
. users: Stores user authentication data.
. goals: Stores financial goals.
. expense_categories: Stores categories for categorization.
. expenses: Stores expense records linked to categories and optional goals.
. incomes: Stores income records.


## Features Implemented
1. Authentication
User Registration and Login using 
AuthService
.
Password hashing using Argon2 (Laravel default).
2. Financial Management
Expenses: Create, Read, Update, Delete (CRUD) expenses.
Incomes: CRUD operations for incomes.
Goals: CRUD operations for financial goals. long-term goals supported (null end date).
Categories: Expenses are categorized using 
ExpenseCategory
.
3. Dashboard
View total Incomes, Expenses, and Balance.
View count of Active Goals.
Recent activity listings.
How to Run
Since the environment lacks PHP/Composer, follow these steps on a capable machine:


## Install Dependencies:
~ composer install
~ npm install


## Environment Setup:
- Copy .env.example to .env.
- Configure database settings in .env.
- Generate key: php artisan key:generate.


## Database Migration:
~php artisan migrate


## Run Application:
~ php artisan serve
~ npm run dev


## Verification

### Running Tests
Unit tests have been created for the Service layer.Run them using:

~ php artisan test

### Manual Testing
1. Register: Go to /register and create an account.
2. Login: accessing guarded routes redirects to /login.
3. Dashboard: After login, you are redirected to /dashboard.
4. Manage: Use the navigation links to manage Expenses, Incomes, and Goals.