<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;
use App\Helper\GlobalHelper;
use Auth;

class UserDataTable extends DataTable
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
        ->addColumn('action', function ($user) {
             $id = $user->id;

                    $edit = '<a class="label label-success" href="' . route('users.edit',$id) . '"  title="Update"><i class="fa fa-edit"></i>&nbsp</a>';


                    $delete = '<a class="label label-danger" href="javascript:;"  title="Delete" onclick="deleteConfirm('.$id.')"><i class="fa fa-trash"></i>&nbsp</a>';


                    $view = '<a class="label label-primary" href="'. route('users.show',$id).'"  title="View"><i class="fa fa-eye"></i>&nbsp</a>';

                    $verify =  '<a class="label label-success" href="javascript:;"  title="Become Reseller" onclick="verify('.$id.')"><i class="fa fa-cloud"></i>&nbsp</a>';

                // $chat = '<a class="label label-success" href="'. route('users.chat',$id).'"  title="Chat"><i class="fa fa-commenting-o"></i>&nbsp</a>';
               return  $verify.' ' .$view.' '.$edit.' '.$delete;
            })
        ->addColumn('status',  function($user) {
            $id = $user->id;
            $status = $user->user_status;
            $class='text-danger';
            $label='Deactive';
            if($status==1)
            {
                $class='text-green';
                $label='Active';
            }

                return  '<a class="'.$class.' actStatus" id = "user'.$id.'" data-sid="'.$id.'">'.$label.'</a>';

        })

        ->addColumn('role_id',  function($user) {
            $id = $user->id;
            $status = $user->role_id;
            $class='text-danger';
            $label='Not Reseller';
            if($status==3)
            {
                $class='text-green';
                $label='Reseller';
            }

                return  '<a class="'.$class.' Status" id = "user'.$id.'" data-sid="'.$id.'">'.$label.'</a>';

        })

        // ->addColumn('registeredUsing', function ($user) {
        //        if ($user->social_provider=='facebook'){
        //            return'<span class="text-primary">Facebook</span>';
        //        }elseif ($user->social_provider=='google') {
        //            return'<span class="text-red">Google</span>';
        //        } else{
        //            return'<span>Normal</span>';
        //        }
        //     })
        ->editColumn('created_at', function($user) {
            return GlobalHelper::getFormattedDate($user->created_at);
        })
        ->rawColumns(['status','role_id','action']);//->toJson();
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->select('id', 'name', 'email','user_mobile','social_provider', 'user_status', 'created_at', 'updated_at');
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
        return ['id', 'name', 'email','user_mobile','social_provider', 'user_status', 'created_at', 'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
