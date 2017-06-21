<?php

namespace Aichong;

use \Yaf\View_Interface;

/**
 * Class Twig
 *
 * @package Aichong
 */
class Twig implements View_Interface
{

    /**
     * @var \Twig_Loader_Filesystem
     */
    protected $loader;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var array
     */
    protected $variables = [];

    /**
     * @param string $templateDir
     * @param array  $options
     */
    public function __construct(string $templateDir, array $options = [])
    {
        $this->loader = new \Twig_Loader_Filesystem($templateDir);
        $this->twig = new \Twig_Environment($this->loader, $options);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->variables[$name]);
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function __set(string $name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->variables[$name];
    }

    /**
     * @param string $name
     */
    public function __unset(string $name)
    {
        unset($this->variables[$name]);
    }

    /**
     * Return twig instance
     *
     * @return \Twig_Environment
     */
    public function getTwig(): \Twig_Environment
    {
        return $this->twig;
    }

    /**
     * @param array|string $name
     * @param null         $value
     * @return $this
     */
    public function assign($name, $value = null)
    {
        $this->variables[$name] = $value;

        return $this;
    }

    /**
     * @param string $template
     * @param array  $variables
     * @return void
     */
    public function display($template, $variables = [])
    {
        echo $this->render($template, $variables);
    }

    /**
     * @return array
     */
    public function getScriptPath(): array
    {
        return $this->loader->getPaths();
    }

    /**
     * @param string $template
     * @param array  $variables
     * @return string
     */
    public function render($template, $variables = []): string
    {
        if (!empty($variables)) {

            $this->variables = array_merge($this->variables, $variables);
        }

        return $this->twig->loadTemplate($template)
                          ->render($this->variables);
    }

    /**
     * @param string $templateDir
     * @return void
     */
    public function setScriptPath($templateDir)
    {
        $this->loader->setPaths($templateDir);
    }
}