## redis 进入数据库

```
redis-cli -h 127.0.0.1 -p 6379
```



## redis 5种数据类型

### string(字符串)

说明

```
k-v缓存,存储字符串
```

使用场景

- 缓存功能,存储字符串,可以做很多业务逻辑
- 计数器
- 共享用户session

常用命令

- `setex key time value`  包含过期时间的存储
- `keys * ` 获取所有的key
- `keys string*` 获取string开头的key
- `exists key` 判断key是否存在

### list(有序列表)

说明

```

```

使用场景

- 消息队列
- 列表数据,分页展示应用

常用命令

- `rpush mylist x y z` 右插入
- `lrange mylist 0 -1` 查看列表所有数据
- `lpop mylist` 获取第一个元素
- `llen mylist` 查看长度
- `linsert mylist [before|after] a` 插入数据

场景

- 简单消息队列

  ```
  rpush mylist x y z //插入元素x y z
  llen mylist //判断list长度是否大于1
  lpop mylist //输出x,进行业务处理
  ```

  

### set(无序集合,自动去重)

说明

```
k-v缓存,存储字符串
```

使用场景

- 缓存功能,存储字符串,可以做很多业务逻辑
- 计数器
- 共享用户session

常用命令

- 

### sort set(有序集合)

说明

```
k-v缓存,存储字符串
```

使用场景

- 缓存功能,存储字符串,可以做很多业务逻辑
- 计数器
- 共享用户session

常用命令

- 

### hash(哈希)

说明

```
k-v缓存,存储字符串
```

使用场景

- 缓存功能,存储字符串,可以做很多业务逻辑
- 计数器
- 共享用户session

常用命令

- 