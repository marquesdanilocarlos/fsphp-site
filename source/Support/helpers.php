<?php

/**
 * ########################
 * ### VALIDATE HELPERS ###
 * ########################
 */

/**
 * @param string $email
 * @return bool
 */
function isEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param string $password
 * @return bool
 */
function isPasswd(string $password): bool
{
    if (password_get_info($password)['algo']) {
        return true;
    }

    return mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN;
}

/**
 * @param string $password
 * @return string
 */
function passwd(string $password): string
{
    return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTIONS);
}

/**
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwdVerify(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

/**
 * @param string $hash
 * @return bool
 */
function passwdRehash(string $hash): bool
{
    return password_needs_rehash($hash, CONF_PASSWD_ALGO, CONF_PASSWD_OPTIONS);
}

/**
 * @return string
 */
function csrfInput(): string
{
    session()->csrf();
    return "<input type='hidden' name='csrf' value='".session()->csrf."'/>";
}

/**
 * @param array $request
 * @return bool
 */
function csrfVerify(array $request): bool
{
    if (empty($request["csrf"]) || !session()->has("csrf") || ($request["csrf"] != session()->csrf)) {
        return false;
    }

    return true;
}

/**
 * ###################
 * ### URL HELPERS ###
 * ###################
 */

/**
 * @param string|null $path
 * @return string
 */
function url(string $path = null): string
{
    if (strpos($_SERVER["HTTP_HOST"], "localhost")) {
        if ($path) {
            return CONF_URL_TEST . "/" . ($path[0] == "/") ? mb_substr($path, 1) : $path;
        }

        return CONF_URL_TEST;
    }

    if ($path) {
        return CONF_URL_BASE . "/" . ($path[0] == "/") ? mb_substr($path, 1) : $path;
    }

    return CONF_URL_BASE;

}

/**
 * @param string|null $path
 * @return string
 */
function theme(string $path = null): string
{
    if (strpos($_SERVER["HTTP_HOST"], "localhost")) {
        if ($path) {

            return CONF_URL_TEST . "/themes/". CONF_VIEW_THEME . "/" . (($path[0] == "/") ? mb_substr($path, 1) : $path);
        }

        return CONF_URL_TEST . "/themes/". CONF_VIEW_THEME;
    }

    if ($path) {
        return CONF_URL_BASE . "/themes/". CONF_VIEW_THEME . "/" . (($path[0] == "/") ? mb_substr($path, 1) : $path);
    }

    return CONF_URL_BASE . "/themes/". CONF_VIEW_THEME;

}

/**
 * @param string $url
 */
function redirect(string $url): void
{
    header("HTTP/1.1 302 Redirect");

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    $location = url($url);
    header("Location: {$location}");
    exit;
}

/**
 * ######################
 * ### STRING HELPERS ###
 * ######################
 */


/**
 * @param string $string
 * @return string
 */
function strSlug(string $string): string
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';

    $slug = trim(strtr(utf8_decode($string), utf8_decode($formats), $replace));
    $slug = str_replace(' ', '-', $slug);
    $slug = str_replace(['-----', '----', '---', '--'], '-', $slug);

    return $slug;
}

/**
 * @param string $string
 * @return string
 */
function strStudlyCase(string $string): string
{
    $string = strSlug($string);
    $studlyCase = str_replace(
        " ",
        "",
        mb_convert_case(
            str_replace("-", " ", $string),
            MB_CASE_TITLE
        )
    );

    return $studlyCase;
}

/**
 * @param string $string
 * @return string
 */
function strCamelCase(string $string): string
{
    return lcfirst(strStudlyCase($string));
}

/**
 * @param string $string
 * @return string
 */
function strTitle(string $string)
{
    return mb_convert_case(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS), MB_CASE_TITLE);
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function strLimitWords(string $string, int $limit, string $pointer = "..."): string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    $arrWords = explode(" ", $string);
    $numWords = count($arrWords);

    if ($numWords < $limit) {
        return $string;
    }

    $words = implode(" ", array_slice($arrWords, 0, $limit));
    return "{$words}{$pointer}";
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function strLimitChars(string $string, int $limit, string $pointer = "...")
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));

    if (mb_strlen($string) <= $limit) {
        return $string;
    }

    $chars = mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $limit), " "));

    return "{$chars}{$pointer}";
}

/**
 * ######################
 * ### OBJECT HELPERS ###
 * ######################
 */

/**
 * @return PDO
 */
function db(): PDO
{
    return \Source\Core\Connect::getInstance();
}

/**
 * @return \Source\Core\Message
 */
function message(): \Source\Core\Message
{
    return new \Source\Core\Message();
}

/**
 * @return \Source\Core\Session
 */
function session(): \Source\Core\Session
{
    return new \Source\Core\Session();
}

/**
 * @return \Source\Models\User
 */
function user(): \Source\Models\User
{
    return new \Source\Models\User();
}

/**
 * ######################
 * #### DATE HELPERS ####
 * ######################
 */


/**
 * @param string $date
 * @param string $format
 * @return string
 * @throws Exception
 */
function dateFormat(string $date = "now", string $format = "d/m/Y H\hi"): string
{
    return (new DateTime($date))->format($format);
}

/**
 * @param string $date
 * @param string $format
 * @return string
 * @throws Exception
 */
function dateFormatBR(string $date = "now", string $format = CONF_DATE_BR): string
{
    return (new DateTime($date))->format($format);
}

/**
 * @param string $date
 * @param string $format
 * @return string
 * @throws Exception
 */
function dateFormatApp(string $date = "now", string $format = CONF_DATE_APP): string
{
    return (new DateTime($date))->format($format);
}
