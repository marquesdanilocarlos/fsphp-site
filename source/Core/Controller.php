<?php


namespace Source\Core;


use Source\Support\Seo;

/**
 *
 */
class Controller
{
    /**
     * @var View
     */
    protected View $view;
    /**
     * @var Seo
     */
    protected Seo $seo;

    /**
     * @param null $pathToViews
     */
    public function __construct($pathToViews = null)
    {
       $this->view = new View($pathToViews);
       $this->seo = new Seo();
    }
}
