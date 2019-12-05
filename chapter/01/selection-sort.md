# 插入排序

#### 选择排序
```php
/**
 * 选择排序
 * @param array $arr
 * @param array $result
 * @return array
 */
function selection_sort($arr,$result = []){
    //默认下标0为$arr中的最小元素的下标
    $min = 0;
    $temp = [];
    //每次对比之后更新最小下标
    for($i = 1;$i < count($arr);++$i){
        if($arr[$i] < $arr[$min]){
            $min = $i;
        }
    }
    //最小值加到$result数组的最后
    $result[] = $arr[$min];
    //去掉最小值后的新数组
    for($i = 0;$i < count($arr);++$i){
        if($i != $min){
            $temp[] = $arr[$i];
        }
    }
    if(!empty($temp)){
        $result = selection_sort($temp,$result);
    }
    return $result;
}

$arr = [1,2,6,7,1,2,3,2,1];
print_r(selection_sort($arr));
```