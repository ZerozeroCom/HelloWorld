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
            ->editColumn('noticode',function ($model){
                if($model->noticode == 0){
                    return "忽略:";
                }else{
                    return "通知:";
                }

                })
            ->editColumn('action',function ($model){
                $html= '<button  class="btn btn-danger deletesms" data-id="'.$model->smsid.'">刪除</button >';
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
                    ->dom("<'row'<'col'il><'col-2 my-auto'B><'col-6'p>>".
                    "<'row'<'col-sm-12'tr>>".
                    "<'row'<'col'il><'col-6'p>>")
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
            Column::make('sms_sendtime')->title('發送時間')->type('date')->width("125px"),
            Column::make('device.name')->title('裝置名稱')->width("135px"),
            Column::make('device.businesses')->title('商戶')->width("75px"),
            Column::make('device.number')->title('裝置號碼')->width("100px"),
            Column::make('send_number')->title('發送號碼')->width("100px"),
            Column::make('sms_content')->title('簡訊內容')->className('sms_content'),
            Column::make('noticode')->title('分類')->className('noticode')->width("35px"),
            Column::make('keyword')->title('關鍵字')->className('keyword')->width("50px"),
            new Column(['title' =>'操作',
            'data'=>'action',
            'searchable'=>'false',
            'orderable'=>false,
            'width'=>"65px"]),
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
