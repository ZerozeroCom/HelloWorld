<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;

class UserTableController extends Controller
{
    public function datatable(UsersDataTable $dataTable){
           return $dataTable->render('layouts.userstable');}
}
