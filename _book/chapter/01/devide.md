# 分治法

#### 最大子数组问题(分治法)
###### 寻找一个数组中的和最大的非空连续子数组
###### 思路：分别求得只在左半边的、只在右半边的、跨越中点的，然后比较大小

```php
/**
 * 求跨越中点的最大子数组
 * @param array $arr 原数组
 * @param int $low 最低点下标
 * @param int $mid 中点下标
 * @param int $high 最高点下标
 * @return array
 */
function find_max_crossing_subarray($arr, $low, $mid, $high){
    //求左半部分最大子数组，已知子数组会跨越中点
    $left_sum = $arr[$mid];
    $max_left  = $mid;
    $sum = 0;
    for($i = $mid;$i >= $low;--$i){
        $sum += $arr[$i];
        if($sum > $left_sum){
            $left_sum = $sum;
            $max_left = $i;
        }
    }
    //同理求右半部分
    $right_sum = $arr[$mid+1];
    $max_right  = $mid+1;
    $sum = 0;
    for($i = $mid+1;$i <=$high;++$i){
        $sum += $arr[$i];
        if($sum > $right_sum){
            $right_sum = $sum;
            $max_right = $i;
        }
    }
    return ['low' => $max_left, 'high' => $max_right, 'sum' => $left_sum + $right_sum];
}

/**
 * 求数组的最大子数组（分治法）
 * @param array $arr 原数组
 * @param int $low 最低点下标
 * @param int $high 最高点下标
 * @return array
 */
function find_maximum_subarray($arr, $low, $high){
    if($high == $low){
        return ['low' => $low, 'high' => $high, 'sum' => $arr[$low]];
    }else{
        $mid = intval(($low + $high) / 2);
        $left = find_maximum_subarray($arr, $low, $mid);
        $right = find_maximum_subarray($arr, $mid + 1, $high);
        $cross = find_max_crossing_subarray($arr, $low, $mid, $high);
        if($left['sum'] >= $right['sum'] && $left['sum'] >= $cross['sum']){ //最大数组在左半边
            return ['low' => $left['low'], 'high' => $left['high'], 'sum' => $left['sum']];
        }else if($right['sum'] >= $left['sum'] && $right['sum'] >= $cross['sum']){ //最大数组在右半边
            return ['low' => $right['low'], 'high' => $right['high'], 'sum' => $right['sum']];
        }else{ //最大数组跨越中点
            return ['low' => $cross['low'], 'high' => $cross['high'], 'sum' => $cross['sum']];
        }
    }
}

$arr = [13,-3,-25,20,-3,-16,-23,18,20,-7,12,-5,-22,15,-4,7];
print_r(find_maximum_subarray($arr, 0, 15));
```
#### 最大子数组问题（暴力求解）
###### 利用嵌套for循环求所有子数组中最大值
```php
/**
 * 求数组的最大子数组（暴力求解）
 * @param $arr
 * @return array
 */
function force_find_maximum_subarray($arr){
    $max = $arr[0];
    $low = 0;
    $high = 0;
    for($i = 0;$i < count($arr);++$i){
        $sum = 0;
        for($j = $i;$j < count($arr);++$j){
            $sum += $arr[$j];
            if($sum > $max){
                $max = $sum;
                $low = $i;
                $high = $j;
            }
        }
    }
    return ['low' => $low, 'high' => $high, 'sum' => $max];
}

print_r(force_find_maximum_subarray($arr));
```