<?php

namespace App\Livewire;

use App\Models\Socio;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class ValidarSocio extends Component
{
    public $identificacion = '';

    protected $rules = [
        'identificacion' => 'required|numeric',
    ];

    public function validar()
    {
        $this->resetErrorBag();
        $this->validate();

        $socio = Socio::where('identificacion', $this->identificacion)->first();

        if (! $socio) {
            $this->addError(
                'identificacion',
                'El número de identificación ingresado no corresponde a un socio registrado en ACTORES.'
            );

            return;
        }

        // Guardar socio y convocatoria actual en sesión
        session([
            'socio_id' => $socio->id,
            'convocatoria_id' => 1, // Cambiar al ID de la convocatoria actual
        ]);

        return redirect()->route('inscripcion.etapa1');
    }

    public function render()
    {
        return view('livewire.validar-socio');
    }
}
