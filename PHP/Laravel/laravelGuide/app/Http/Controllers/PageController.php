<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $pages = [
        [
            "name" => "dependencies",
            "content" => "",
        ],
        [
            "name" => "installations",
            "content" => "",
        ],
        [
            "name" => "virtualHosts",
            "content" => "",
        ],
        [
            "name" => "database",
            "content" => "",
        ],
        [
            "name" => "paths",
            "content" => "",
        ],
        [
            "name" => "routes",
            "content" => "",
        ],
        [
            "name" => "views",
            "content" => "",
        ],
    ];

    public function page()
    {
        $content = $this->pages;
        $title = 'Laravel Guide';
        return view('page', compact('title','content'));
    }

    public function dependencies(){return view('dependencies');}

    public function project(){return view('project');}

    public function controller(){return view('controller');}

    public function views(){return view('views');}

    public function bladeTemplates(){return view('bladeTemplates');}

    public function paths(){return view('paths');}

    public function routes(){return view('routes');}
    
}
