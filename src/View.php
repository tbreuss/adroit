<?php

declare(strict_types=1);

namespace Tebe\Adr;

//use Tebe\Adr\Helper\Assert;

class View
{
    /**
     * @var array
     */
    private $helpers = [];

    /**
     * @var string
     */
    private $viewsPath;

    /**
     * View constructor.
     * @param string $viewsPath
     */
    public function __construct(string $viewsPath)
    {
        $this->setViewsPath($viewsPath);
    }

    /**
     * @param string $viewRoute
     * @param array $params
     * @return string
     */
    public function render(string $viewRoute, array $params = []): string
    {
        $viewPath = $this->resolvePath($viewRoute);
        extract($params);
        ob_start();
        require $viewPath;
        $html = ob_get_clean();
        return $html;
    }

    /**
     * @param string $viewRoute
     * @return string
     */
    private function resolvePath(string $viewRoute)
    {
        $viewPath = sprintf(
            '%s/%s.php',
            $this->viewsPath,
            $viewRoute
        );
        #Assert::isFile($viewPath, "View file '%s' does not exist");
        return $viewPath;
    }

    /**
     * @return string
     */
    public function getViewsPath(): string
    {
        return $this->viewsPath;
    }

    /**
     * @param string $viewsPath
     */
    private function setViewsPath(string $viewsPath)
    {
        #Assert::isDirectory($viewsPath, 'Views path "%s" does not exist');
        $this->viewsPath = $viewsPath;
    }

    /**
     * @param string $methodName
     * @param array $args
     * @return mixed
     */
    public function __call(string $methodName, array $args)
    {
        $helper = $this->loadViewHelper($methodName);
        $value = $helper->execute($args);
        return $value;
    }

    /**
     * @param string $helper
     * @return ViewHelper
     */
    private function loadViewHelper(string $helper)
    {
        $helperName = ucfirst($helper);
        if (!isset($this->helpers[$helper])) {
            $className = 'Tebe\\Adr\\ViewHelper\\' . $helperName . 'ViewHelper';
            $fileName  = __DIR__ . "/ViewHelper/{$helperName}ViewHelper.php";
            #Assert::isFile($fileName, "View helper %s does not exist");
            $this->helpers[$helper] = new $className();
        }
        return $this->helpers[$helper];
    }
}
