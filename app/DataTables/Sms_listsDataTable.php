<?php

namespace App\DataTables;

use App\Models\Sms_list;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class Sms_listsDataTable extends DataTable
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
            ->editColumn('sms_sendtime',function ($model){
                $html= $model->sms_sendtime->format("Y/m/d H:i");
                return $html;
                })
            ->editColumn('action',function ($model){
                $html= '<button  class="btn btn-danger deletesms" data-id="'.$model->id.'">刪除</button >';
                return $html;
                })
            ;

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Sms_list $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sms_list $model)
    {
        return $model->newQuery()->with('device');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('sms_lists-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('plBrtip')
                    ->orderBy(0)->parameters([
                        'pageLength' => 100,
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
            Column::make('sms_sendtime')->title('簡訊發送時間')->type('date'),
            Column::make('device.name')->title('裝置名稱'),
            Column::make('device.note')->title('裝置備註'),
            Column::make('device.number')->title('裝置號碼'),
            Column::make('send_number')->title('簡訊發送號碼'),
            Column::make('sms_content')->title('簡訊內容'),
            Column::make('device.noti_keywords')->title('裝置通知關鍵字'),
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
        return 'Sms_lists_' . date('YmdHi');
    }
}
