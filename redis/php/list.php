<?php
/**
 * lpush mylist a b c  左插入
 * rpush mylist x y z  右插入
 * lrange mylist 0 -1  数据集合
 * lpop mylist  弹出元素
 * rpop mylist  弹出元素
 * llen mylist  长度
 * lrem mylist count value  删除
 * lindex mylist 2          指定索引的值
 * lset mylist 2 n          索引设值
 * ltrim mylist 0 4         删除key
 * linsert mylist before a  插入
 * linsert mylist after a   插入
 * rpoplpush list list2     转移列表的数据
 */


echo "<pre>";
$redis = new Redis();
$redis->connect("redis");

print_r("</br>左插入:");
print_r($redis->lPush("test:mylist", "a", "b", "c")); //返回长度,倒序插入
echo "<br>";
print_r($redis->lRange("test:mylist", 0, -1));
/**
 * Array
 * (
 * [0] => c
 * [1] => b
 * [2] => a
 * )
 */

print_r("</br>右插入:");
print_r($redis->rPush("test:mylist", "a", "b", "c")); //返回长度6,正序插入

echo "<br>";
print_r($redis->lRange("test:mylist", 0, -1));
/**
 * Array
 * (
 * [0] => c
 * [1] => b
 * [2] => a
 * [3] => a
 * [4] => b
 * [5] => c
 * )
 */

$redis->rPush("test:mylist", "1", "2", "3");
print_r("</br>弹出元素:");
var_dump($redis->lPop("test:mylist")); //弹出c 列表里第一个

print_r("</br>弹出元素:");
var_dump($redis->rPop("test:mylist")); //弹出3 列表里最后一个
print_r($redis->lRange("test:mylist", 0, -1));

print_r("</br>list长度:");
print_r($redis->lLen("test:mylist")); //14


print_r("</br>list指定值删除:");
//count 删除多少个
print_r($redis->lRem("test:mylist" , 'a' , 100));  //bool
//这里可以看到所有的a都删除了
print_r($redis->lRange("test:mylist", 0, -1));


print_r("</br>list获取指定索引值:");
print_r($redis->lIndex("test:mylist", 13)); //具体值

print_r("</br>修改指定索引的值:");
print_r($redis->lSet("test:mylist", 10 , "你好")); //bool
print_r($redis->lRange("test:mylist", 0, -1));

print_r("</br>根据key保留指定list内容,其他删除:");
print_r($redis->lTrim("test:mylist", 0 , 10)); //bool
print_r($redis->lRange("test:mylist", 0, -1));
