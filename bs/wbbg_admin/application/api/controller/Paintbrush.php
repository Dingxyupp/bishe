<?php


namespace app\api\controller;


use app\model\PaintBrushModel;

class Paintbrush
{
    function select()
    {
        $state=input("get.state");
        $page=input("get.page");
        $size=input("get.size");
        $content=input("get.content");
        $index=input("get.index");
        $start=($page-1)*$size;
        $end=$page*$size;
        if($content){
            $where['id|name|count'] = array('like','%'.$content.'%');
            $v=PaintBrushModel::where($where)->where("state",$state)->limit($start,$end)->select();
            $R=PaintBrushModel::where($where)->where("state",$state)->select();
            if(isset($v)){
                return json(["msg" => "查找成功", "code" => 200,"data"=>$v,"total"=>$R]);
            }else{
                return json(["code"=>400,"msg"=>"找不到您要查询的内容!"]);
            }
        }else if($index){
            if($index==1){
                $R=PaintBrushModel::where("state",$state)->select();
                $r=PaintBrushModel::where("state",$state)->order(['count'=>"desc"])->limit($start,$end)->select();
                if(isset($r)){
                    return json(["code"=>200,"total"=>$R,"data"=>$r]);
                }else{
                    return json(["code" => 400,"msg"=>"排列失败"]);
                }
            }
            if($index==2){
                $R=PaintBrushModel::where("state",$state)->select();
                $r=PaintBrushModel::where("state",$state)->order(['count'=>"asc"])->limit($start,$end)->select();
                if(isset($r)){
                    return json(["code"=>200,"total"=>$R,"data"=>$r]);
                }else{
                    return json(["code" => 400,"msg"=>"排列失败"]);
                }
            }
        } else{

            $R=PaintBrushModel::where("state",$state)->select();
            $r=PaintBrushModel::where("state",$state)->limit($start,$end)->select();
            if (isset($r)) {
                return json(["code" => 200,"total"=>$R, "data" => $r]);
            } else {
                return json(["code" => 400]);
            }
        }
    }
    function modify()
    {
        $id=input("get.id");
        $r=PaintBrushModel::where("id",$id)->find();
        if (isset($r)) {
            return json(["code" => 200, "data" => $r]);
        } else {
            return json(["code" => 400]);
        }
    }
    function alter()
    {
        $id = input("post.id");
        $name=input("post.name");
        $picture= input("post.picture");
        $productintd= input("post.productintd");
        $specifications=input("post.specifications");
        $cleaning=input("post.cleaning");
        $temperature=input("post.temperature");
        $method=input("post.method");
        $count = input("post.count");

        $r =PaintBrushModel::where("id", $id)->update(["name" => $name, "picture" => $picture,"productintd"=>$productintd,"specifications"=>$specifications,"cleaning"=>$cleaning,"temperature"=>$temperature,"method"=>$method,"count"=>$count]);
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
            $r = PaintBrushModel::where("id", $id)->delete();
            if ($r) {
                $R=PaintBrushModel::where("state",$data["state"])->select();
                return json(["msg" => "删除成功", "code" => 200,"total"=>$R]);
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
        $id=$data["id"];
        $r=PaintBrushModel::where("id",$id)->find();
        if(isset($r)){
            return json(["msg"=>"该编号已经被占用,请重新填写!","code"=>401]);
        }
        $paint = new PaintBrushModel();
        $paint->id = $data["id"];
        $paint->name = $data["name"];
        $paint->productintd = $data["productintd"];
        $paint->picture = $data["picture"];
        $paint->specifications = $data["specifications"];
        $paint->cleaning = $data["cleaning"];
        $paint->temperature = $data["temperature"];
        $paint->method = $data["method"];
        $paint->count = $data["count"];
        $paint->state=$data["state"];
        $d = $paint->save();
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