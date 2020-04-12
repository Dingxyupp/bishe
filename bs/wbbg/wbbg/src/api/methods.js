//封装请求的方法
import {instance} from "./init";
export default {
    get(url,data={}){//data设置为一个空对象
        return instance({//配置axios api  调用四种方法时会执行函数里的内容
            method:"get",
            url,
            params:data
        })
    },
    post(url,data={}){
        return instance({
            method:"post",
            url,
            data
        })
    },
    put(url,data={}){
        return instance({
            method:"put",
            url,
            data
        })
    },
    delete(url,data={}){
        return instance({
            method:"delete",
            url,
            params:data
        })
    }
}