# 归并排序

#### 分治法
###### 已知：数组$arr, p≤q<r 数组$arr[p...q] 和 数组$arr[q+1...r] 为已经升序排列的两个子数组。    
###### 目的：把两个子数组形成一个升序排列的数组并替换到原数组中
```php
/**
 * 分治法
 * @param array $arr 原始数组
 * @param int $p，$q，$r 满足$p <= $q < $r
 */
function merge($arr, $p, $q, $r){
    //定义两个子数组（都已知为升序排列）
    $n1 = $q - $p + 1;
    $n2 = $r - $q;
    $L = [];
    $R = [];
    for($i = 0;$i < $n1;++$i){
        $L[$i] = $arr[$p + $i];
    }
    for($j = 0;$j < $n2;++$j){
        $R[$j] = $arr[$q + $j + 1];
    }
    //比较两个子数组中第一个元素的较小值放入原数组对应位置中
    $i = 0;
    $j = 0;
    for($k = $p;$k <= $r;++$k){
        //考虑有一个子数组取完时的情况
        if($j == $n2 ||($L[$i] <= $R[$j] && $i < $n1)){
            $arr[$k] = $L[$i];
            ++$i;
        }else{
            $arr[$k] = $R[$j];
            ++$j;
        }
    }
    return $arr;
}

$arr = [1,3,4,3,1,3,8,9,2,4,5,7,1,2,3,6,4,3,7,8,4,2];
print_r(merge($arr, 8, 11, 15));
```
***
#### 归并排序(自顶向下)
###### 采用递归，利用了上面的分治法

```php
/**
 * 分治法
 * @param array $arr 原始数组
 * @param int $p，$q，$r 满足$p <= $q < $r
 */
function merge(&$arr, $p, $q, $r){
    //定义两个子数组（都已知为升序排列）
    $n1 = $q - $p + 1;
    $n2 = $r - $q;
    $L = [];
    $R = [];
    for($i = 0;$i < $n1;++$i){
        $L[$i] = $arr[$p + $i];
    }
    for($j = 0;$j < $n2;++$j){
        $R[$j] = $arr[$q + $j + 1];
    }
    //比较两个子数组中第一个元素的较小值放入原数组对应位置中
    $i = 0;
    $j = 0;
    for($k = $p;$k <= $r;++$k){
        //考虑有一个子数组取完时的情况
        if($j == $n2 ||($L[$i] <= $R[$j] && $i < $n1)){
            $arr[$k] = $L[$i];
            ++$i;
        }else{
            $arr[$k] = $R[$j];
            ++$j;
        }
    }
    return $arr;
}

/**
 * 利用分治法进行归并排序
 * @param array $arr
 * @param int $p,$r
 */
function merge_sort(&$arr, $p, $r){
    if($p < $r){
        //取中间数
        $q = intval(($p + $r) / 2);
        merge_sort($arr, $p, $q);
        merge_sort($arr, $q + 1, $r);
        merge($arr, $p, $q, $r);
    }
}

$arr = [1,3,4,3,1,3,8,9,2,4,5,7,1,2,3,6,4,3,7,8,4];
merge_sort($arr, 0, 20);
print_r($arr);
```