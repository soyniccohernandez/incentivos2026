<?php

namespace App\Livewire;

use App\Models\Proyecto;
use App\Models\Socio;
use App\Models\Director;
use App\Models\Aceptacion;
use App\Models\HistorialEtapa;
use App\Models\Etapa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class InscripcionEtapa1 extends Component
{
    use WithFileUploads;

    public Socio $socio;

    // Datos de la propuesta
    public $titulo;
    public $autoria = 'si';
    public $guionArchivo;

    // Director
    public $directorPropio = 'si';
    public $directorIdentificacion;
    public $directorNombre;
    public $directorCelular;
    public $directorCorreo;

    // Certificaciones y formato firmado
    public $certificaciones = [];
    public $formatoFirmado;

    // Aceptaciones legales
    public $aceptaTerminos = false;
    public $aceptaDatos = false;

    public function mount(): void
    {
        if (!session()->has('socio_id')) {
            redirect()->route('validar.socio')->send();
        }

        $this->socio = Socio::findOrFail(session('socio_id'));
    }

    /**
     * Validación en tiempo real sin conflictos de nombre
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->reglasValidacion(), $this->mensajesValidacion());
    }

    public function updatedDirectorPropio($value)
    {
        if ($value === 'si') {
            $this->reset(['directorIdentificacion', 'directorNombre', 'directorCelular', 'directorCorreo']);
        }
    }

    public function updatedAutoria($value)
    {
        if ($value === 'si') {
            $this->reset('guionArchivo');
        }
    }

    /**
     * Nombres de métodos cambiados para evitar error intelephense(P1038)
     */
    protected function reglasValidacion()
    {
        return [
            'titulo' => 'required|string|max:255',
            'autoria' => 'required|in:si,no',
            'guionArchivo' => 'required_if:autoria,no|nullable|file|max:10240',
            'directorPropio' => 'required|in:si,no',
            'directorIdentificacion' => 'required_if:directorPropio,no|nullable|string',
            'directorNombre'         => 'required_if:directorPropio,no|nullable|string',
            'directorCelular'        => 'required_if:directorPropio,no|nullable|string',
            'directorCorreo'         => 'required_if:directorPropio,no|nullable|email',
            'certificaciones'   => 'required|array|min:2',
            'certificaciones.0' => 'required|file|max:10240',
            'certificaciones.1' => 'required|file|max:10240',
            'formatoFirmado'    => 'required|file|max:10240',
            'aceptaTerminos'    => 'accepted',
            'aceptaDatos'       => 'accepted',
        ];
    }

    protected function mensajesValidacion()
    {
        return [
            'titulo.required'                    => 'El nombre de la propuesta es obligatorio.',
            'autoria.required'                   => 'Debes indicar si el guion es de tu autoría.',
            'guionArchivo.required_if'           => 'Debes subir la autorización del guion.',
            'directorPropio.required'            => 'Debes indicar si tú eres el director.',
            'directorIdentificacion.required_if' => 'La identificación del director es obligatoria.',
            'directorNombre.required_if'         => 'El nombre del director es obligatorio.',
            'directorCelular.required_if'        => 'El celular del director es obligatorio.',
            'directorCorreo.required_if'         => 'El correo del director es obligatorio.',
            'directorCorreo.email'               => 'Ingresa un correo electrónico válido.',
            'certificaciones.required'           => 'Debes cargar las certificaciones de experiencia.',
            'certificaciones.min'                => 'Debes cargar al menos 2 certificaciones.',
            'certificaciones.0.required'         => 'La primera certificación de experiencia es obligatoria.',
            'certificaciones.1.required'         => 'La segunda certificación de experiencia es obligatoria.',
            'formatoFirmado.required'            => 'Debes subir el formato firmado de declaraciones.',
            'aceptaTerminos.accepted'            => 'Debes aceptar los términos y condiciones.',
            'aceptaDatos.accepted'               => 'Debes autorizar el tratamiento de datos.',
            '*.max'                              => 'El archivo no debe pesar más de 10MB.',
            '*.file'                             => 'El campo debe ser un archivo válido.',
        ];
    }

    public function render()
    {
        return view('livewire.inscripcion-etapa1');
    }

    public function guardar()
    {
        $this->validate($this->reglasValidacion(), $this->mensajesValidacion());

        $convocatoria_id = session('convocatoria_id');

        // 1️⃣ Crear proyecto
        $proyecto = $this->socio->proyectos()->create([
            'convocatoria_id'   => $convocatoria_id,
            'titulo'            => $this->titulo,
            'estado_actual'     => 'pendiente',
            'etapa_actual'      => 'Inscripción Inicial',
            'fecha_postulacion' => now(),
        ]);

        // 2️⃣ Guardar director
        $proyecto->director()->create([
            'es_proponente'  => $this->directorPropio === 'si',
            'identificacion' => $this->directorPropio === 'si' ? $this->socio->identificacion : $this->directorIdentificacion,
            'nombre'         => $this->directorPropio === 'si' ? $this->socio->nombre : $this->directorNombre,
            'celular'        => $this->directorPropio === 'si' ? $this->socio->telefono : $this->directorCelular,
            'correo'         => $this->directorPropio === 'si' ? $this->socio->correo : $this->directorCorreo,
        ]);

        // 3️⃣ Guardar documentos (Usando disco 'public' explícitamente)

        // Guion (si no es autor)
        if ($this->guionArchivo && $this->autoria === 'no') {
            $path = $this->guionArchivo->store('documentos', 'public');
            $proyecto->documentos()->create([
                'tipo_documento_id' => 1,
                'ruta_archivo'      => $path,
                'estado'            => 'pendiente',
                'version'           => 1,
                'fecha_carga'       => now(),
            ]);
        }

        // Certificaciones
        foreach ($this->certificaciones as $i => $archivo) {
            if ($archivo) {
                $path = $archivo->store('documentos', 'public');
                $proyecto->documentos()->create([
                    'tipo_documento_id' => 2 + $i, // Ajuste de ID según el índice
                    'ruta_archivo'      => $path,
                    'estado'            => 'pendiente',
                    'version'           => 1,
                    'fecha_carga'       => now(),
                ]);
            }
        }

        // Formato Firmado
        if ($this->formatoFirmado) {
            $path = $this->formatoFirmado->store('documentos', 'public');
            $proyecto->documentos()->create([
                'tipo_documento_id' => 4,
                'ruta_archivo'      => $path,
                'estado'            => 'pendiente',
                'version'           => 1,
                'fecha_carga'       => now(),
            ]);
        }

        // 4️⃣ Aceptaciones legales
        $proyecto->aceptaciones()->createMany([
            ['tipo' => 'terminos', 'aceptado' => true, 'fecha_aceptacion' => now()],
            ['tipo' => 'datos_personales', 'aceptado' => true, 'fecha_aceptacion' => now()],
        ]);

        // 5️⃣ Historial de etapa
        $etapa = Etapa::where('convocatoria_id', $convocatoria_id)
            ->where('orden', 1)
            ->first();

        if ($etapa) {
            HistorialEtapa::create([
                'proyecto_id'  => $proyecto->id,
                'etapa_id'     => $etapa->id,
                'fecha_inicio' => now(),
                'observacion'  => 'Inicio de inscripción exitosa',
            ]);
        }

        // 6️⃣ Limpiar sesión y Redirigir
        session()->forget(['socio_id', 'convocatoria_id']);

        return redirect()->to('/')->with('success', '¡Inscripción realizada con éxito! Tu proyecto ha sido recibido correctamente. Te invitamos a estar atento a nuestras redes sociales y al sitio oficial para seguir el avance de tu postulación y conocer los siguientes pasos.');
    }
}
