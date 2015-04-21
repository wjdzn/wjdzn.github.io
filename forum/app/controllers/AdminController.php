<?php

class AdminController extends BaseController
{

    public function getIndex()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                return View::make('admin.index');
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function getSettings()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $settings = Settings::first();
                return View::make('admin.settings', array('settings' => $settings));
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function postSettings()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                if (Input::get('acc_activation')) {
                    $acc_activation = 1;
                } else {
                    $acc_activation = 0;
                }
                if (Input::get('tos')) {
                    $tos = 1;
                } else {
                    $tos = 0;
                }

                $settings = Settings::first();
                $settings->title = e(Input::get('site_title'));
                $settings->description = e(Input::get('site_description'));
                $settings->keywords = e(Input::get('keywords'));
                $settings->tos = $tos;
                $settings->acc_activation = $acc_activation;
                $settings->max_pic_upload_size = e(Input::get('maxsize'));
                $settings->save();
                return Redirect::to('admin-panel/settings')->with('success', Lang::get('messages.successifully_updated_settings'));
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function getThemes()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                return View::make('admin.themes');
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function postThemes()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $settings = Settings::first();
                $settings->theme = e(Input::get('theme'));
                $settings->save();
                return Redirect::to('admin-panel/themes')->with('success', Lang::get('messages.successifully_updated_settings'));
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function getMute($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            $user = User::find($id);
            if ($user != null) {
                if ($user->email == Session::get('logged')) {
                    return Redirect::to('/');
                }
                if (User::isMuted($user->email)) {
                    return 'The user is muted';
                } else {
                    if ($me->membership >= 3) {
                        return View::make('user.mute', array('user' => $user));
                    } else {
                        return Redirect::to('/');
                    }
                }
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function postMute($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            $user = User::find($id);
            if ($user != null) {
                if ($user->email == Session::get('logged')) {
                    return Redirect::to('/');
                }
                if ($me->membership >= 3) {
                    if (!User::isMuted($user->email)) {
                        $time = e(Input::get('time'));
                        Mute::create(array(
                            'user_id' => $user->id,
                            'muted_from' => time(),
                            'muted_to' => time() + $time,
                            'reason' => e(Input::get('reason'))
                        ));
                        return Redirect::to('profile/' . $user->email)->with('success', Lang::get('messages.successifully_muted_this_user'));
                    } else {
                        return 'The user is muted!';
                    }
                } else {
                    return Redirect::to('/');
                }
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function unmute($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            $user = User::find($id);
            if ($user != null) {
                if ($user->email == Session::get('logged')) {
                    return Redirect::to('/');
                }
                if ($me->membership >= 3) {
                    if (User::isMuted($user->email)) {
                        Mute::where('user_id', $user->id)->where('muted_to', '>', time())->delete();
                    }
                }
                return Redirect::back();
            }
        }
    }

    public function getUsers()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                if (!Session::has('a_order')) {
                    Session::put('a_order', array('created_at', 'DESC'));
                }
                if (!Session::has('a_limit')) {
                    Session::put('a_limit', 10);
                }
                $users = User::orderBy(Session::get('a_order')[0], Session::get('a_order')[1])->paginate(Session::get('a_limit'));
                return View::make('admin.users', array('users' => $users));
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function setLimit($num)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $limit = 10;
                if ($num == 10 || $num == 20 || $num == 50 || $num == 100) {
                    $limit = $num;
                }
                Session::put('a_limit', $limit);
            }
        }
        return Redirect::back();
    }

    public function setOrder($by)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $by_final = 'created_at';
                $type_final = 'DESC';
                if ($by == 'email' || $by == 'first_name' || $by == 'surname' || $by == 'points' || $by == 'created_at') {
                    $by_final = $by;
                }
                if (Session::has('a_order')) {
                    if (Session::get('a_order')[1] == 'DESC') {
                        $type_final = 'ASC';
                    }
                }
                Session::put('a_order', array($by_final, $type_final));
            }
        }
        return Redirect::back();
    }

    public function getReports()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $reports = Report::orderBy('created_at', 'DESC')->paginate(10);
                return View::make('admin.reports', array('reports' => $reports));
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function getReport($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $report = Report::find($id);
                if ($report != null) {
                    return View::make('admin.report', array('report' => $report));
                } else {
                    return Redirect::to('/');
                }
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function deleteReport($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $report = Report::find($id);
                $report->delete();
                return Redirect::back();
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function getBans()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $bans = Ban::orderBy('ban_from', 'DESC')->paginate(10);
                return View::make('admin.bans', array('bans' => $bans));
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function removeBan($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $ban = Ban::find($id);
                if ($ban != null) {
                    $ban->delete();
                }
                return Redirect::back();
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function createBan()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                return View::make('admin.createBan');
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function postCreateBan()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $data = array(
                    'ip' => Input::get('ip'),
                    'email' => Input::get('email')
                );
                $rules = array(
                    'ip' => 'ip',
                    'email' => 'email|exists:t_users,email'
                );
                $validator = Validator::make($data, $rules);
                if ($validator->fails()) {
                    return Redirect::to('ban/create')->with('errors', $validator->messages());
                } else {
                    if (Input::get('time') == 0) {
                        $time = 3600 * 24 * 365 * 10000;
                    } else {
                        $time = e(Input::get('time')) * 3600 * 24;
                    }
                    if (strlen(Input::get('email')) > 0) {
                        if (Input::get('email') == Session::get('logged')) {
                            return Redirect::back();
                        }
                        $buser = 1;
                        $bip = 0;
                        $ip = "";
                        $uid = User::where('email', e(Input::get('email')))->first()->id;
                    } else {
                        $bip = 1;
                        $uid = "";
                        $buser = 0;
                        $ip = e(Input::get('ip'));
                    }
                    Ban::create(array(
                        'ban_from' => time(),
                        'ban_to' => time() + $time,
                        'bannedIp' => $bip,
                        'bannedUser' => $buser,
                        'user_id' => $uid,
                        'ip' => $ip
                    ));
                    return Redirect::to('profile/' . Input::get('email'))->with('success', Lang::get('messages.successifully_banned_this_user'));
                }
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function getTos()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $tos = TOS::first();
                return View::make('admin.tos', array('tos' => $tos));
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function postTos()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                foreach (TOS::get() as $t) {
                    $t->delete();
                }
                TOS::create(array(
                    'tos' => Input::get('tos')
                ));
                return Redirect::to('admin-panel/tos')->with('success', Lang::get('messages.you_have_successifully_updated_tos'));
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function userUp($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $user = User::find($id);
                if ($user != null) {
                    if ($user->membership < 4) {
                        $user->membership+=1;
                        $user->save();
                    }
                    return Redirect::back();
                }
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function userDown($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $user = User::find($id);
                if ($user != null) {
                    if ($user->membership > 1) {
                        $user->membership-=1;
                        $user->save();
                    }
                    return Redirect::back();
                }
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

}
