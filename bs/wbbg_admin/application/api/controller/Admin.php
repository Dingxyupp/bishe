<?php


namespace app\api\controller;


use app\model\AdminModel;
use app\model\RoleModel;
use think\captcha\Captcha;

class Admin
{
    function createHash(){
        return md5(time());
    }

    function createPassword($pass,$hash){
        return md5(sha1($pass).$hash);
    }

    function captcha(){
        $config =    [
            // 验证码字体大小
            'fontSize'    =>    30,
            // 验证码位数
            'length'      =>    4,
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();
    }
    function login(){
        $username=input("post.username");
        $password=input("post.password");
        $cap=input("post.captcha");
        $captcha=new Captcha();
        if(!$captcha->check($cap)){
            return json(["msg"=>"验证码错误","code"=>400]);
        }
        $message=AdminModel::where("username",$username)->find();
        if(isset($message)){
            $id=$message->id;
//            $route=RoleModel::where("role",$message->role)->find()->route;
            $pass=$this->createPassword($password,$message->hash);
            if($message->password==$pass){
                return json(["msg"=>"登陆成功","code"=>200,"id"=>$id]);
            }else{
                return json(["msg"=>"密码错误","code"=>400]);
            }
        }else{
            return json(["msg"=>"用户名不存在","code"=>400]);
        }
    }

    function password(){
        $data=input("put.");//$data传来的是数组
        $username=$data["username"];
        $r=AdminModel::where("username",$username)->find();
        if(isset($r)){
            if($r->password===$this->createPassword($data["password"],$r->hash)){
                $res=$r->save(["password"=>$this->createPassword($data["newpassword"],$r->hash)]);
                if($res){
                    return json(["msg"=>"修改成功","code"=>200]);
                }
            }else{
                return json(["msg"=>"与原始密码不一致","code"=>1001]);
            }
        }else{
            return json(["msg"=>"用户名错误!","code"=>400]);
        }
    }
}