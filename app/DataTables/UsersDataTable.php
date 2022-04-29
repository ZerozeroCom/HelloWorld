<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('action',function ($model){
                $html= '<button class="btn btn-warning editac"   data-bs-toggle="modal" data-bs-target="#accModal" data-bs-whatever="'.$model->name.'" data-id="'.$model->id.'">編輯</button>&nbsp;
                        <button class="btn btn-danger deleteac" data-id="'.$model->id.'">刪除</button>';
                return $html;
                })->editColumn('updated_at',function ($model){
                    $html= $model->updated_at->format("Y/m/d H:i");
                    return $html;
                    });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->dom("<'row'<'col'il><'col-2 my-auto'B><'col-6'p>>".
                    "<'row'<'col-sm-12'tr>>".
                    "<'row'<'col'il><'col-6'p>>")
                    ->orderBy(0)->parameters([
                        'pageLength' => 50,
                        'language' => config('datatables.i18n.tw')
                    ]);
                    ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->width("40px"),
            Column::make('type')->title('管理者類型')->width("90px"),
            Column::make('name')->title('帳號名稱'),
            Column::make('email')->title('E-MAIL'),
            Column::make('updated_at')->title('最後登入時間')->type('date'),
            Column::make('ip_address')->title('最後登入IP'),
            Column::make('allow_group')->title('IP登入群組'),
            Column::make('logins')->title('登入次數'),
            new Column(['title' =>'操作',
                        'data'=>'action',
                        'searchable'=>'false',
                        'orderable'=>false,
                        'width'=>"128px"]),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHi');
    }
}
