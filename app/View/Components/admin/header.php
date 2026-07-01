<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $title;
    public $breadcrumb;
    public $msg;

    public function __construct(
        $title = 'Dashboard',
        $breadcrumb = 'Dashboard',
        $msg = 'Welcome back Admin'
    )
    {
        $this->title = $title;
        $this->breadcrumb = $breadcrumb;
        $this->msg = $msg;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.header');
    }
}