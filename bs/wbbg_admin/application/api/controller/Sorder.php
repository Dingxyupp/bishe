<?php


namespace app\api\controller;



use app\model\ServeOrderModel;

class Sorder
{
    function select()
    {
        $state=input("get.state");
        $page=input("get.page");
        $size=input("get.size");
        $start=($page-1)*$size;
        $end=$page*$size;
        $R=ServeOrderModel::where("state",$state)->select();
        $r=ServeOrderModel::where("state",$state)->limit($start,$end)->select();
        if (isset($r)) {
            return json(["code" => 200,"total"=>$R, "data" => $r]);
        } else {
            return json(["code" => 400]);
        }
    }
    function modify()
    {
        $id=input("get.id");
        $r=ServeOrderModel::where("id",$id)->find();
        if (isset($r)) {
            return json(["code" => 200, "data" => $r]);
        } else {
            return json(["code" => 400]);
        }
    }
    function alter()
{
    $id = input("post.id");
    $username=input("post.username");
    $sex= input("post.sex");
    $phonenumber= input("post.phonenumber");
    $city=input("post.city");
    $address = input("post.address");
    $serve = input("post.serve");
    $date1 = input("post.date1");
    $date2=input("post.date2");
    $content = input("post.content");
    $r = ServeOrderModel::where("id", $id)->update(["username" => $username, "sex" => $sex,"phonenumber"=>$phonenumber,"city"=>$city,"address"=>$address,"serve"=>$serve,"date"=>$date1.$date2,"content"=>$content]);
    if ($r) {
        return json(["code" => 200, "msg" => "更新成功!"]);
    } else {
        return json(["code" => 400]);
    }
}
    function delete()
    {
        $data = input("get.");
        if (isset($data["id"])) {
            $id = $data["id"];
            $r = ServeOrderModel::where("id", $id)->delete();
            if ($r) {
                return json(["msg" => "删除成功", "code" => 200]);
            } else {
                return json(["msg" => "删除失败", "code" => 400]);
            }
        } else {
            return json(["msg" => "删除失败", "code" => 400]);
        }

    }
    function confirm1(){
    $id=input("post.id");
    $r=ServeOrderModel::where("id",$id)->find();
    if(isset($r)){
        $r["state"]=2;
        $r->save();
        return json(["code"=>200,"msg"=>"状态修改成功"]);
    }else{
        return json(["code"=>400,"msg"=>"出现错误!"]);
    }
}
    function confirm2(){
        $id=input("post.id");
        $r=ServeOrderModel::where("id",$id)->find();
        if(isset($r)){
            $r["state"]=3;
            $r->save();
            return json(["code"=>200,"msg"=>"状态修改成功"]);
        }else{
            return json(["code"=>400,"msg"=>"出现错误!"]);
        }
    }
}