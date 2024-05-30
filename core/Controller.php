<?php

namespace core;

class Controller {
    protected $template;
    protected $errorMessage;
    protected $rows;
    public $isPost = false;
    public $isGet = false;
    public $post;
    public $get;
    public function __construct()
    {
        $action = Core::get()->actionName;
        $module = Core::get()->moduleName;
        $path = "views/{$module}/{$action}.php";
        $this->template = new Template($path);
        switch($_SERVER["REQUEST_METHOD"]) {
            case 'POST': 
                $this->isPost = true;
                break;
            case 'GET':
                $this->isGet = true;
                break;
        }
        $this->post = new Post;
        $this->get = new Get;
        $this->errorMessage = [];
    }

    public function render($pathToView = null) : array
    {
        if(!empty($pathToView))
            $this->template->SetTemplateFilePath($pathToView);
        return [
            'Content' => $this->template->getHTML()
        ];
    }

    public function redirect($path) : void
    {
        header("Location: {$path}");
        die;
    }

    public function addErrorMessage($message = null) : void
    {
        $this->errorMessage[] = $message;
        $this->template->setParam('error_message', implode('<br/>', $this->errorMessage));
    }

    public function clearErrorMessage() : void
    {
        $this->errorMessage = [];
        $this->template->setParam('error_message', null);
    }

    public function isErrorMessageExists(): bool
    {
        return count($this->errorMessage) > 0;
    }

    public function addRows($message = null) : void
    {
        $this->rows[] = $message;
        $this->template->setParam('rows', $this->rows);
    }

    public function clearRows() : void
    {
        $this->rows = [];
        $this->template->setParam('rows', null);
    }

    public function isRows(): bool
    {
        return count($this->rows) > 0;
    }
}