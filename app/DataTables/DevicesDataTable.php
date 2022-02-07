<?php

namespace App\DataTables;

use App\Models\Device;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DevicesDataTable extends DataTable
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
                $html= '<button class="btn btn-warning editdev"   data-bs-toggle="modal" data-bs-target="#devModal"  data-bs-whatever="'.$model->UID.'" data-id="'.$model->id.'">編輯</button>&nbsp;
                        <button class="btn btn-danger deletedev" data-id="'.$model->id.'">刪除</button>';
                return $html;
                });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Device $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Device $model)
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
                    ->setTableId('devices-table')
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
            Column::make('name')->title('裝置名稱'),
            Column::make('number')->title('裝置號碼'),
            Column::make('UID')->title('裝置UID'),
            Column::make('note')->title('裝置備註'),
            Column::make('noti_keywords')->title('通知關鍵字'),
            Column::make('unnoti_keywords')->title('不通知關鍵字'),
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
        return 'Devices_' . date('YmdHis');
    }
}
