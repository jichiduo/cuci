<?php

use App\Models\AccCode;
use App\Models\AppGroup;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Validate;



new class extends Component {
    use Toast;
    use WithPagination;

    public string $search = '';

    public bool $myModal = false;

    public array $sortBy = ['column' => 'id', 'direction' => 'desc'];

    public AccCode $myaccCode; //new user

    #[Validate('required')]
    public string $uname = '';
    #[Validate('required|min:4')]
    public string $code = '';

    public $action = "new";
    

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-top');
    }
    //close Modal
    public function closeModal(): void
    {
        $this->reset();
        $this->resetPage();
        $this->myModal = false;
    }
    //select Item
    public function selectItem($id, $action)
    {
        if (auth()->user()->category != 'admin') {
            $this->error("This action is unauthorized.", position: 'toast-top');
            return;
        }
        
        $this->selectedItemID = $id;
        $this->action = $action;

        if ($action == 'new') {
            $this->myaccCode = new AccCode();
            $this->myModal = true;
        } elseif ($action == 'edit') {
            $this->myaccCode = AccCode::find($id);
            $this->uname = $this->myaccCode->name;
            $this->code = $this->myaccCode->code;
            $this->myModal = true;
        } elseif ($action == 'delete'){
                AccCode::destroy($id);
                $this->success("Data deleted.", position: 'toast-top');
                $this->reset();
                $this->resetPage();
        }
    }
    //save 
    public function save()
    {

        $validatedData = $this->validate();

        $this->myaccCode->name = $this->uname;
        $this->myaccCode->code = $this->code;
        $this->myaccCode->save();
        $this->success("Data saved.", position: 'toast-top');
        $this->reset();
        $this->resetPage();
        $this->myModal = false;
    }


    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'code', 'label' => 'Code', 'class' => 'w-24'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
        ];
    }

    // get all data from table
    public function allData(): LengthAwarePaginator
    {
         return AccCode::query()
            ->when($this->search, fn(Builder $q) => $q->where('name', 'like', "%$this->search%"))
            ->orderBy(...array_values($this->sortBy))
            ->paginate(10); 

    }


    public function with(): array
    {
 
        return [
            'allData' => $this->allData(),
            'headers' => $this->headers(),
        ];
    }
};
?>

<div>
    <!-- HEADER -->
    <x-header title="Account Code" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="New" class="btn-primary" wire:click="selectItem(0,'new')" />
        </x-slot:actions>
    </x-header>

    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$allData" :sort-by="$sortBy" with-pagination show-empty-text>
            @scope('actions', $user)
            <div class="w-48 flex justify-end">
                <x-button icon="o-pencil-square" wire:click="selectItem({{ $user['id'] }},'edit')"
                    class="btn-ghost btn-xs text-blue-500" tooltip="Edit" />
                <x-button icon="o-trash" wire:click="selectItem({{ $user['id'] }},'delete')"
                    wire:confirm="Are you sure?" spinner class="btn-ghost btn-xs text-red-500" tooltip="Delete" />
            </div>
            @endscope
        </x-table>
    </x-card>

    <!-- New/Edit user modal -->
    <x-modal wire:model="myModal" separator persistent>
        <div>
            <x-input label="Code" wire:model='code' clearable />
            <x-input label="Name" wire:model='uname' clearable />
        </div>


        <x-slot:actions>
            <x-button label="Save" wire:click="save" class="btn-primary" />
            <x-button label="Cancel" wire:click="closeModal" />

        </x-slot:actions>
    </x-modal>
</div>