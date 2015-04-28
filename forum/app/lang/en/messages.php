<?php

//Messages in English
//word => translation
$max = Settings::first()->max_pic_upload_size;
$messages = array(
    'home' => 'Home',
    'register' => 'Register',
    'login' => 'Login',
    'online_users' => 'Online Users',
    'search' => 'Search',
    'register' => 'Register',
    'e-mail' => 'E-mail',
    'password' => 'Password',
    'answer' => 'Answer',
    'enter_e-mail' => 'Enter your email...',
    'enter_password' => 'Enter your password...',
    'wrong_answer' => 'Wrong answer',
    'logout' => 'Logout',
    'page_not_found' => 'Page Not Found',
    'enter_first_name' => 'Enter First Name',
    'enter_surname' => 'Enter Surname',
    'surname' => 'Surname',
    'first_name' => 'First Name',
    'wrong_email/password' => 'Wrong email or password',
    'profile' => 'Profile',
    'user_not_found' => 'User Not Found',
    'profile_viewed' => 'Profile Viewed',
    'posts' => 'Posts',
    'points' => 'Points',
    'country' => 'Country',
    'mail' => 'Mail',
    'categories' => 'Categories',
    'too_big_image' => "The image you try to upload is too big. Max. " . $max . "KB",
    'wrong_image' => 'Only .jpg and .png types are allowed',
    'image_success' => 'You have successifully changed your profile picture',
    'use_fb_image' => 'Use My Facebook Profile Picture',
    'change_password' => 'Change Password',
    'set_password' => 'Set Password',
    'my_settings' => 'My Settings',
    'facebook_set_password' => 'If you do not set your password you will need to login using facebook every time. If you set it you will not be able to login using facebook anymore.',
    'after_set_password_info' => 'After setting your password you will be able to login using the normal login. ',
    'new_password' => 'New Password',
    'successifully_set_password' => 'You have successifully set your password. Now you can login using the normal login not facebook.',
    'successifully_changed_password' => 'You have successifully changed your password.',
    'min_pass_6' => 'The password is too short. Min. 6 symbols',
    'user_with_this_email_exists' => 'User with this email already exists',
    'set' => 'Set',
    'change' => 'Change',
    'old_password' => 'Old Password',
    'new_password' => 'New Password',
    'old_password_is_not_correct' => 'Old password is not correct',
    'new_password_is_too_short' => 'New password is too short. Min. 6 symbols.',
    'min_6' => 'Min. is 6 symbols',
    'click_on_the_picture_to_change' => 'Click on the profile image in order to change it',
    'times' => 'Times',
    'replies' => 'Replies',
    'friends' => 'Friends',
    'profile_seen' => 'Profile Seen',
    'xp_points' => 'Experience Points',
    'update' => 'Update',
    'describe_yourself' => 'Describe Yourself',
    'city_where_you_live' => 'The name of the city where you live',
    'your_job' => 'Your job',
    'lives_in' => 'Lives in',
    'job' => 'Job',
    'friends_only' => 'Friends Only',
    'public' => 'Public',
    'city' => 'City',
    'job' => 'Job',
    'your_description' => 'Your description',
    'successifully_updated_profile' => 'You have successifully updated your profile.',
    'add_friends_list' => 'Add Into Friends List',
    'friend_request_successifully_sent' => 'You have successifully sent friend request',
    'cancel_request' => 'Cancel friend request',
    'friends' => 'Friends',
    'remove_from_friends_list' => 'Remove from friends list',
    'successifully_removed_from_friends_list' => 'User successifully removed from your friends list',
    'successifully_cancelled_request' => 'Friend request successifully cancelled',
    'friend_requests' => 'Friend Requests',
    'from' => 'From',
    'to' => 'To',
    'sent' => 'Sent',
    'options' => 'Options',
    'accept' => 'Accept',
    'reject' => 'Reject',
    'is_now_your_friend' => 'is now your friend!',
    'empty' => 'Empty',
    'there_are_not_any_friend_requests' => 'There are not any friend requests',
    'visible_only_for_friends' => 'Visible only for friends',
    'register_success' => 'You have successifully registered',
    'register_success_you_must_active_your_account' => 'Successifully registered. Now you need to active your account. Activation code has been sent to your email.',
    'account_not_activated' => 'Your account is not activated',
    'activation_link' => 'Activation Link',
    'activation_code_is' => 'Activation Code Is',
    'activate_your_account' => 'Activate your account',
    'activate_account' => 'Activate account',
    'this_account_has_been_already_activated' => 'This account has been already activated',
    'successifully_activated_account' => 'You have successifully activated your account',
    'the_user_does_not_exist' => 'The user does not exist',
    'activate' => 'Activate',
    'forgot_password' => 'Forgot password',
    'send' => 'Send',
    'normal_member' => 'Normal Member',
    'elite_member' => 'Elite Member',
    'moderator' => 'Moderator',
    'administrator' => 'Administrator',
    'user_has_more_than_100_points' => 'User has more than 100 points',
    'user_has_more_than_1000_points' => 'User has more than 1000 points',
    'user_has_more_than_10000_points' => 'User has more than 10000 points',
    'user_has_more_than_100000_points' => 'User has more than 100000 points',
    'pending' => 'Pending',
    'start_discussion' => 'Start a new discussion',
    'about_me' => 'About Me',
    'name' => 'Name',
    'last_post' => 'Last Reply By',
    'hits' => 'Hits',
    'important' => 'Important',
    'closed' => 'Closed',
    'no_posts' => 'No posts',
    'last_reply' => 'Last Reply',
    'terms_of_service' => 'Terms Of Service',
    'more_discussions' => 'More Discussions',
    'all_categories' => 'All categories',
    'seen' => 'Seen',
    'announcements' => 'Announcements',
    'create_category' => 'Create a category',
    'title' => 'Title',
    'max_length_150' => 'Max length is 150 symbols.',
    'create' => 'Create',
    'description' => 'Description',
    'too_short_title' => 'The title is too short',
    'too_short_description' => 'The description is too short',
    'too_long_title' => 'The title is too long',
    'too_short_name' => 'The name is too short',
    'the_category_is_empty' => 'The category is empty',
    'add_filters' => 'Add filters',
    'required_membership' => 'Rank required',
    'limit_2000' => 'The limit is 2000 characters (including HTML). Everything more will be deleted.',
    'limit_1000' => 'The limit is 1000 characters (including HTML). Everything more will be deleted.',
    'no_permissions' => 'You do not have the permissions to view this category',
    'you_must_login_to_view_this_category' => 'You must login in order to access this category',
    'only_for_logged' => 'Only for logged users',
    'discussions_per_page' => 'Discussions per page',
    'successifully_started_a_discussion' => 'You have successifully started a new discussion',
    'min_50' => 'Min. length is 50.',
    'reason-spamming' => 'Spamming',
    'i_agree_tos' => 'I agree Terms Of Service',
    'tos_required' => 'You must agree Terms Of Service',
    'you_are_banned' => 'You are banned. Your IP has been banned by the administrator.',
    'acc_banned' => 'The account is suspended until',
    'you_are_muted_the_reason_is' => 'You are muted, the reason is',
    'the_mute_will_expire_on' => 'The mute will expire on',
    'you_are_muted' => 'You are muted',
    'dis_not_found' => 'Discussions not found',
    'delete' => 'Delete',
    'edit' => 'Edit',
    'reply' => 'Reply',
    'edit_a_post' => 'Edit a post',
    'edit_a_discussion' => 'Edit a discussion',
    'discussion' => 'Discussion',
    'announcement' => 'Announcement',
    'report' => 'Report',
    'type' => 'Type',
    'reason' => 'Reason',
    'submit' => 'Submit',
    'too_short_report' => 'The report is too short',
    'successifully_sent_report' => 'You have successifully sent the report',
    'trash' => 'Trash',
    'inbox' => 'Inbox',
    'sender' => 'Sender',
    'date' => 'Date',
    'restore' => 'Restore',
    'mails' => 'Mails',
    'successifully_deleted' => 'Successifully deleted',
    'successifully_restored' => 'Successifully restored',
    'you_must_select_at_least_one_mail' => 'You must select at least one mail',
    'discussion_is_closed' => 'The discussion is closed',
    'user_with_this_email_does_not_exist' => 'User with this email does not exist',
    'activate_your_account' => 'Activate your account',
    'we_have_sent_your_new_password_to_your_email' => 'We have sent your new password to your email',
    'your_new_password_is' => 'Your new password is',
    'you_can_login_here' => 'You can login here',
    'send_message' => 'Send message',
    'message' => 'Message',
    'successifully_sent_message_to' => 'Successifully sent message to',
    'too_short_message' => 'The message is too short',
    'compose' => 'Compose',
    'subject' => 'Subject',
    'you_can_not_send_messages_to_yourself' => 'You can not send messages to yourself',
    'too_short_subject' => 'The subject is too short',
    'users_found' => 'Users Found',
    'discussions_found' => 'Discussions Found',
    'categories_found' => 'Categories Found',
    'posts_found' => 'Posts Found',
    'there_is_no_category_with_name' => 'There is not any category with name',
    'there_is_not_any_user_with_firstname_surname_or_email' => 'There is not any user with first name or surname or email',
    'there_is_not_any_discussion_with_title' => 'There is not any discussion with title',
    'there_is_not_any_post_which_contains_the_word' => 'There is not any post which contains the word',
    'in_category' => 'In category',
    'hot' => 'Hot',
    'delete_a_category' => 'Delete A Category',
    'delete_a_discussion' => 'Delete A Discussion',
    'cancel' => 'Cancel',
    'your_password' => 'Your password',
    'wrong_password' => 'Wrong password',
    'continue' => 'Continue',
    'edit_a_category' => 'Edit a category',
    'admin_panel' => 'Admin Panel',
    'basic_settings' => 'Basic Settings',
    'site_title' => 'Site Title',
    'site_description' => 'Site Description',
    'registered_users' => 'Registered Users',
    'discussions' => 'Discussions',
    'most_popular_users' => 'Most Popular Users',
    'most_popular_discussions' => 'Most Popular Discussions',
    'there_are_not_any_discussions' => 'There are not any discussions',
    'language' => 'Language',
    'facebook_settings' => 'Facebook Settings',
    'translations' => 'Translations',
    'themes' => 'Themes',
    'keywords' => 'Keywords',
    'account_activation' => 'Account Activation (The user must activate his account after registration)',
    'tos_admin' => 'TOS (The user must accept TOS in order to register)',
    'facebook_settings_desc' => 'Facebook app secret and app id are used for facebook login. If they are not set or they are invalid the facebook login will not work.',
    'successifully_updated_settings' => 'Successifully updated settings',
    'mute' => 'Mute',
    'successifully_muted_this_user' => 'You have successifully muted this user',
    'successifully_banned_this_user' => 'You have successifully banned this user',
    'this_user_is_banned' => 'This user is banned',
    'time' => 'Time',
    'hour' => 'Hour',
    'hours' => 'hours',
    'days' => 'Days',
    'minutes' => 'minutes',
    'unmute' => 'Unmute',
    'users' => 'Users',
    'registered_at' => 'Registered at',
    'per_page' => 'Per Page',
    'reports' => 'Reports',
    'bans' => 'Bans',
    'id' => 'Id',
    'by' => 'By',
    'read' => 'Read',
    'reported_by' => 'Reported By',
    'there_are_not_any_reports' => 'There are not any reports',
    'ip_address' => 'IP Address',
    'user' => 'User',
    'unban' => 'Unban',
    'there_are_not_any_banned_users_or_ips' => 'There are not any banned users or IPs',
    'ban_user_or_ip' => 'Ban user or IP',
    'choose_ban_type' => 'Choose ban type',
    'rank_up' => 'Rank Up',
    'rank_down' => 'Rank Down',
    'ban' => 'Ban',
    '0_for_forever' => '0 for forever',
    'you_have_successifully_updated_tos' => 'You have successifully updated Terms Of Service',
    'deleting_user' => 'Deleting User',
    'max_profile_pic_upload_size' => 'Max. Profile Picture Image Upload Size (in KB)'
);
return $messages;
