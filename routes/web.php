<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerAccountController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CustomerHomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\SellerOrderController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SalesReportController;
// -------------------------------


// SELLER (manager)
Route::get('/seller/login', [SellerAuthController::class, 'showLoginForm'])->name('seller.login');
Route::post('/seller/login', [SellerAuthController::class, 'login'])->name('seller.login.submit');
Route::get('/seller/logout', [SellerAuthController::class, 'logout'])->name('seller.logout');

// MANAGER DASHBOARD
Route::get('/dashboard', [SellerAuthController::class, 'dashboard'])->name('dashboard');

// STAFF DASHBOARD
Route::get('/staff/dashboard', [SellerAuthController::class, 'showDashboard'])->name('staff.dashboard');


// -------------------------------
// ACCOUNT DETAILS (Seller)
// -------------------------------

Route::get('/seller/account/edit', [SellerAuthController::class, 'editAccount'])->name('seller.account.edit');
Route::get('/chatbot/delete/{id}', [ChatbotController::class, 'destroy'])->name('chatbot.delete');
Route::get('/seller/account', [SellerAuthController::class, 'showAccount'])->name('seller.account');
Route::post('/seller/account/update', [SellerAuthController::class, 'updateAccount'])->name('seller.account.update');


// -------------------------------
// PRODUCT MANAGEMENT
// -------------------------------
Route::get('/product/create', [ProductController::class, 'create'])->name('product.Addproduct');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

Route::get('/product/disable/list', [ProductController::class, 'showDisableList'])->name('product.disable.list');
Route::put('/products/{id}/disable', [ProductController::class, 'updateStatus'])->name('product.disable');

Route::get('/staff/update-products', [ProductController::class, 'showUpdateProductList'])->name('staff.product.list');
Route::get('/staff/edit-product/{id}', [ProductController::class, 'editProductForm'])->name('staff.product.edit');
Route::post('/staff/update-product/{id}', [ProductController::class, 'updateProductDetails'])->name('staff.product.update');
Route::get('/staff/dashboard', [SellerAuthController::class, 'showDashboard'])->name('staff.dashboard');



// -------------------------------
// ORDER MANAGEMENT (STAFF)
// -------------------------------
// Staff order management

Route::get('/seller/order/list', [SellerOrderController::class, 'index'])->name('order.list');
Route::post('/seller/order/update-status/{id}', [SellerOrderController::class, 'updateStatus'])->name('seller.updateStatus');
Route::get('/seller/order/cancel', [OrderController::class, 'cancelOrderPage'])->name('order.cancel');
Route::post('/customer/order/cancel/{orderId}', [CustomerOrderController::class, 'cancel'])->name('customer.order.cancel');
Route::post('/return-order/{order}', [CustomerOrderController::class, 'submitReturnRequest'])->name('customer.returnOrderSubmit');
// ✅ View the list of return & refund requests
Route::get('/return-refund', [OrderController::class, 'viewReturnRefundRequests'])->name('order.return');

// ✅ Approve return request (POST only)
Route::post('/approve-return/{id}', [OrderController::class, 'approveReturn'])->name('seller.approveReturn');

// ✅ Reject return request (POST only)
Route::post('/reject-return/{id}', [OrderController::class, 'rejectReturn'])->name('seller.rejectReturn');

// Form to select date and view report
Route::get('/order-report', [SellerOrderController::class, 'orderReportForm'])->name('seller.orderReportForm');

// Display result based on selected date
Route::get('/order-report/view', [SellerOrderController::class, 'viewOrderReport'])->name('seller.viewOrderReport');
Route::get('/order-report', [SellerOrderController::class, 'orderReportForm'])->name('seller.orderReportForm');
Route::get('/order-report/view', [SellerOrderController::class, 'viewOrderReport'])->name('seller.viewOrderReport');


// View feedback
Route::get('/staff/feedback', fn () => view('seller.feedback'))->name('feedback.index');



// -------------------------------
// SALES REPORT (MANAGER)
// -------------------------------
Route::view('/sales-report', 'report.salesreport')->name('report.index');

// -------------------------------
// MANAGE CHATBOT (MANAGER)
// -------------------------------

// View form Add FAQ (gunakan addfaq.blade.php)
Route::get('/chatbot/add', [ChatbotController::class, 'create'])->name('addfaq');

// Handle form submission (POST)
Route::post('/chatbot/add', [ChatbotController::class, 'store'])->name('chatbot.store');

// Lain-lain route untuk chatbot
Route::get('/chatbot/manage', [ChatbotController::class, 'index'])->name('chatbot.manage');
Route::get('/chatbot/delete/{id}', [ChatbotController::class, 'destroy'])->name('chatbot.delete');
Route::get('/chatbot/edit/{id}', [ChatbotController::class, 'edit'])->name('chatbot.edit');
Route::put('/chatbot/update/{id}', [ChatbotController::class, 'update'])->name('chatbot.update');


// ADD route POST untuk simpan FAQ
Route::post('/addfaq', [ChatbotController::class, 'store'])->name('faq.store');

// -------------------------------
// REGISTER STAFF ACCOUNT
// -------------------------------

// Papar form daftar staff
// Show register staff form
Route::get('/seller/registerstaff', [SellerAuthController::class, 'showRegisterForm'])->name('seller.registerstaff');

// Process register staff form
Route::post('/seller/registerstaff', [SellerAuthController::class, 'register'])->name('seller.registerstaff.submit');

// Seller dashboard
Route::get('/seller/dashboard', [SellerAuthController::class, 'dashboard'])->name('seller.dashboard');


// -------------------------------
// FEEDBACK (VIEW)
// -------------------------------
//Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');

// -------------------------------
// CUSTOMER AUTH
// -------------------------------
Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');


Route::get('/customer/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');

// -------------------------------
// CUSTOMER ACCOUNT
// -------------------------------
Route::get('/customer/account', [CustomerAccountController::class, 'show'])->name('customer.account');
Route::post('/customer/account', [CustomerAccountController::class, 'update'])->name('customer.account.update');

// -------------------------------
// CUSTOMER PASSWORD RESET
// -------------------------------
// Papar form reset password (tanpa token)
Route::get('/customer/reset-password', [CustomerAuthController::class, 'showResetForm'])->name('customer.password.reset');
Route::post('/customer/reset-password', [CustomerAuthController::class, 'resetPassword'])->name('customer.password.update');

// -------------------------------
// CUSTOMER OTHER
// -------------------------------
//Route::get('/customer/home', [CustomerAuthController::class, 'home'])->name('customer.home');
Route::get('/cart', fn () => view('customer.cart'))->name('customer.cart');


Route::get('/product/{id}', [CustomerHomeController::class, 'viewProduct'])->name('product.view');
Route::get('/product/{id}', [CustomerHomeController::class, 'showProduct'])->name('product.show');
Route::get('/home', [CustomerHomeController::class, 'home'])->name('customer.home');


// -------------------------------
// LOGIN CHOICE
// -------------------------------
Route::get('/login-choice', fn () => view('login-choice'))->name('login.choice');

Route::get('/customer/cart', [CartController::class, 'viewCart'])->name('customer.cart.view');

Route::post('/customer/cart/add', [CartController::class, 'addToCart'])->name('customer.cart.add');



Route::post('/cart/increase/{id}', [CartController::class, 'increaseQuantity'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');

Route::get('/cart', [CartController::class, 'viewCart'])->name('customer.cart');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');


Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
Route::post('/checkout/place', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('place.order');
Route::get('/my-orders', [CustomerOrderController::class, 'index'])->name('customer.orders');
Route::post('/cancel-order/{id}', [CustomerOrderController::class, 'cancel'])->name('customer.cancelOrder');
Route::get('/return-order/{id}', [CustomerOrderController::class, 'returnForm'])->name('customer.returnOrderForm');
Route::get('/feedback/{id}', [CustomerOrderController::class, 'feedbackForm'])->name('customer.feedbackForm');



//View by category
// Guna nama kategori (untuk customer)

Route::get('/category/{name}', [CustomerHomeController::class, 'show'])->name('category.show');

// Guna ID kategori (jika perlu untuk admin atau internal)
Route::get('/category/id/{id}', [CustomerHomeController::class, 'viewByCategory'])->name('category.view');

Route::get('/search', [ProductController::class, 'search'])->name('product.search');

Route::get('/chatbot', [ChatbotController::class, 'show'])->name('chatbot.show');
Route::post('/chatbot/get-answer', [ChatbotController::class, 'getAnswer'])->name('chatbot.answer');
Route::get('/customer/chatbot/questions', [ChatbotController::class, 'getQuestions']);

Route::get('/feedback', [FeedbackController::class, 'index'])->name('seller.feedback');
Route::get('/sales-report', [SalesReportController::class, 'index'])->name('sales.report');
Route::post('/sales-report/filter', [SalesReportController::class, 'filter'])->name('sales.report.filter');
Route::get('/sales-report', [SalesReportController::class, 'index'])->name('report.index');
// Customer bagi feedback untuk product
Route::get('/customer/feedback/{order}/{product}', [CustomerOrderController::class, 'giveFeedback'])->name('customer.giveFeedback');
Route::post('/customer/feedback/{order}/{product}', [CustomerOrderController::class, 'submitFeedback'])->name('customer.submitFeedback');

// Seller view semua feedback
Route::get('/feedback', [FeedbackController::class, 'index'])
    ->name('seller.feedback');




























