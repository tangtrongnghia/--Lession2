<?php

if (!function_exists('json')) {
    function json($data = [], $code = 200)
    {
        http_response_code($code);
        echo json_encode($data);
        die();
    }
}

if (!function_exists('makeSafe')) {
    function makeSafe($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

if (!function_exists('back')) {
    function back()
    {
        if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        return header('location: /');
    }
}

if (!function_exists('pages')) {
    function pages($sumPage = 0, $page)
    {
        $html = '<ul class="pagination pagination-sm m-0 justify-content-center">';

        if ($page > 1) {
            $html .= '<li class="page-item"><a class="page-link" href="' . fillerQuery(['pages' => 1]) . '?page=1">First</a></li>';
            $html .= '<li class="page-item"><a class="page-link" href="' . fillerQuery(['pages' => $page - 1]) . '">Previous</a></li>';
        }

        $start  = $page > 2 ? ($page - 2) : 1;
        $end    = ($sumPage - $page) >= 2 ? ($page + 2) : $sumPage;

        for ($i = $start; $i <= $end; $i++) {
            $html .= '<li class="page-item"><a class="page-link" href="' . fillerQuery(['pages' => $i]) . '">' . $i . '</a></li>';
        }

        if ($sumPage > $page) {
            $html .= '<li class="page-item"><a class="page-link" href="' . fillerQuery(['pages' => $page + 1]) . '">Next</a></li>';
            $html .= '<li class="page-item"><a class="page-link" href="' . fillerQuery(['pages' => $sumPage]) . '">Last('.$sumPage.')</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }
}

function fillerQuery($query = [])
{
    if (count($query) == 0) return $_SERVER['REQUEST_URI'];

    $linkDefault = explode('?', $_SERVER['REQUEST_URI']);
    $link = $linkDefault[0];

    $queryDefault = $_GET;
    unset($queryDefault['qQuery']);

    $array = array_merge($queryDefault, $query);
    return $link . '?' . http_build_query($array);
}
