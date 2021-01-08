<?php
/**
 * Returns file path for current user
 *
 * @param $user_id
 * @param $subdir
 * @param $create_if_not_exists
 * @return string
 */
function get_user_file_path($user_id, $subdir = '', $create_if_not_exists = TRUE)
{
    $user_pad = str_pad($user_id, 8, '0', STR_PAD_LEFT);
    $dir = 'uploads/' . implode('/', str_split($user_pad));

    if ($subdir != '') {
        $dir = $dir . '/' . $subdir;
    }

    if ($create_if_not_exists and !is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    return $dir . '/';
}

/**
 * Returns full path to user logo
 *
 * @param $user_id
 * @param $file_name
 * @return string
 */
function get_user_logo_path($user_id, $file_name, $size = "")
{
    $file_path = $this->get_user_file_path($user_id, 'logo/'.$size, FALSE) . $file_name;
    if (is_file($file_path)) {
        return '/' . $file_path;
    } else {
        return STANDARD_LOGO;
    }
}

/**
 * Returns full path to user logo
 *
 * @param $user_id
 * @param $file_name
 * @return string
 */
function get_user_photo_path($user_id, $file_name, $subdir = 'photo')
{
    $file_path = $this->get_user_file_path($user_id, $subdir, FALSE) . $file_name;
    if (is_file($file_path)) {
        return '/' . $file_path;
    } else {
        return STANDARD_PHOTO;
    }
}
