@extends('panel.template.index')
@push('css')
@endpush
@section('cuerpo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0">Editar matrícula</p>
                    </div>
                    <div class="card-body">
                        <div id="instanceVue">
                            <matricula-form
                                type="editar"
                                :matricula_id="{{ $matriculaID }}"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
    </script>
@endpush
