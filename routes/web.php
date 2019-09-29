<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/userlogin', 'LoginController@userLogin')->name('userLogin');

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' =>'adminAuth','prefix' => 'admin'], function(){
    Route::get('/home', 'AdminController@index')->name('home');
    Route::get('/sales', 'AdminController@sales')->name('sales');
    Route::get('/petrol', 'AdminController@petrol')->name('petrol');

    Route::get('/order', 'AdminController@order')->name('order');
    Route::post('/order/createpurchase', 'PurchaseController@createpurchase')->name('createpurchase');
    Route::get('/order/createpurchase/{prnumber}/{branchid}', 'PurchaseController@createpurchaserequest')->name('createpurchaserequest');
    Route::post('/order/addquantityrequest/', 'PurchaseController@addquantityrequest')->name('addquantityrequest');
    //Route::get('/createpurchase', 'PurchaseController@createpurchase')->name('createpurchaserequest');
    

    Route::get('/products', 'AdminController@products')->name('products');
    Route::post('/products/add', 'ProductController@addProduct')->name('addProduct');
    Route::post('/products/edit', 'ProductController@editProduct')->name('editProduct');
    Route::post('/products/delete', 'ProductController@deleteProduct')->name('deleteProduct');
    
    Route::get('/reports', 'AdminController@reports')->name('reports');
    
    Route::get('/gastypes', 'AdminController@gastypes')->name('gastypes');
    Route::post('/gastypes/add', 'GastypeController@addGastype')->name('addGastype');
    Route::post('/gastypes/edit', 'GastypeController@editGastype')->name('editGastype');
    Route::post('/gastypes/delete', 'GastypeController@deleteGastype')->name('deleteGastype');
    
    Route::get('/pumps', 'AdminController@pumps')->name('pumps');
    
    Route::get('/branches', 'AdminController@branches')->name('branches');
    Route::post('/branches/add', 'BranchController@addBranch')->name('addBranch');
    Route::post('/branches/edit', 'BranchController@editBranch')->name('editBranch');
    Route::post('/branches/delete', 'BranchController@deleteBranch')->name('deleteBranch');
    Route::get('/branches/{branchid}', 'BranchController@viewbranch')->name('viewbranch');
    
    Route::get('/branches/pumps/{branchid}', 'BranchController@branchpump')->name('branchpump');
    Route::get('/branches/pumps/logs/{branchid}/{batchcode}', 'BranchController@viewpumpreading')->name('viewpumpreading');
    Route::post('/branches/pumps/add', 'PumpController@addPump')->name('addPump');
    Route::post('/branches/pumps/edit', 'PumpController@editPump')->name('editPump');
    Route::post('/branches/pumps/delete', 'PumpController@deletePump')->name('deletePump');
    Route::post('/branches/pumps/savelog', 'PumpController@savepumplog')->name('savepumplog');

    

    Route::get('/branches/users/{branchid}', 'BranchController@branchuser')->name('branchuser');
    Route::post('/branches/users/add', 'UserController@addUser')->name('addUser');
    Route::post('/branches/users/edit', 'UserController@editUser')->name('editUser');
    Route::post('/branches/users/delete', 'UserController@deleteUser')->name('deleteUser');

    Route::get('/branches/accounts/{branchid}', 'BranchController@branchaccounts')->name('accounts');
    Route::post('/branches/accounts/add', 'AccountsController@addAccount')->name('addAccount');
    Route::post('/branches/accounts/edit', 'AccountsController@editAccount')->name('editAccount');
    Route::post('/branches/accounts/delete', 'AccountsController@deleteAccount')->name('deleteAccount');
    Route::get('/branches/account/{branchid}/{accountid}', 'AccountsController@viewAccount')->name('viewAccount');

    Route::get('/branches/products/{branchid}', 'BranchController@branchproduct')->name('branchproduct');
    Route::post('/branches/products/add', 'ProductController@addBranchProduct')->name('addBranchProduct');
    Route::post('/branches/products/edit', 'ProductController@editBranchProduct')->name('editBranchProduct');
    Route::post('/branches/products/delete', 'ProductController@deleteBranchProduct')->name('addBranchProduct');

    Route::get('/branches/gas/{branchid}', 'BranchController@branchgas')->name('branchgas');
    Route::post('/branches/gas/add', 'GastypeController@addBranchGas')->name('addBranchGas');
    Route::post('/branches/gas/delete', 'GastypeController@deleteBranchGas')->name('deleteBranchGas');
    Route::post('/branches/gas/update', 'GastypeController@updateBranchGas')->name('updateBranchGas');
    
    Route::get('/branches/dipping/{branchid}', 'DippingController@branchdipping')->name('branchdipping');
    Route::post('/branches/dipping/add', 'DippingController@addBranchDipping')->name('addBranchDipping');
    Route::post('/branches/dipping/delete', 'DippingController@deleteBranchDipping')->name('deleteBranchDipping');
    Route::get('/branches/dipping/save/{branchid}', 'DippingController@saveBranchDipping')->name('saveBranchDipping');

    Route::get('/users', 'AdminController@users')->name('users');
    Route::get('/settings', 'AdminController@settings')->name('settings');

});

Route::group(['middleware' =>'inchargeAuth','prefix' => 'incharge'], function(){
    Route::get('/dashboard', 'InchargeController@index')->name('inchargedashboard');
    Route::get('/pumps', 'InchargeController@pumps')->name('inchargepumps');
    Route::get('/accounts', 'InchargeController@accounts')->name('inchargeaccounts');
    Route::get('/dipping', 'InchargeController@dipping')->name('inchargedipping');
    Route::get('/report', 'InchargeController@report')->name('inchargereport');

    Route::get('/checksubmit', 'InchargeController@checksubmit')->name('checksubmit');
    
    Route::post('/dashboard-creditadd', 'InchargeDashboardController@creditadd')->name('creditadd');
    Route::post('/dashboard-creditdelete', 'InchargeDashboardController@creditdelete')->name('creditdelete');
    
    Route::post('/dashboard-salesadd', 'InchargeDashboardController@salesadd')->name('salesadd');
    Route::post('/dashboard-salesdelete', 'InchargeDashboardController@salesdelete')->name('salesdelete');

    Route::post('/dashboard-discountadd', 'InchargeDashboardController@discountadd')->name('discountadd');
    Route::post('/dashboard-discountdelete', 'InchargeDashboardController@discountdelete')->name('discountdelete');

    Route::post('/dashboard-othersadd', 'InchargeDashboardController@othersadd')->name('othersadd');
    Route::post('/dashboard-othersdelete', 'InchargeDashboardController@othersdelete')->name('othersdelete');

    Route::post('/dashboard/submit-report/', 'InchargeController@submitreport')->name('submitreport');
    Route::get('/dashboard/submit-report/check', 'InchargeController@checkreport')->name('checkreport');

    Route::get('/daily-report/{logsession}', 'InchargeController@dailyreport')->name('dailyreport');

    Route::get('/backdashboard', 'InchargeController@backdashboard')->name('backdashboard');
    Route::get('/report-save/{logsession}', 'InchargeController@reportsave')->name('reportsave');
});
Route::group(['middleware' =>'billingAuth','prefix' => 'billing'], function(){
    Route::get('/dashboard', 'BillingController@index')->name('inchargedashboard');
    Route::get('/bills', 'BillingController@billing')->name('billing');
    Route::get('/accounts', 'BillingController@accounts')->name('accounts-billing');
    Route::get('/account/{accountid}', 'BillingController@account')->name('account-billing');
    Route::get('/history', 'BillingController@history')->name('history-billing');
    
});
