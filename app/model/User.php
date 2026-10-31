<?php
namespace app\model;

use think\Model;

class User extends Model
{
    // TP8 默认按类名转小写映射表名：User -> user
    // 你建的表叫 users，必须显式指定
    protected $name = 'users';
}