<!--- banner --->
@if( isset($bannersGeneral) && count($bannersGeneral) > 0 )
    <div class="contenido-completo">
        <section class="main-slider flechas-blancas flechas-dentro">
            @foreach($bannersGeneral AS $b)
                {{-- imagen --}}
                @if ( $b->idbanner_tipo == 1)
                    <div class="item image">

                        @if( $b->boton_link && !$b->boton_text )
                        <a href="{{ $b->boton_link }}" target="{{ $b->target }}">
                        @endif

                            <figure>
                                <div class="slide-image slide-media" style="background-image:url('{{ asset('panel/img/banner/'.$b->imagen_movil?: $b->imagen) }}');">
                                    <img class="image-entity hidden-xs" data-lazy="{{ asset('panel/img/banner/'.$b->imagen) }}">
                                </div>
                                <div class="titulo-banner">
                                    <article>
                                        @if(!empty($b->contenido))
                                            <div class="caption" >
                                                {!! html_entity_decode($b->contenido) !!}
                                            </div>
                                        @endif

                                        @if( $b->boton_text )
                                            <div class="btn-cotizar">
                                                <a href="{{ $b->boton_link }}" target="{{ $b->boton_target }}" class="fw-bold" tabindex="-1">
                                                    {{ $b->boton_text }}
                                                    <span class="bi bi-chevron-double-right"></span>
                                                </a>
                                            </div>
                                        @endif
                                    </article>
                                </div>
                            </figure>

                        @if( $b->boton_link && !$b->boton_text )
                        </a>
                        @endif
                    </div>
                @endif

                {{-- video --}}
                @if ( $b->idbanner_tipo == 2)
                    <div class="item video">
                        <video class="slide-video slide-media" loop muted preload="metadata" poster="{{ $b->imagen }}">
                            <source src="{{ asset('panel/img/banner/'.$b->video) }}" type="video/mp4" />
                        </video>
                    </div>

                @endif

                {{-- link --}}
                @if ( $b->idbanner_tipo == 3)
                    @if( stristr($b->video, 'https://www.youtube.com') !== false )
                        <div class="item youtube">
                            <iframe class="embed-player slide-media" width="980" height="520" src="{{ $b->video }}?autoplay=1" frameborder="0" allowfullscreen=""></iframe>
                        </div>
                    @elseif( stristr($b->video, 'https://player.vimeo.com') !== false )
                        <div class="item vimeo" data-video-start="4">
                            <iframe class="embed-player slide-media" src="{{ $b->video }}" width="980" height="520" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        </div>

                    @endif

                @endif



            @endforeach

            {{--<div class="item vimeo" data-video-start="4">
                <iframe class="embed-player slide-media" src="https://player.vimeo.com/video/134250658?api=1&byline=0&portrait=0&title=0&background=1&mute=0&loop=1&autoplay=0&id=134250658" width="980" height="520" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>

            <div class="item youtube">
                <iframe class="embed-player slide-media" width="980" height="520" src="https://www.youtube.com/embed/QV5EXOFcdrQ?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&autoplay=1&showinfo=0&loop=1&playlist=QV5EXOFcdrQ&start=1" frameborder="0" allowfullscreen=""></iframe>
            </div>

            <div class="item video">
                <video class="slide-video slide-media" loop muted preload="metadata" poster="https://drive.google.com/uc?export=view&id=0B_koKn2rKOkLSXZCakVGZWhOV00">
                  <source src="https://hrxtemplate.com/presta/v3_electronica_15/modules/tvcmsslider/views/img/demo_video_1.mp4" type="video/mp4" />
                </video>
            </div>

              <div class="item youtube">
                <iframe class="embed-player slide-media" width="980" height="520" src="https://www.youtube.com/embed/u9Mv98Gr5pY?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&autoplay=1&showinfo=0&loop=1&playlist=u9Mv98Gr5pY&start=1" frameborder="0" allowfullscreen="0" allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
              </div>--}}

        </section>
    </div>
@endif
<!--- banner --->
