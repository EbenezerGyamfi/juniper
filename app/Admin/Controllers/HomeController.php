<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use App\Models\Request;
use Encore\Admin\Grid;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $grid = new Grid(new Request());

      
        $grid->column('created_at', 'Request Date');
        $grid->column('customer.firstname','Firstname');
        $grid->column('customer.lastname','Lastname');
        $grid->column('request_amount');
        $grid->column('customer.temporal_image','Profile');
        
        

        $grid->status()->display(function ($status) {
           return "<button class='btn btn-danger btn-sm' disable>$status</button>";
        }); 
        $grid->model()->where('status', '=', 'pending');
        // $grid->column('status')->editable('select', [1 => 'pending', 2 => 'approved', 3 => 'reject']);

        $grid->disableCreateButton();
        $grid->disableColumnSelector();
        $grid->disablePagination();
        $grid->disableCreateButton();
        $grid->disableExport();
        // $grid->disableFilter();
        $grid->disableActions();

        $grid->disableExport();

        $grid->filter(function ($filter) {
            $filter->between('created_at', 'Date')->datetime();
            $filter->like('customer.firstname');
            $filter->like('status');
            $filter->like('customer.lastname');
            $filter->between('request_amount', 'Amount Requested');
            // Remove the default xxid filter
            $filter->disableIdFilter();
            
        });


        return $content
            ->body($grid);
    }
}
