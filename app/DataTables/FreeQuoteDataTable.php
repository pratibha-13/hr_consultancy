<?php

namespace App\DataTables;

use App\FreeQuote;
use Yajra\DataTables\Services\DataTable;
use App\Helper\GlobalHelper;
use Auth;

class FreeQuoteDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        //dd($query);
        return datatables($query)
        // ->addColumn('action', function ($freeQuote) {
        //      $id = $freeQuote->free_quote_id ;
        //             $view = '<a class="label label-primary" href="'. route('ourTeam.show',$id).'"  title="View"><i class="fa fa-eye"></i>&nbsp</a>';
        //        return $view.' '. $edit .' '.$delete;
        //     })
        ->addColumn('status',  function($freeQuote) {
            $id = $freeQuote->free_quote_id ;
            $status = $freeQuote->status;
            $class='text-danger';
            $label='Deactive';
            if($status==1)
            {
                $class='text-green';
                $label='Active';
            }

                return  '<a class="'.$class.' actStatus" id = "user'.$id.'" data-sid="'.$id.'">'.$label.'</a>';

        })

        ->editColumn('created_at', function($ourTeam) {
            return GlobalHelper::getFormattedDate($ourTeam->created_at);
        })
        ->rawColumns(['status']);//->toJson();
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()->select('free_quote_id ','status','created_at', 'updated_at');
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
        return ['free_quote_id ','status','created_at', 'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'freeQuote' . date('YmdHis');
    }
}
