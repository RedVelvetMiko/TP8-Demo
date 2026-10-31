<?php
namespace app\middleware;

use think\Request;

class AdminOnly
{
    public function handle(Request $request, \Closure $next)
    {
        // TokenAuth 绑定的是 userInfo 对象，取 role 字段
        if (!$request->userInfo || $request->userInfo->role !== 'admin') {
            return json(['code' => 403, 'msg' => '无权限访问'], 403);
        }
        return $next($request);
    }
}