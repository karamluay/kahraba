<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Read extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public $filtertype;

    protected $queryString = ['search'];

    protected $listeners = ['userDeleted'];

    public $sortType;
    public $sortColumn;

    public function userDeleted(){
        // Nothing ..
    }

    public function sort($column)
    {
        $sort = $this->sortType == 'desc' ? 'asc' : 'desc';

        $this->sortColumn = $column;
        $this->sortType = $sort;
    }

    public function render()
    {
        $data = User::query();

        if(config('easy_panel.crud.user.search')){
            $array = (array) config('easy_panel.crud.user.search');
            $data->where(function (Builder $query) use ($array){
                foreach ($array as $item) {
                    if(!is_array($item)) {
                        $query->orWhere($item, 'like', '%' . $this->search . '%');
                    } else {
                        $query->orWhereHas(array_key_first($item), function (Builder $query) use ($item) {
                            $query->where($item[array_key_first($item)], 'like', '%' . $this->search . '%');
                        });
                    }
                }
            });
        }
        if($this->filtertype){
            $data = $data->where("user_type",$this->filtertype);
        }

        if($this->sortColumn) {
            $data->orderBy($this->sortColumn, $this->sortType);
        } else {
            $data->latest('id');
        }

        $data = $data->paginate(config('easy_panel.pagination_count', 15));

        return view('livewire.admin.user.read', [
            'users' => $data
        ])->layout('admin::layouts.app', ['title' => __(\Str::plural('User')) ]);
    }
}
