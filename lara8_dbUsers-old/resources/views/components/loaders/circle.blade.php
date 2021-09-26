{{--
* Componente para crear el efecto que esta cargando
* ej: <x-loaders.circle size="20px"></x-loaders.circle>
* @param $size=20px
* @author AlexP    
--}}
<span class="waiting">
    <div style="width: {{$size}}; height: {{$size}}; margin: 3px;">
        <div class="loader-container">
            <div class="loader"></div>
            <div class="loader2"></div>
        </div>
    </div>
</span>