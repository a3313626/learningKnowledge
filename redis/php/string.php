<?php

echo "<pre>";
$redis = new Redis();
$redis->connect("redis");
echo "Server is running: " . $redis->ping() . "<br>";

//存储字符串
print_r("<br>存储字符串:" . $redis->set("string", "100", 84000000)); //bool
print_r("<br>获取字符串:" . $redis->get("string")); //100
//获取所有的key
print_r("<br>获取keys:");
print_r($redis->keys("*")); //返回数组
/**
 * [6] => string|v1|value
 * [7] => string
 */
//搜索string开头的key
print_r("<br>获取string开头的keys");
print_r($redis->keys("string*")); //返回数组
/**
 * (
 * [0] => string|v1|value
 * [1] => string
 * )
 */
print_r("<br>把字符串分割,并获取前2个字符:");
print_r($redis->getRange("string", 0, 1)); //10 从0开始 原始值是100 获取0和1的值所以是10

$redis->set("string1", "你好", 84000000);
print_r("<br>把字符串分割,并获取前2个字符,测试下中文有没有影响:");
print_r($redis->getRange("string1", 0, 2)); //输出你
print_r("<br>显示所有字符串:");
print_r($redis->getRange("string1", 0, -1)); //你好

print_r("<br>重新设置值,并返回旧值:");
print_r($redis->getSet("string", 200)); //100

print_r("<br>批量设置:");
print_r($redis->mset(["string", "string2", "string3" => 100])); //bool
print_r("<br>批量获取:");
print_r($redis->mget(["string", "string2", "string3"]));
/**
 * (
 * [0] => 200 //并没有改变这个值
 * [1] =>
 * [2] => 100 //php可以用数组加入默认值
 * )
 */

print_r("<br>不存在就插入:");
print_r("<br>不存在就插入:插入string:");
var_dump($redis->setNx("string" , 1000)); //bool,存在无法插入
print_r("不存在就插入:插入string4");
var_dump($redis->setNx("string4:" , 1000)); //bool,不存在插入成功



print_r("插入带过期时间:");
var_dump($redis->setEx("string5" , 1000 , 2000)); //bool

print_r("替换:");
var_dump($redis->setRange("string5" , 1 , 2000)); //返回字符串长度
var_dump($redis->get("string5" )); //22000


print_r("递增:");
var_dump($redis->incr("age" )); //1
print_r("递增10:");
var_dump($redis->incrBy("age" ,10 )); //11



print_r("递减:");
var_dump($redis->decr("age" )); //10
print_r("递减10:");
var_dump($redis->decrBy("age" ,10 )); //0

//小数点过多是php的问题
print_r("增减浮点数,增加100.11:");
var_dump($redis->incrByFloat("money" , 100.11 )); //float(100.10999999999)
print_r("减少100.11:");
var_dump($redis->incrByFloat("money" ,-99.2 )); //float(0.91000000000008)


print_r("追加:");
var_dump($redis->append("age1" , 10 ));
var_dump($redis->get("age1")); //10 第二次 1010

print_r("获取字符串长度:");
var_dump($redis->strlen("age1")); //int(6)

//getbit/setbit/bitcount/bitop    位操作不常用






