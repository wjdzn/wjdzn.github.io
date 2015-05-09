<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class UserForum extends Model implements AuthenticatableContract, CanResetPasswordContract  {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't_users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'email', 'password','surname','points','membership','views', 'last_seen', 'ip', 'country', 'access_token', 'activated', 'activation_code', 'fb_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token','password_text'];

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

    public static function isMuted($email)
    {
        $user = self::where('email', $email)->first();
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
        $user = self::where('email', $email)->first();
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
