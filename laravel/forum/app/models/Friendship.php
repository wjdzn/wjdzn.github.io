<?php

class Friendship extends Eloquent
{

    protected $table = 't_friends';
    protected $fillable = array('acc_1', 'acc_2', 'status');

    public static function areFriends($acc_1, $acc_2)
    {
        $acc_1 = e($acc_1);
        $acc_2 = e($acc_2);
        $check1 = Self::where('acc_1', $acc_1)->where('acc_2', $acc_2)->where('status', 1)->count();
        $check2 = Self::where('acc_1', $acc_2)->where('acc_2', $acc_1)->where('status', 1)->count();
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
        $check1 = Self::where('acc_1', $acc_1)->where('acc_2', $acc_2)->count();
        $check2 = Self::where('acc_1', $acc_2)->where('acc_2', $acc_1)->count();
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
        if (!Self::exists($acc_1, $acc_2)) {
            return false;
        } else {
            if (Self::where('acc_1', $acc_1)->where('acc_2', $acc_2)->count() > 0) {
                Self::where('acc_1', $acc_1)->where('acc_2', $acc_2)->delete();
            } else {
                if (Self::where('acc_1', $acc_2)->where('acc_2', $acc_1)->count() > 0) {
                    Self::where('acc_1', $acc_2)->where('acc_2', $acc_1)->delete();
                }
            }
        }
    }

}
