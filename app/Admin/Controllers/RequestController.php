<?php

namespace App\Admin\Controllers;

use App\Models\Request;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RequestController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Request';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
       $grid = new Grid(new Request()); 
        //Display Content for all request
        $grid->column('created_at', 'Request Date');
        $grid->column('customer.firstname','Firstname');
        $grid->column('fee.service_fee','Service Fee');
        $grid->column('fee.interest','Interest Fee');
        $grid->column('fee.due_days','Due Days');
        $grid->column('customer.lastname','Lastname');
        $grid->column('customer.personal_phone_one','Phone Number One');
        $grid->column('customer.personal_phone_two','Phone Number Two');
        $grid->column('customer.email','Customer Email');
        $grid->column('customer.gender','Customer Gender');
        $grid->column('customer.image','Customer profile');
        $grid->column('customer.marital_status','Marital status');
        $grid->column('customer.educational_level','Customer Education');
        $grid->column('customer.address','Customer Address');
        $grid->column('customer.region','Customer Region');
        $grid->column('customer.city','Customer City');
        $grid->column('customer.area','Customer Area');
        $grid->column('customer.nearest_landmark','Customer Landmark');
        $grid->column('customer.upload_card','Customer card');
        $grid->column('customer.company_name','Company name');
        $grid->column('customer.company_location','Company Location');
        $grid->column('customer.company_landmark','Company Landmark');
        $grid->column('customer.company_phone','Company Phone');
        $grid->column('customer.job_position','Job Position');
        $grid->column('customer.company_city','Company City');
        $grid->column('customer.monthly_income','Monthly Income');
        $grid->column('customer.company_designation','Company Designation');
        $grid->column('customer.emergency_name','Emergency Name');
        $grid->column('customer.emergency_phone','Emergency Phone');
        $grid->column('customer.emergency_relationship','Emergency Relationship');
        $grid->column('customer.wallet_network','Wallet network');
        $grid->column('customer.wallet_holder_name','Wallet Holder Name');
        $grid->column('customer.wallet_number','Wallet Number');
        $grid->column('request_amount');
        $grid->column('customer.temporal_image','Profile');
        // $grid->column('status','Request Status');
   
        $grid->column('status', 'Request Status')->display(function ($status) {
            return "<span class='label label-danger'>{$status}</span>";
        });


        //To Edit Status
        // $grid->status()->display(function ($status) {
        //    return "<button class='btn btn-danger btn-sm' disable>$status</button>";
        // }); 

        // $grid->column('status')->editable('select', [1 => 'pending', 2 => 'approved', 3 => 'reject']);
        

        //Disable Grid Create button
        $grid->disableCreateButton();
        
        
        //filtering 
        $grid->model()->where('status', '=', 'pending');
        $grid->filter(function ($filter) {
            $filter->between('created_at', 'Date')->datetime();
            $filter->like('customer.firstname');
            $filter->like('status');
            $filter->like('customer.lastname');
            $filter->between('request_amount', 'Amount Requested');
            // Remove the default xxid filter
            $filter->disableIdFilter();
        });


        return $grid;
    }

    public function make(Content $content)
    {
        $grid = new Grid(new Request());

        $grid->column('created_at', 'Request Date');
        $grid->column('customer.firstname','Firstname');
        $grid->column('customer.lastname','Lastname');
        $grid->column('request_amount');
        $grid->column('due_days','Due Date'); //repayment date
        $grid->column('customer.temporal_image','Profile');
        // $grid->column('status','Request Status');
        
        $grid->column('status', 'Loan Status')->display(function ($status) {
            return "<span class='label label-success'>{$status}</span>";
        });
        //All Pending Loans
       
        $grid->model()->where('status', '!=', 'pending');

        //disable Buttons
        $grid->disableCreateButton();
        $grid->disableActions();
       

        $grid->filter(function ($filter) {
            $filter->between('created_at', 'Date')->datetime();
            $filter->like('customer.firstname');
            $filter->like('status');
            $filter->like('customer.lastname');
            $filter->between('request_amount', 'Amount Requested');
            // Remove the default xxid filter
            $filter->disableIdFilter();
        });
        return $content->body($grid);
        
        // return $content->header('All Approved Loans')->body( $grid->column('status'));

    }

    public function fee(Content $content)
    {
        $grid = new Grid(new Request());

    $grid->column('interest');
    
    $grid->column('service_fee');
        

        // $grid->status()->display(function ($status) {
        //    return "<button class='btn btn-success btn-sm' disable>$status</button>";
        // }); 
        // $grid->model()->where('status', '!=', 'pending');
        // $grid->model()->where('status', '=', 'pending');
        $grid->disableColumnSelector();
        $grid->disablePagination();
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableFilter();
        $grid->disableExport();

        // $grid->filter(function ($filter) {
        //     $filter->between('created_at', 'Date')->datetime();
        //     $filter->like('customer.firstname');
        //     $filter->like('status');
        //     $filter->like('customer.lastname');
        //     $filter->between('request_amount', 'Amount Requested');
        //     // Remove the default xxid filter
        //     $filter->disableIdFilter();
        // });
        
        return $content->body($grid);
        
        // return $content->header('All Approved Loans')->body( $grid->column('status'));

    }


    public function create(Content $content)
    {
        $grid = new Grid(new Request());

    $grid->column('interest');
        return $content->body($grid);
        

    }
    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Request::findOrFail($id));

        return $show;
    }

    // public function prof($id){
    //     $show = new Show(Request::findOrFail($id));
    //     return $show;
    // }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Request());

        $form->column(1 / 2, function ($form) {
            $form->image('customer.permanent_image', __('Previous Image'))->disable();
            $status = [
                'pending'  => 'pending',
                'approved' => 'approved',
            ];
            
            $form->select('status', 'Status')->options($status);
            $form->text('request_amount', 'Request Amount');
            $form->date('created_at', 'Request Date');
        });


        $form->column(1 / 2, function ($form) {
            $form->image('customer.temporal_image', __('Current Image'))->disable();
            $form->text('created_at', 'Request Date');
            $form->text('customer.firstname','Firstname');
            $form->text('customer.lastname','Lastname');
            $form->text('customer.personal_phone_one','Phone Number One');
            $form->text('customer.personal_phone_two','Phone Number Two');
            $form->text('customer.email','Customer Email');
            $form->text('customer.gender','Customer Gender');
            $form->text('customer.dob','Date Of birth');
            $form->text('customer.marital_status','Marital status');
            $form->text('customer.educational_level','Customer Education');
            $form->text('customer.address','Customer Address');
            $form->text('customer.region','Customer Region');
            $form->text('customer.city','Customer City');
            $form->text('customer.area','Customer Area');
            $form->text('customer.nearest_landmark','Customer Landmark');
            $form->text('customer.upload_card','Customer card');
            $form->text('customer.company_name','Company name');
            $form->text('customer.company_location','Company Location');
            $form->text('customer.company_landmark','Company Landmark');
            $form->text('customer.company_phone','Company Phone');
            $form->text('customer.job_position','Job Position');
            $form->text('customer.company_city','Company City');
            $form->text('customer.monthly_income','Monthly Income');
            $form->text('customer.company_designation','Company Designation');
            $form->text('customer.emergency_name','Emergency Name');
            $form->text('customer.emaergency_phone','Emergency Phone');
            $form->text('customer.emergency_relationship','Emergency Relationship');
            $form->text('customer.wallet_network','Wallet network');
            $form->text('customer.wallet_holder_name','Wallet Holder Name');
            $form->text('customer.wallet_number','Wallet Number');
            $form->image('customer.temporal_image','Profile');
    
        });


        // $grid = new Grid(new Request());

        // $grid->column('created_at', 'Request Date');
        // $grid->column('customer.firstname');
        // $grid->column('customer.lastname');
        $form->footer(function ($footer) {

            // disable reset btn
            // $footer->disableReset();
        
            // disable submit btn
            // $footer->disableSubmit();
        
            // disable `View` checkbox
            $footer->disableViewCheck();
        
            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();
        
            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        
        });

        return $form;
        
    }


  
}
