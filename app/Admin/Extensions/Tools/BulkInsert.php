<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\AbstractTool;

class BulkInsert extends AbstractTool
{
    public function render()
    {
        return view('admin.bulkInsert');
    }
}