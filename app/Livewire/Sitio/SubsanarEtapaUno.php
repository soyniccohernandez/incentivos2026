<?php 

namespace App\Livewire\Sitio; 

use App\Models\Proyecto; 
use Livewire\Component; 
use Livewire\Attributes\Layout; 

#[Layout('layouts.guest')] 
class SubsanarEtapaUno extends Component 
{ 
    public $proyecto; 

    public function mount(Proyecto $proyecto) 
    { 
        if (session('socio_id') != $proyecto->socio_id) { 
            return redirect()->route('inscritos.publico')->with('error', 'Acceso denegado.'); 
        } 
        
        $this->proyecto = $proyecto->load(['documentos.tipoDocumento', 'estado', 'socio']); 
    } 

    public function render() 
    { 
        // Agrupamos por etapa (Etapa 2 arriba, Etapa 1 abajo)
        $documentosPorEtapa = $this->proyecto->documentos
            ->groupBy(function($doc) {
                return $doc->tipoDocumento->etapa_id;
            })
            ->sortKeysDesc();

        return view('livewire.sitio.subsanar-etapa-uno', [ 
            'documentosPorEtapa' => $documentosPorEtapa 
        ]); 
    } 
}