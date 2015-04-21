<?php

class User extends Eloquent
{

    protected $table = 't_users';
    protected $fillable = array('email', 'username', 'password', 'first_name', 'surname', 'membership', 'points', 'posts', 'views', 'last_seen', 'ip', 'country', 'access_token', 'activated', 'activation_code', 'fb_id');

    public function profile()
    {
        return $this->hasOne('Profile');
    }

    public function discussions()
    {
        return $this->hasMany('Discussion', 'by_id');
    }

    public static function getProfileLink($id)
    {
        $user = User::find($id);
        if ($user != null) {
            if (File::exists('assets/images/profile/' . $id . '.jpg') || File::exists('assets/images/profile/' . $id . '.png')) {
                if (File::exists('assets/images/profile/' . $id . '.jpg')) {
                    return URL::to('assets/images/profile/' . $id . '.jpg');
                } else {
                    return URL::to('assets/images/profile/' . $id . '.png');
                }
            } else {
                if ($user->fb_id != "") {
                    return 'https://graph.facebook.com/' . $user->fb_id . '/picture?type=large';
                } else {
                    return URL::to('assets/images/default-avatar.png');
                }
            }
        } else {
            return false;
        }
    }

    public static function keyGenerate($user_id)
    {
        if (User::find($user_id) == null) {
            return false;
        } else {
            if (Key::where('user_id', $user_id)->first() != null) {
                $id = Key::where('user_id', $user_id)->first()->destroy();
            }
            $key = str_random(20);
            Key::create(array('created' => time(), 'key' => $key, 'user_id' => $user_id));
            return true;
        }
    }

    public static function isMuted($email)
    {
        $user = Self::where('email', $email)->first();
        if ($user != null) {
            $mute = Mute::where('user_id', $user->id)->where('muted_to', '>', time())->count();
            if ($mute > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function isOnline($email)
    {
        $user = Self::where('email', $email)->first();
        if ($user != null) {
            if ($user->last_seen > time() - 900) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
