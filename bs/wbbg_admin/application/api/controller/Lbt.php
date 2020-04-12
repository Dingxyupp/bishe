<?php


namespace app\api\controller;
use app\model\LbtModel;

class Lbt
{
    function select()
    {
        $r = LbtModel::select();
        if (isset($r)) {
            return json(["code" => 200, "data" => $r]);
        } else {
            return json(["code" => 400]);
        }
    }

    function edit()
    {
        $id = input("get.id");
        $r = LbtModel::where("id", $id)->find();
        if (isset($r)) {
            return json(["code" => 200, "data" => $r]);
        } else {
            return json(["code" => 400]);
        }
    }

    function alter()
    {
        $id = input("post.id");
        $interview = input("post.interview");
        $detail = input("post.detail");
        $r = LbtModel::where("id", $id)->update(["interview" => $interview, "detail" => $detail]);
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
            $r = LbtModel::where("id", $id)->delete();
            if ($r) {
                return json(["msg" => "删除成功", "code" => 200]);
            } else {
                return json(["msg" => "删除失败", "code" => 400]);
            }
        } else {
            return json(["msg" => "删除失败", "code" => 400]);
        }

    }

    function add()
    {
        $data = input("post.");
        $lbt = new LbtModel();
        $lbt->id = $data["id"];
        $lbt->interview = $data["interview"];
        $lbt->detail = $data["detail"];
        $d = $lbt->save();
        if ($d) {
            return json(["msg" => "新增成功", "code" => 200]);
        } else {
            return json(["msg" => "新增失败", "code" => 400]);
        }

        $res=LbtModel::where("id",data["id"])->find();
        if($res){
            return json(["msg" => "已经存在该编号了!", "code" => 400]);
        }
    }
}