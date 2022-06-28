<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CustomerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Customer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Customer());
        $grid->column('reated_at', 'SignUp Date');
        $grid->column('firstname','Firstname');
        $grid->column('lastname','Lastname');
        $grid->column('personal_phone_one','Phone Number One');
        $grid->column('personal_phone_two','Phone Number Two');
        $grid->column('email','Customer Email');
        $grid->column('gender','Customer Gender');
        $grid->column('image','Customer profile');
        $grid->column('marital_status','Marital status');
        $grid->column('educational_level','Customer Education');
        $grid->column('address','Customer Address');
        $grid->column('region','Customer Region');
        $grid->column('city','Customer City');
        $grid->column('area','Customer Area');
        $grid->column('nearest_landmark','Customer Landmark');
        $grid->column('upload_card','Customer card');
        $grid->column('company_name','Company name');
        $grid->column('company_location','Company Location');
        $grid->column('company_landmark','Company Landmark');
        $grid->column('company_phone','Company Phone');
        $grid->column('job_position','Job Position');
        $grid->column('company_city','Company City');
        $grid->column('monthly_income','Monthly Income');
        $grid->column('company_designation','Company Designation');
        $grid->column('emergency_name','Emergency Name');
        $grid->column('emergency_phone','Emergency Phone');
        $grid->column('emergency_relationship','Emergency Relationship');
        $grid->column('wallet_network','Wallet network');
        $grid->column('wallet_holder_name','Wallet Holder Name');
        $grid->column('wallet_number','Wallet Number');
  //Disable Grid Create button
  $grid->disableCreateButton();
        
        
  $grid->filter(function ($filter) {
      $filter->between('created_at', 'Date')->datetime();
      $filter->like('customer.firstname');
      $filter->like('customer.lastname');
      // Remove the default xxid filter
      $filter->disableIdFilter();
  });



        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Customer::findOrFail($id));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Customer());
        $form->text('firstname','Firstname');
        $form->text('lastname','Lastname');
        $form->text('personal_phone_one','Phone Number One');
        $form->text('personal_phone_two','Phone Number Two');
        $form->text('email','Customer Email');
        $form->text('gender','Customer Gender');
        $form->text('dob','Date Of birth');
        $form->text('marital_status','Marital status');
        $form->text('educational_level','Customer Education');
        $form->text('address','Customer Address');
        $form->text('region','Customer Region');
        $form->text('city','Customer City');
        $form->text('area','Customer Area');
        $form->text('nearest_landmark','Customer Landmark');
        $form->text('upload_card','Customer card');
        $form->text('company_name','Company name');
        $form->text('company_location','Company Location');
        $form->text('company_landmark','Company Landmark');
        $form->text('company_phone','Company Phone');
        $form->text('job_position','Job Position');
        $form->text('company_city','Company City');
        $form->text('monthly_income','Monthly Income');
        $form->text('company_designation','Company Designation');
        $form->text('emergency_name','Emergency Name');
        $form->text('emaergency_phone','Emergency Phone');
        $form->text('emergency_relationship','Emergency Relationship');
        $form->text('wallet_network','Wallet network');
        $form->text('wallet_holder_name','Wallet Holder Name');
        $form->text('wallet_number','Wallet Number');


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
