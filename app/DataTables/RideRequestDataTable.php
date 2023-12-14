<?php

namespace App\DataTables;

use App\Models\RideRequest;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RideRequestDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($rideRequest){
                return '<div class="flex-wrap">
                            <a href="'.route('ride-requests.show',$rideRequest).'" class="d-block mb-3 text-primary fs-14 lh-1"><i class="ri-eye-2-line"></i> View</a>
                            <a href="javascript:void(0);" data-href="'.route('ride-requests.edit',$rideRequest).'" class="d-block mb-3 edit-model text-info fs-14 lh-1"><i class="ri-edit-line"></i> Edit</a>
                            <form method="post" action="'.route('ride-requests.destroy',$rideRequest).'" >
                                <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <input type="hidden" name="_method" value="delete" />
                                <a href="javascript:void(0);" class="d-block mb-3 delete-confirm text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i> Delete</a>
                            </form>
                        </div>';
            })
            ->editColumn('created_at',function ($rideRequest){
                return $rideRequest->created_at->diffForHumans();
            })
            ->editColumn('updated_at',function ($rideRequest){
                return $rideRequest->updated_at->diffForHumans();
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RideRequest $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('riderequest-table')
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
            Column::make('source'),
            Column::make('source_lat'),
            Column::make('source_long'),
            Column::make('destination'),
            Column::make('destination_lat'),
            Column::make('destination_long'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'RideRequest_' . date('YmdHis');
    }
}
