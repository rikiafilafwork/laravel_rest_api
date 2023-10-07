<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProblemSolvingController extends Controller
{
    //Problem Solving Basic - Test 1
    function miniMaxSum(Request $request)
    {
        $arr = $request->input;
        sort($arr);
        $minSum = array_sum($arr) - $arr[4];
        $maxSum = array_sum($arr) - $arr[0];
        $result = $minSum . " " . $maxSum;

        return response()->json([
            'input' => $request->all(),
            'output' => $result
        ]);
    }

    //Problem Solving Basic - Test 2
    function plusMinus(Request $request)
    {
        $arr = $request->input;
        $countArr = count($arr);
        $positiveCount = 0;
        $negativeCount = 0;
        $zeroCount = 0;
        for ($i = 0; $i < $countArr; $i++) {
            if ($arr[$i] > 0) {
                $positiveCount++;
            }
            if ($arr[$i] < 0) {
                $negativeCount++;
            }
            if ($arr[$i] === 0) {
                $zeroCount++;
            }
        }
        $positiveCalculate = floatval($positiveCount / $countArr);
        $negativeCalculate = floatval($negativeCount / $countArr);
        $zeroCalculate = floatval($zeroCount / $countArr);

        $positiveFormat = number_format($positiveCalculate, 6, '.', '');
        $negativeFormat = number_format($negativeCalculate, 6, '.', '');
        $zeroFormat = number_format($zeroCalculate, 6, '.', '');
        $result = [$positiveFormat,$negativeFormat, $zeroFormat];
        return response()->json([
            'input' => $request->all(),
            'output' => $result
        ]);
    }

    //Problem Solving Basic - Test 3
    function timeConversion(Request $request)
    {
        $s = $request->input;
        $armyTime = date("H:i:s", strtotime($s));

        $result = $armyTime;
        return response()->json([
            'input' => $request->all(),
            'output' => $result
        ]);
    }
}
