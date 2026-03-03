<?php

namespace App\Livewire\Admin\Socios;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rule;

class Index extends Component
{
    use WithPagination;

    // Propiedades para filtros y búsqueda
    public $search = '';
    public $filtroEstado = '';

    // Propiedades para el Formulario (CRUD)
    public $userId; 
    public $name, $email, $identificacion, $genero, $tipo_socio, $fecha_nacimiento, $direccion, $telefono, $estado;
    public $password;

    public $showingModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'filtroEstado' => ['except' => ''],
    ];

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFiltroEstado() { $this->resetPage(); }

    public function crearSocio()
    {
        $this->resetForm();
        $this->showingModal = true;
    }

    public function editarSocio(User $user)
    {
        $this->resetForm();
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->identificacion = $user->identificacion;
        $this->genero = $user->genero;
        $this->tipo_socio = $user->tipo_socio;
        $this->fecha_nacimiento = $user->fecha_nacimiento;
        $this->direccion = $user->direccion;
        $this->telefono = $user->telefono;
        $this->estado = $user->estado;

        $this->showingModal = true;
    }

    public function resetForm()
    {
        $this->reset(['userId', 'name', 'email', 'identificacion', 'genero', 'tipo_socio', 'fecha_nacimiento', 'direccion', 'telefono', 'estado', 'password']);
        $this->estado = 'Activo'; 
    }

    public function guardar()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->userId)],
            'identificacion' => ['required', Rule::unique('users', 'identificacion')->ignore($this->userId)],
            'tipo_socio' => 'required',
            'estado' => 'required',
            'telefono' => 'nullable',
            'direccion' => 'nullable',
            'genero' => 'nullable',
            'fecha_nacimiento' => 'nullable|date',
        ];

        if (!$this->userId) {
            $rules['password'] = 'required|min:6';
        } else {
            $rules['password'] = 'nullable|min:6';
        }

        $validatedData = $this->validate($rules);
        $user = $this->userId ? User::find($this->userId) : new User();
        
        // Asignación de datos
        $user->fill($validatedData);

        if ($this->password) {
            $user->password = bcrypt($this->password);
        }

        // Limpiar intentos de OTP si se está creando o activando
        if (!$this->userId) { $user->otp_requests = 0; }

        $user->save();

        $this->showingModal = false;
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => $this->userId ? 'Socio actualizado correctamente.' : 'Socio creado correctamente.'
        ]);
    }

    public function cambiarEstado($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->estado = ($user->estado === 'Activo') ? 'Inactivo' : 'Activo';
            $user->save();
            $this->dispatch('notify', ['type' => 'success', 'message' => 'Estado de ' . $user->name . ' actualizado.']);
        }
    }

    public function eliminarSocio($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            $this->dispatch('notify', ['type' => 'success', 'message' => 'Socio eliminado permanentemente.']);
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $socios = User::where('tipo_socio', '!=', 'Administrador')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('identificacion', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->filtroEstado, function ($query) {
                $query->where('estado', $this->filtroEstado);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.admin.socios.index', ['socios' => $socios]);
    }
}