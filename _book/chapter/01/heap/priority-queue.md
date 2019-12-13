# 优先队列
#### 基于最大堆实现最大优先队列
###### 1、返回最大堆中最大键值的元素
###### 2、去掉并返回最大堆中具有最大键值的元素
###### 3、将元素$i的值增加到$key, 且$arr[$i] <= $key
###### 4、插入$key到$arr中，并保持最大堆性质
```php
/**
 * 返回最大堆中最大键值的元素
 * @param array $arr 最大堆
 * @return mixed
 */
function heap_maximum(&$arr){
    return $arr[0];
}
/**
 * 去掉并返回最大堆中具有最大键值的元素
 * @param array $arr 最大堆
 * @return mixed
 */
function heap_extract_max(&$arr){
    $max = $arr[0];
    $arr[0] = $arr[count($arr) - 1];
    unset($arr[count($arr) - 1]);
    $arr = max_heapify_recursive($arr, 0, count($arr));
    return $max;
}
//$arr = [16,14,10,8,7,9,3,2,4,1];
//print_r(heap_extract_max($arr));
//print_r($arr);

/**
 * 将元素$i的值增加到$key, 且$arr[$i] <= $key
 * @param array $arr 最大堆
 * @param int $i 数组下标
 * @param int $key 替换的值
 * @return mixed
 */
function heap_increase_key($arr, $i, $key){
    $arr[$i] = $key;
    while($i > 0 && $arr[parent($i)] < $arr[$i]){
        $temp = $arr[parent($i)];
        $arr[parent($i)] = $arr[$i];
        $arr[$i] = $temp;
        $i = parent($i);
    }
    return $arr;
}
//$arr = [16,14,10,8,7,9,3,2,4,1];
//print_r(heap_increase_key($arr, 3, 20));

/**
 * 插入$key到$arr中，并保持最大堆性质
 * @param array $arr 最大堆
 * @param int $key 插入的值
 * @return mixed
 */
function max_heap_insert($arr, $key){
    return heap_increase_key($arr, count($arr), $key);
}
//$arr = [16,14,10,8,7,9,3,2,4,1];
//print_r(max_heap_insert($arr, 20));
````
