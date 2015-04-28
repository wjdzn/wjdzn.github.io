<?php

class Friendship extends Eloquent
{

    protected $table = 't_friends';
    protected $fillable = array('acc_1', 'acc_2', 'status');

    public static function areFriends($acc_1, $acc_2)
    {
        $acc_1 = e($acc_1);
        $acc_2 = e($acc_2);
        $check1 = self::where('acc_1', $acc_1)->where('acc_2', $acc_2)->where('status', 1)->count();
        $check2 = self::where('acc_1', $acc_2)->where('acc_2', $acc_1)->where('status', 1)->count();
        if ($check1 > 0 || $check2 > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function exists($acc_1, $acc_2)
    {
        $acc_1 = e($acc_1);
        $acc_2 = e($acc_2);
        $check1 = self::where('acc_1', $acc_1)->where('acc_2', $acc_2)->count();
        $check2 = self::where('acc_1', $acc_2)->where('acc_2', $acc_1)->count();
        if ($check1 > 0 || $check2 > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function deletef($acc_1, $acc_2)
    {
        $acc_1 = e($acc_1);
        $acc_2 = e($acc_2);
        if (!self::exists($acc_1, $acc_2)) {
            return false;
        } else {
            if (self::where('acc_1', $acc_1)->where('acc_2', $acc_2)->count() > 0) {
                self::where('acc_1', $acc_1)->where('acc_2', $acc_2)->delete();
            } else {
                if (self::where('acc_1', $acc_2)->where('acc_2', $acc_1)->count() > 0) {
                    self::where('acc_1', $acc_2)->where('acc_2', $acc_1)->delete();
                }
            }
        }
    }

}
