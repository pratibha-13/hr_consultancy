<?php

namespace App\DataTables;

use App\HomePageSlider;
use Yajra\DataTables\Services\DataTable;
use App\Helper\GlobalHelper;
use Auth;

class HomePageSliderDataTable extends DataTable
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
        ->addColumn('action', function ($homePageSlider) {
             $id = $homePageSlider->home_page_slider_id;

                    $edit = '<a class="label label-success" href="' . route('homePageSlider.edit',$id) . '"  title="Update"><i class="fa fa-edit"></i>&nbsp</a>';

                    $delete = '<a class="label label-danger" href="javascript:;"  title="Delete" onclick="deleteConfirm('.$id.')"><i class="fa fa-trash"></i>&nbsp</a>';


                    $view = '<a class="label label-primary" href="'. route('homePageSlider.show',$id).'"  title="View"><i class="fa fa-eye"></i>&nbsp</a>';


               return $view.' '.$edit.' '.$delete;
            })
        ->addColumn('status',  function($homePageSlider) {
            $id = $homePageSlider->home_page_slider_id;
            $status = $homePageSlider->status;
            $class='text-danger';
            $label='Deactive';
            if($status==1)
            {
                $class='text-green';
                $label='Active';
            }

                return  '<a class="'.$class.' actStatus" id = "user'.$id.'" data-sid="'.$id.'">'.$label.'</a>';

        })

        ->editColumn('created_at', function($homePageSlider) {
            return GlobalHelper::getFormattedDate($homePageSlider->created_at);
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
        return $model->newQuery()->select('home_page_slider_id', 'title', 'short_description','image','status','created_at', 'updated_at');
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
        return ['home_page_slider_id', 'title', 'short_description','image','status','created_at', 'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'HomePageSlider' . date('YmdHis');
    }
}
