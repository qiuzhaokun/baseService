### 公共基础服务API
基础服务


#### 接口鉴权
- 申请 appId、secret【后续增加请求服务器IP白名单】
- 使用场景：所有服务均为服务端请求，禁止客户端请求
- 鉴权方式：
    - 请求 header 中添加 Authentication、Timestamp 参数
- Authentication 
   - 通用```JWT``` 三部分组成
   - 三部分中间都``.``隔开
   
- JWT 三部分:头部、载荷、签证
   - 头部，使用 base64 加密，内容如下
       ```
       {
         'typ': 'JWT',
         'alg': 'HS256'
       }
       ```
   - 载荷，使用 base64,内容如下
        ```
        {
          "sub": "",  //jwt所面向的用户,应用的用户ID
          "appName": "jianji", //应用名称
          "clientid": "", //应用客户端ID
        }
        ```
   - 签证,```HMACSHA256``` 加盐为：secret 加密


#### 后端服务
- 启动 server 其中启动tick、webSocket 等服务


#### 微信 access_token 中控服务
- api 地址：http://127.0.0.1:8072/accessToken

