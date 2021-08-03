<?php
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employee', 'Api\EmployeeController');
Route::apiResource('/supplier', 'Api\SupplierController');
Route::apiResource('/category', 'Api\CategoryController');
Route::apiResource('/product', 'Api\ProductController');
Route::apiResource('/expense', 'Api\ExpenseController');
Route::apiResource('/customer', 'Api\CustomerController');

Route::post('/salary/paid/{id}', 'Api\SalaryController@Paid');
Route::get('/salary', 'Api\SalaryController@AllSalary');
Route::get('/salary/view/{mon}', 'Api\SalaryController@ViewSalary');
Route::get('/edit/salary/{id}', 'Api\SalaryController@EditSalary');
Route::post('/salary/update/{id}', 'Api\SalaryController@SalaryUpdate');
Route::post('/stock/update/{id}', 'Api\ProductController@StockUpdate');
Route::get('/getting/product/{id}', 'Api\PosController@GetProduct');

// Add to Cart
Route::get('/addToCart/{id}', 'Api\CartController@AddToCart');
Route::get('/cart/product', 'Api\CartController@CartProduct');
Route::get('/remove/cart/{id}', 'Api\CartController@removeCart');

Route::get('/increment/{id}', 'Api\CartController@increment');
Route::get('/decrement/{id}', 'Api\CartController@decrement');

// Vat Route
Route::get('/vats', 'Api\CartController@Vats');
Route::post('/orderdone', 'Api\PosController@OrderDone');

// Order Route

Route::get('/orders', 'Api\OrderController@TodayOrder');
Route::get('/order/details/{id}', 'Api\OrderController@OrderDetails');
Route::get('/order/orderdetails/{id}', 'Api\OrderController@OrderDetailsAll');

Route::post('/search/order', 'Api\PosController@SearchOrderDate');

?>