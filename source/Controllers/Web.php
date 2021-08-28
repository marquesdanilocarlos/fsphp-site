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
        echo $this->view->render("home", [
            "title" => "CafeControl - Gerencie suas contas com o melhor café!"
        ]);
    }

    /**
     * @param array $data
     */
    public function error(array $data): void
    {
        echo $this->view->render("error", [
            "title" => "Ooops | {$data['errcode']}"
        ]);
    }
}