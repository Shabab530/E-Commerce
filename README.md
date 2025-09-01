# 🛒 E-Commerce Website

A simple **E-Commerce Website** built with **PHP, MySQL, HTML, CSS, and JavaScript**.
This project includes user authentication, product management, cart, wishlist, order system, and admin dashboard.

---

## 📂 Project Structure

**User Panel:**
* `user_login.php` - User login
* `user_register.php` - User register
* `update_user.php` - User Profile Update
* `about.php` – About page
* `cart.php` – Shopping cart page
* `category.php` – Category-based product listing
* `checkout.php` – Checkout process
* `contact.php` – Contact page
* `ecommerce_db.sql` – Database schema
* `home.php` – Homepage
* `orders.php` – User order history
* `quick_view.php` – Product quick view
* `search_page.php` – Search products
* `shop.php` – Shop page (all products)
* `wishlist.php` – Wishlist management

---

* **Before accessing Admin Auth, You Have to put `admin/admin_login.php` in the URL Section**
* `admin_login.php` → Admin login page
* `admin_dashboard.php` → Dashboard (overview of orders, products, etc.)
* `admin_products.php` → Add, Update, Delete products
* `admin_orders.php` → Manage customer orders
* `admin_users.php` → Manage registered users
* `admin_contacts.php` → View customer messages from the contact form
* `admin_style.css` → Stylesheet for the admin panel

---

* **Components:**
* `header.php` - Header layout components
* `footer.php` - Footer layout components
* `connect.php` - Database

---

* **CSS**
* `admin_style.css` - Stylesheet for the admin panel
* `style.css` - Stylesheet for the user panel

---

## ⚙️ Installation

### 1️⃣ Requirements

* XAMPP / WAMP / MAMP (PHP 7+ and MySQL)
* Web Browser (Chrome, Edge, Firefox, etc.)

### 2️⃣ Setup Instructions

1. Download or clone this repository.
2. Copy the project folder into your server directory:

   * For XAMPP → `htdocs/`
   * For WAMP → `www/`
3. Import the database:

   * Open `phpMyAdmin` → Create a database (e.g., `ecommerce_db`)
   * Import `ecommerce_db.sql`
4. Update database connection in:

   * `components/connect.php`

```php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ecommerce_db";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
```

5. Start Apache & MySQL server.
6. Visit the project in browser:

   ```
   http://localhost/E-Commerce Website/
   ```

---

## 👥 User Panel Features

* User Registration & Login
* Browse Products (Shop, Categories, Search)
* Add to Cart / Wishlist
* Update Cart Quantity
* Checkout Orders
* Track Orders

---

## 🔑 Admin Panel Features

* Secure Admin Login
* Manage Products (Add, Update, Delete)
* View & Manage Orders
* Manage User Accounts
* View Messages from Contact Form

---

## 🎨 Technologies Used

* **Frontend:** HTML, CSS, JavaScript
* **Backend:** PHP
* **Database:** MySQL
* **Icons:** FontAwesome

---

## 🚀 Future Improvements

* Payment Gateway Integration
* Responsive Design with Bootstrap / Tailwind
* Laravel Conversion for better scalability
* API for mobile apps

---
