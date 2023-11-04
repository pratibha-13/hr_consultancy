<?php

namespace App\DataTables;

use App\OurClientSay;
use Yajra\DataTables\Services\DataTable;
use App\Helper\GlobalHelper;
use Auth;

class OurClientSayDataTable extends DataTable
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
        ->addColumn('action', function ($ourClientSay) {
             $id = $ourClientSay->our_client_say_id;

                    // $edit = '<a class="label label-success" href="' . route('ourClientSay.edit',$id) . '"  title="Update"><i class="fa fa-edit"></i>&nbsp</a>';

                    $delete = '<a class="label label-danger" href="javascript:;"  title="Delete" onclick="deleteConfirm('.$id.')"><i class="fa fa-trash"></i>&nbsp</a>';


                    $view = '<a class="label label-primary" href="'. route('ourClientSay.show',$id).'"  title="View"><i class="fa fa-eye"></i>&nbsp</a>';


               return $view.' '.$delete;
            })
        ->addColumn('status',  function($ourClientSay) {
            $id = $ourClientSay->our_client_say_id;
            $status = $ourClientSay->status;
            $class='text-danger';
            $label='Deactive';
            if($status==1)
            {
                $class='text-green';
                $label='Active';
            }

                return  '<a class="'.$class.' actStatus" id = "user'.$id.'" data-sid="'.$id.'">'.$label.'</a>';

        })

        ->editColumn('created_at', function($ourClientSay) {
            return GlobalHelper::getFormattedDate($ourClientSay->created_at);
        })
        ->rawColumns(['status','action']);//->toJson();
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()->select('our_client_say_id', 'our_client_say_name', 'profession', 'our_client_say_description','our_client_say_profile','status','created_at', 'updated_at');
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
        return ['our_client_say_id', 'our_client_say_name', 'profession', 'our_client_say_description','our_client_say_profile','status','created_at', 'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'OurClientSay_' . date('YmdHis');
    }
}
