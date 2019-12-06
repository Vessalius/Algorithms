# 冒泡排序

#### 冒泡排序
###### 反复交换相邻的未按次序排列的元素

```php
/**
 * 冒泡排序
 * @param array $arr 需要排序的原数组
 * @return mixed
 */
function bubble_sort($arr){
    $length = count($arr);
    for($i = 0;$i < $length - 1;++$i){
        for($j = $length - 1;$j > $i;--$j){
            if($arr[$j] < $arr[$j - 1]){
                $temp = $arr[$j - 1];
                $arr[$j - 1] = $arr[$j];
                $arr[$j] = $temp;
            }
        }
    }
    return $arr;
}
$arr = [9,5,4,8,3,2,1,8,7,6,8,4,5];
print_r(bubble_sort($arr));
```