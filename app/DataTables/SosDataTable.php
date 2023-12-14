<?php

namespace App\DataTables;

use App\Models\Sos;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SosDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($sos){
                return '<div class="hstack gap-2 flex-wrap">
                            <a href="javascript:void(0);" data-href="'.route('sos-list.edit',$sos).'" class="d-block mb-3 edit-model text-info fs-14 lh-1"><i class="ri-edit-line"></i> Edit</a>
                            <form method="post" action="'.route('sos-list.destroy',$sos).'" >
                                <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <input type="hidden" name="_method" value="delete" />
                                <a href="javascript:void(0);" class="d-block mb-3 delete-confirm text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i> Delete</a>
                            </form>
                        </div>';
            })
            ->editColumn('created_at',function ($sos){
                return $sos->created_at->diffForHumans();
            })
            ->editColumn('updated_at',function ($sos){
                return $sos->updated_at->diffForHumans();
            })
            ->editColumn('call', function ($sos) {
                if ($sos->call) {
                    // If 'call' is true, display a check icon
                    return 'YES';
                } else {
                    // If 'call' is false, display a time icon
                    return 'No';
                }
            })
            ->editColumn('message', function ($sos) {
                if ($sos->message) {
                    // If 'call' is true, display a check icon
                    return 'YES';;
                } else {
                    // If 'call' is false, display a time icon
                    return 'NO';
                }
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Sos $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('sos-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->responsive(true)
                    ->buttons([
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('phone_no'),
            Column::computed('call'),
            Column::computed('message'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Sos_' . date('YmdHis');
    }
}
