<?php

use App\Api\AuthController;
use App\Api\CaptchaController;
use App\Api\HomeController;
use App\Api\MenuController;
use App\Api\PermissionController;
use App\Api\RoleController;
use App\Api\UploadController;
use App\Api\UserController;
use App\Api\GameController;
use App\Api\LocalgameController;
use Illuminate\Support\Facades\Route;

Route::post('admin/user/login', [AuthController::class, 'login']);
Route::post('admin/user/logout', [AuthController::class, 'logout']);

Route::post('admin/user/info', [UserController::class, 'info']);

//图形验证码
Route::get('captcha', [CaptchaController::class, 'make']);
//-----------------------后台路由-----------------------
Route::group(['middleware' => ['auth:sanctum']], function () {
    //全局菜单

    Route::post("admin/menus", [MenuController::class, 'generateMenus']);

    Route::post('menu/list', [MenuController::class, 'menuList']);

    Route::post('user/getMenus', [MenuController::class, 'getMenus']);
    //    角色
    Route::post('admin/role/init', [RoleController::class, 'init']);
    Route::apiResource('admin/role', RoleController::class);
    Route::post('admin/user/{user}/role', [RoleController::class, 'getRole']);
    Route::post('admin/user/{user}/setRole', [RoleController::class, 'setRole']);
    //    权限（菜单）
    Route::post("admin/permission/init", [PermissionController::class, 'initPermissions']);
    Route::post('admin/role/{role}/syncpermissions', [PermissionController::class, 'syncPermissions']);
    Route::post("admin/role/{role}/permissions", [PermissionController::class, "getPermissions"]);
    Route::post('admin/defaultPermission', [PermissionController::class, 'getDefaultPermission']);
    Route::post('admin/user/permissions', [PermissionController::class, 'getUserPermissions']);
    //    用户
    Route::get('user', [UserController::class, 'index']);
    Route::get('admin/user/{user}', [UserController::class, 'show']);
    Route::post('user', [UserController::class, 'store']);
    Route::get('user/{user}', [UserController::class, 'edit']);
    Route::put('user/{user}', [UserController::class, 'update']);
    Route::delete('user/{user}', [UserController::class, 'destroy']);
    Route::post('user/search', [UserController::class, 'searchUser']);


    Route::post('upload/image', [UploadController::class, 'uploadImage']);

    //获取UUID值
    Route::post("admin/home", [HomeController::class, 'index']);
    Route::post("admin/home/bootstrap", [HomeController::class, 'bootstrap'])->middleware(['system']);

    Route::post("admin/game/test",[GameController::class,'test']);
    Route::post('admin/localgame/init',[LocalgameController::class,'initlocalgame']);

});

//-----------------------后台路由END-----------------------

//-----------------------前台路由-----------------------
Route::group(['prefix' => 'front/'], function () {
    //登录
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('user/info', [UserController::class, 'info']);

    //验证码
    Route::get('captcha', [CaptchaController::class, 'make']);
});
//-----------------------前台路由END-----------------------
