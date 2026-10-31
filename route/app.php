<?php
use think\facade\Route;

Route::get('post/test', 'Post/test')
    ->middleware([
        \app\middleware\TokenAuth::class,   // 第一层：认证
        \app\middleware\AdminOnly::class,   // 第二层：授权（依赖第一层绑定的 userInfo）
    ]);