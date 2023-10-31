<?php

namespace App\DataTables;

use App\HeaderFooterSettings;
use Yajra\DataTables\Services\DataTable;
use App\Helper\GlobalHelper;
use Auth;

class HeaderFooterSettingsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
        ->addColumn('action', function ($category) {
            $id = $category->id;
             
                   $edit = '<a class="label label-success" href="' . url('admin/header_footer/'.$id.'/edit') . '" title="Update"><i class="fa fa-edit"></i>&nbsp</a>';
              
               
                  
               
              
                   $view = '<a class="label label-primary"href="'. route('header_footer.show',$id).'"  title="View"><i class="fa fa-eye"></i>&nbsp</a>';
               
              
              return $view.' '.$edit;
           })
          
        ->editColumn('created_at', function($category) {
            return GlobalHelper::getFormattedDate($category->created_at);
        })
        ->rawColumns(['action']);//->toJson();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VehicleMake $model)
    {
        return $model->newQuery()->select('id', 'address', 'contact_number', 'created_at', 'updated_at');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                   ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'address',
            'contact_number',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'HeaderFooterSettings' . date('YmdHis');
    }
}
