<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $modules;

    public function __construct()
    {
        // $this->modules = $this->modules();
    }

    protected function preparePaginationVue($element):\stdClass{
        return (object)[
            'currentPage' => $element->currentPage(),
            'previousPageUrl' => $element->previousPageUrl(),
            'nextPageUrl' => $element->nextPageUrl(),
            'hasPages' => $element->hasPages(),
            'onFirstPage' => $element->onFirstPage(),
            'hasMorePages' => $element->hasMorePages(),
            'firstItem' => $element->firstItem(),
            'lastItem' => $element->lastItem(),
            'count' => $element->count(),
            'total' => $element->total(),
            'next' =>  __('pagination.next'),
            'previous' =>  __('pagination.previous'),
        ];
    }

    public function modules(){
//        $modules = [
//            [
//                'href' => route('dashboard'),
//                'name' => 'dashboard',
//                'text' => __('Dashboard'),
//                'subNames' => ['dashboard.teams'],
//                'subLinks' => [
//                    [
//                        'href' => route('dashboard'),
//                        'name' => 'dashboard',
//                        'text' => __('List of registered users'),
//                    ],
//                    [
//                        'href' => route('dashboard.teams'),
//                        'name' => 'dashboard.teams',
//                        'text' => __('Teams'),
//                    ]
//                ],
//            ],
//            [
//                'href' => route('extensions.index'),
//                'name' => 'extensions.index',
//                'text' => __('Extensions'),
//                'subNames' => [],
//                'subLinks' => [],
//            ],
//        ];

        return Module::get()->map(function ($module) {
            return $module->navLinks();
        })->toArray();


    }
}
