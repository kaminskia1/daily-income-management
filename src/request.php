<?php


if ( !defined("ENABLE") || @ENABLE != true )
{
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

class Request
{
    /**
     * Create a temporary instance from a static deceleration
     *
     * @return self
     */
    static public function i(): self
    {
        return new self();
    }

    /**
     * Set a cookie
     *
     * @param string $name
     * @param string|int $val
     * @param $duration = 604800
     * @return bool
     */
    static public function setCookie( string $name, $val, $duration = 604800 ): bool
    {
        return (bool) \setcookie($name, $val, time() + $duration );
    }

    /**
     * Return and filter the requested parameter
     *
     * @param $param
     * @return mixed|null
     */
    public function __get( string $param )
    {
        // Check if requested parameter is present; sanitize and return if so.
        return isset( array_merge($_REQUEST, $_COOKIE)[$param] ) ? preg_replace( "/[^A-Za-z0-9_]/", "", filter_var( array_merge($_REQUEST, $_COOKIE)[$param], FILTER_SANITIZE_STRING ) ) : null;
    }

    /**
     * Check if incoming call is ajax or not
     *
     * @return bool
     */
    public function isAjax(): bool
    {
        // Check that request is POST and requestmethod is xmlhttprequest
        return ( $_SERVER['REQUEST_METHOD'] == "POST" && !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) );
    }

    /**
     * Check if request method is equal to provided one
     *
     * @param string $type
     * @return bool
     */
    public function is( string $type )
    {
        return $_SERVER['REQUEST_METHOD']  == $type;
    }

    public function raw( string $param )
    {
        return isset( array_merge($_REQUEST, $_COOKIE)[$param] ) ? array_merge($_REQUEST, $_COOKIE)[$param] : null;
    }

}