<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Denomination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads; //trait para subir imagenes al backend
use Livewire\WithPagination;

class CoinsController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $type, $value, $search, $image, $selected_id, $pageTittle, $componentName;
    private $pagination = 5;

    public function mount()
    {
        $this->pageTittle = 'Listado';
        $this->componentName = 'Denominaciones';
        $this->type = 'Elegir';
    }
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if (strlen($this->search) > 0)
            $data = Denomination::where('type', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $data = Denomination::orderBy('id', 'desc')->paginate($this->pagination);

        return view('livewire.denominations.component', ['data' => $data])
            ->extends('layouts.theme.app')
            ->section('content');
    }


    public function Edit($id)
    {
        $record = Denomination::find($id, ['id', 'type', 'value', 'image']);
        $this->name = $record->type;
        $this->value = $record->value;
        $this->selected_id = $record->id;
        $this->image = null;

        $this->emit('show-modal', 'show modal!');
    }

    public function Store()
    {
        $rules = [
            'type' => 'required|not_in:Elegir',
            'value' => 'required|unique:denominations'
        ];

        $messages = [
            'type.required' => 'El tipo es requerido',
            'type.not_in' => 'Elige un valor para el tipo distinto a elegir',
            'value.required' => 'El valor es requerido',
            'value.unique' => 'Ya existe el valor',
        ];
        $this->validate($rules, $messages);

        $denomination = Denomination::create([
            'type' => $this->type,
            'value' => $this->value

        ]);
        if ($this->image) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/denominations', $customFileName);
            $denomination->image = $customFileName;
            $denomination->save();
        }
        $this->resetUI();
        $this->emit('item-added', 'Denominacion Registrada');
    }

    public function resetUI()
    {
        $this->type = '';
        $this->value = '';
        $this->image = null;
        $this->search = '';
        $this->selected_id = 0;
    }



    public function Update()
    {
        $rules = [
            'tyype' => 'required|not_in:Elegir',
            'value' => 'required|unique:denominations,value,($this->selected_id)'

        ];
        $messages = [
            'type.required' => 'El tipo es requerido',
            'type.not_in' => 'Elige un valor para el tipo distinto a elegir',
            'value.required' => 'El valor es requerido',
            'value.unique' => 'Ya existe el valor',
        ];

        $this->validate($rules, $messages);

        $denomination = Denomination::find($this->selected_id);
        $denomination->update([
            'type' => $this->type,
            'value' => $this->value,
        ]);

        if ($this->image) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/denominations', $customFileName);
            $imageName = $denomination->image;
            $denomination->image = $customFileName;
            $denomination->save();

            if ($imageName != null) {
                if (file_exists('storage/denominations' . $imageName)) {
                    unlink('storage/denominations' . $imageName);
                }
            }
        }

        $this->resetUI();
        $this->emit('item-updated', 'Denominacion Actualizada');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Denomination $denomination)
    {
        //  $category = Category::find($id);

        $imageName = $denomination->image; //image temporal
        $denomination->delete();

        if ($imageName != null) {
            unlink('storage/denominations/' . $imageName);
        }

        $this->resetUI();
        $this->emit('item-deleted', 'Denominacion Eliminada');
    }


 
}
