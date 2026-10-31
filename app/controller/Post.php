<?php
namespace app\controller;

use think\Request;

class Post
{
    public function test(Request $request)
    {
        return json([
            'msg'    => '中间件通过',
            'userId' => $request->userInfo->id,
            'role'   => $request->userInfo->role,
        ]);
    }
}