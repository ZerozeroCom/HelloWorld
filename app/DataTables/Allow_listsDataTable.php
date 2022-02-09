<?php

namespace App\DataTables;

use App\Models\Allow_list;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class Allow_listsDataTable extends DataTable
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
                $html= '<button class="btn btn-warning edital"  data-bs-toggle="modal" data-bs-target="#alModal" data-bs-whatever="'.$model->allow_ip_addr.'" data-bs-name="'.$model->allow_group.'" data-id="'.$model->id.'">編輯</button>&nbsp;
                        <button class="btn btn-danger deleteal" data-id="'.$model->id.'">刪除</button>';
                return $html;
                });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Allow_list $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Allow_list $model)
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
                    ->setTableId('allow_lists-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('plBrtip')
                    ->orderBy(0)->parameters([
                        'pageLength' => 10,
                        'language' => config('datatables.i18n.tw')
                    ])
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
            Column::make('id'),
            Column::make('allow_group')->title('群組名稱'),
            Column::make('allow_ip_addr')->title('IP位址'),
            new Column(['title' =>'操作',
                        'data'=>'action',
                        'searchable'=>'false',
                        'orderable'=>false]),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Allow_lists_' . date('YmdHis');
    }
}
