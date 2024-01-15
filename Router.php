<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function checkRoutes()
    {
        
        // Protect routes
        $protectedRoutes = [];

        $auth = $_SESSION['login'] ?? null;

        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ( $fn ) {
            // Calls a functión when we dont now wich one
            call_user_func($fn, $this);
        } else {
            echo "Page not found";
        }
    }

    public function render($view, $data = [])
    {
        // Read what we pass to the view in $data
        foreach ($data as $key => $value) {
            $$key = $value;  // dinamic variable names
        }

        ob_start(); // temporally memory storage
        include_once __DIR__ . "/views/$view.php";
        $content = ob_get_clean(); // Get buffer data (the view) & clean buffer
        
        include_once __DIR__ . '/views/layout.php';
    }
}
