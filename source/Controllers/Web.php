<?php

namespace Source\Controllers;

use Source\Core\Controller;

/**
 * Web Controller
 */
class Web extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");
    }

    /**
     *
     */
    public function home(): void
    {
        echo "<h1>Home</h1>";
    }

    /**
     * @param array $data
     */
    public function error(array $data): void
    {
        echo "<h1>Error</h1>";
        var_dump($data);
    }
}