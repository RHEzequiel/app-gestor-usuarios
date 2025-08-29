<style>
@media (min-width: 640px) {
    .sm\:pt-0 {
        padding-top: 30px;
    }
}
</style>
<img src="{{ asset('logo_utn.png') }}?v={{ time() }}" alt="Logo UTN" style="width: 140px; height: 140px; object-fit: contain; display: block !important;" {{ $attributes->merge(['class' => 'object-contain sm:pt-0']) }} />
