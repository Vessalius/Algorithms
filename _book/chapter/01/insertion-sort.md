# 插入排序

#### 插入排序
```php
/**
 插入排序
 * @param array $arr 需要排序的数组
 * @param integer $sort 排序方式 1:升序 0:降序 默认升序
 * @return mixed
 */
function insertion_sort($arr, $sort = 1){
    for($i = 1;$i < count($arr);++$i){
        $num = $arr[$i];
        /*把当前元素插入到已排序数组中*/
        $j = $i - 1;
        if($sort){
            //如果前一个元素大于当前元素就把$j+1对应的元素变成$j对应的元素
            while($j >= 0 && $arr[$j] > $num){
                $arr[$j + 1] = $arr[$j];
                --$j;
            }
        }else{
            //如果前一个元素小于当前元素就把$j+1对应的元素变成$j对应的元素
            while($j >= 0 && $arr[$j] < $num){
                $arr[$j + 1] = $arr[$j];
                --$j;
            }
        }
        //找到插入位置赋值
        $arr[$j + 1] = $num;
    }
    return $arr;
}

$arr = [5,2,4,6,1,3];
print_r(insertion_sort($arr));
```
***
#### 2个n位二进制整数相加

###### 我自己写的
```php
/**
 * 2个n位二进制整数相加，分别存在2个n元数组A跟B中(低位在前)，相加结果为一个(n+1)元数组C
 * @param array $arrA
 * @param array $arrB
 */
function my_add_binary($arrA, $arrB){
    //$flag 为进位标识
    $flag = 0;
    $arrC = [];
    for($i = 0;$i < count($arrA);++$i){
        $sum = $arrA[$i] + $arrB[$i];
        if($sum > 1){ //需要进位
            $arrC[$i] = $flag?1:0; //因为需要进位所以本位为0，但是如果上次运算后有进位 本次运算需要取反为1
            $flag = 1; //进位
        }else{ //不需要进位
            $arrC[$i] = $flag?!$sum:$sum;
            $flag = 0;
        }
    }
    $arrC[count($arrC)] = $flag;
    return $arrC;
}
$arrA = [0,1,0,1];
$arrB = [1,1,0,0];
print_r(my_add_binary($arrA, $arrB));
```
***
###### 网上找到的答案

```php
function add_binary($arrA, $arrB){
    $flag = 0;
    $arrC = [];
    for($i = 0;$i < count($arrA);++$i){
        $arrC[$i] = ($arrA[$i] + $arrB[$i] + $flag) % 2;
        $flag = intval(($arrA[$i] + $arrB[$i] + $flag) / 2);
    }
    $arrC[count($arrC)] = $flag;
    return $arrC;
}

$arrA = [0,1,0,1];
$arrB = [1,1,0,0];
print_r(add_binary($arrA, $arrB));
```