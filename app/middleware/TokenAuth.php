<?php
namespace app\middleware;

use think\Request;
use app\model\User;

class TokenAuth
{
    public function handle(Request $request, \Closure $next)
    {
        $auth = $request->header('authorization', '');
        if (!$auth || !str_starts_with($auth, 'Bearer ')) {
            return json(['code' => 401, 'msg' => '未登录'], 401);
        }

        $token = substr($auth, 7);
        // 链式查询：等价于 SELECT * FROM users WHERE token = ? LIMIT 1
        $user = User::where('token', $token)->find();

        if (!$user) {
            return json(['code' => 401, 'msg' => 'Token 无效'], 401);
        }

        $request->userInfo = $user;
        return $next($request);
    }
}