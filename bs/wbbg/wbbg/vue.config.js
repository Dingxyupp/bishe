//代理域名
module.exports={
    devServer:{
        proxy:{
            '/api':{
                target:"http://www.wbbg.com",
                ws:true,
                changeOrigin: true
            },
            '/uploads':{
                target:"http://www.wbbg.com",
                ws:true,
                changeOrigin: true
            }
        }
    },
    publicPath:"./",
};