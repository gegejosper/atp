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
    Route::post('/branches/pumps/add', 'PumpController@addPump')->name('addPump');
    Route::post('/branches/pumps/edit', 'PumpController@editPump')->name('editPump');
    Route::post('/branches/pumps/delete', 'PumpController@deletePump')->name('deletePump');

    Route::get('/branches/users/{branchid}', 'BranchController@branchuser')->name('branchuser');
    Route::post('/branches/users/add', 'UserController@addUser')->name('addUser');
    Route::post('/branches/users/edit', 'UserController@editUser')->name('editUser');
    Route::post('/branches/users/delete', 'UserController@deleteUser')->name('deleteUser');

    Route::get('/branches/accounts/{branchid}', 'BranchController@branchaccounts')->name('accounts');
    Route::post('/branches/accounts/add', 'AccountsController@addAccount')->name('addAccount');
    Route::post('/branches/accounts/edit', 'AccountsController@editAccount')->name('editAccount');
    Route::post('/branches/accounts/delete', 'AccountsController@deleteAccount')->name('deleteAccount');
    Route::get('/branches/account/{accountid}', 'AccountsController@viewAccount')->name('viewAccount');

    Route::get('/branches/products/{branchid}', 'BranchController@branchproduct')->name('branchproduct');
    Route::post('/branches/products/add', 'ProductController@addBranchProduct')->name('addBranchProduct');
    Route::post('/branches/products/edit', 'ProductController@editBranchProduct')->name('editBranchProduct');
    Route::post('/branches/products/delete', 'ProductController@deleteBranchProduct')->name('addBranchProduct');

    Route::get('/branches/gas/{branchid}', 'BranchController@branchgas')->name('branchgas');
    Route::post('/branches/gas/add', 'GastypeController@addBranchGas')->name('addBranchGas');
    Route::post('/branches/gas/delete', 'GastypeController@deleteBranchGas')->name('deleteBranchGas');
    
    Route::get('/branches/dipping/{branchid}', 'DippingController@branchdipping')->name('branchdipping');
    Route::post('/branches/dipping/add', 'DippingController@addBranchDipping')->name('addBranchDipping');
    

    Route::get('/users', 'AdminController@users')->name('users');
    Route::get('/settings', 'AdminController@settings')->name('settings');
    

});
