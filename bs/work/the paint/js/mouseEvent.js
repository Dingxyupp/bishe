window.onload=function() {

    var mall_search = document.querySelector(".mall_search");
    // layui.use(['form', 'element', 'laypage', 'layer'], function () {
    //     var element = layui.element,
    //         laypage = layui.laypage,
    //         layer = layui.layer,
    //         form = layui.form;
    //     //自定义样式
    //     laypage.render({
    //         elem: 'demo'
    //         , count: 100
    //         , theme: '#1E9FFF',
    //         prev: null,
    //         next: null
    //     })
    //     //监听select
    //     form.on('select(filter)', function(data){
    //         console.log(data.elem); //得到select原始DOM对象
    //         console.log(data.value); //得到被选中的值
    //         console.log(data.othis); //得到美化后的DOM对象
    //     });
    //     // 弹出层
    //     // mall_search.onclick = function () {
    //     //     layer.open({
    //     //         title: '在线调试'
    //     //         , content: '可以填写任意的layer代码'
    //     //     });
    //     // };
    //     // 监听提交
    //     form.on('submit(formDemo)', function (data) {
    //         layer.msg(JSON.stringify(data.field));
    //         return false;
    //     });
    //     form.render();
    // });
    // <!--  初始化swiper-->
    var mySwiper = new Swiper('.swiper-container', {
        direction: 'horizontal', // 垂直切换选项
        loop: true, // 循环模式选项
        autoplay: true,

        // 如果需要分页器
        pagination: {
            el: '.swiper-pagination',
        },

        // 如果需要前进后退按钮
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // 如果需要滚动条
        scrollbar: {
            el: '.swiper-scrollbar',
        },
    });
    var wxpicture = document.querySelector(".wxpicture");
    var codeleft = document.querySelector(".codeleft");
    var hide_list1 = document.querySelector(".hide_list1");
    var hide_list2 = document.querySelector(".hide_list2");
    var hide_list3 = document.querySelector(".hide_list3");
    var hide_list4 = document.querySelector(".hide_list4");
    var list1 = document.querySelector(".list1");
    var list2 = document.querySelector(".list2");
    var list3 = document.querySelector(".list3");
    var list4 = document.querySelector(".list4");
    var list_p = document.querySelector(".list_p");
    wxpicture.onmouseover = function () {
        codeleft.style.display = 'block'
    }
    wxpicture.onmouseout = function () {
        codeleft.style.display = 'none'
    }
    hide_list1.onmouseover = function () {
        list1.style.visibility = "visible"
    }
    hide_list1.onmouseleave = function () {
        list1.style.visibility = "hidden"
    }
    hide_list2.onmouseover = function () {
        list2.style.visibility = "visible"
    }
    hide_list2.onmouseout = function () {
        list2.style.visibility = "hidden"
    }
    hide_list3.onmouseover = function () {
        list3.style.visibility = "visible"
    }
    hide_list3.onmouseout = function () {
        list3.style.visibility = "hidden"
    }
    hide_list4.onmouseover = function () {
        list4.style.visibility = "visible"
    }
    hide_list4.onmouseout = function () {
        list4.style.visibility = "hidden"
    }
}