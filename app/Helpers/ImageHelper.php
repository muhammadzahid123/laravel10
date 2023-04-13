use gravatar;
use App\Models\User;
<?php

class ImageHelper
{
    use gravatar;

    public static function getUserImage($id)
    {
        $user = User::find($id);
        $avatar_url = "";
        if (!is_null($user)) {
            if ($user->avatar == null) {
                // <!-- return him gravatar image -->
                if (gravatar::validate_gravatar($user->email)) {
                    $avatar_url = gravatar::gravatar_image($user->email, 100);
                }
            } else {
                // <!-- return that image -->
            }
        } else {
            // return redirect('/');
        }

        return $avatar_url;
    }
}
