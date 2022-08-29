<?php

namespace Admin\Widgets;

use AdminTemplate;
use App\Models\UserApplication;
use App\Models\UserSupportsQuestion;
use SleepingOwl\Admin\Widgets\Widget;

class DashboardMap extends Widget {

    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml() {
        return view('admin::dashboard', [
            'user'                    => auth()->user(),
        ]);
    }

    /**
     * @return string|array
     */
    public function template() {
        return AdminTemplate::getViewPath('dashboard');
    }

    /**
     * @return string
     * https://sleepingowladmin.ru/docs/widgets
     */
    public function block() {
        $a   = 'block.top.column.left';
        $aa  = 'block.content.column.right';
        $aaa = 'block.footer';

        return 'block.content';
    }
}