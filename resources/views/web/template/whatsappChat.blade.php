@if( count($contactoRapidoGeneral) > 0 )

    <!-- chatbot whatsapp -->
    <div class="wa__btn_popup">
        <!-- <div class="wa__btn_popup_txt">¿Necesitas ayuda?<br><strong>Escríbenos</strong></div> -->
        <div class="wa__btn_popup_icon"></div>
    </div>
    <div class="wa__popup_chat_box">
        <div class="wa__popup_heading">
            <div class="wa__popup_title">Iniciar una conversación</div>
            <div class="wa__popup_intro">¡Hola! Haga clic en uno de nuestros miembros a continuación para chatear por <strong>WhatsApp</strong>
                <div id="\&quot;eJOY__extension_root\&quot;"></div>
            </div>
        </div>
        <div class="wa__popup_content wa__popup_content_left">
            <div class="wa__popup_notice">El equipo suele responder en minutos.</div>
            <div class="wa__popup_content_list">
                @foreach($contactoRapidoGeneral as $c)
                    <div class="wa__popup_content_item ">
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=51{{ $c->whatsapp }}&amp;text=¡Buen día!" class="wa__stt wa__stt_online">
                            <div class="wa__popup_avatar">
                                <div class="wa__cs_img_wrap" style="background: url('{{  asset($c->foto ? 'panel/img/asesores/'.$c->foto : 'web/imagenes/asesor-hombre.jpeg') }}') center center no-repeat; background-size: cover;"></div>
                            </div>
                            <div class="wa__popup_txt">
                                <div class="wa__member_name">{{ $c->nombres }}</div>
                                <div class="wa__member_duty">Asesor</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('js')
        <script type="module">
            (function($) {
                var wa_time_out, wa_time_in;
                $(document).ready(function() {
                    $(".wa__btn_popup").on("click", function() {
                        if ($(".wa__popup_chat_box").hasClass("wa__active")) {
                            $(".wa__popup_chat_box").removeClass("wa__active");
                            $(".wa__btn_popup").removeClass("wa__active");
                            clearTimeout(wa_time_in);
                            if ($(".wa__popup_chat_box").hasClass("wa__lauch")) {
                                wa_time_out = setTimeout(function() {
                                    $(".wa__popup_chat_box").removeClass("wa__pending");
                                    $(".wa__popup_chat_box").removeClass("wa__lauch");
                                }, 400);
                            }
                        } else {
                            $(".wa__popup_chat_box").addClass("wa__pending");
                            $(".wa__popup_chat_box").addClass("wa__active");
                            $(".wa__btn_popup").addClass("wa__active");
                            clearTimeout(wa_time_out);
                            if (!$(".wa__popup_chat_box").hasClass("wa__lauch")) {
                                wa_time_in = setTimeout(function() {
                                    $(".wa__popup_chat_box").addClass("wa__lauch");
                                }, 100);
                            }
                        }
                    });

                    function setCookie(cname, cvalue, exdays) {
                        var d = new Date();
                        d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
                        var expires = "expires=" + d.toUTCString();
                        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                    }

                    function getCookie(cname) {
                        var name = cname + "=";
                        var ca = document.cookie.split(";");
                        for (var i = 0; i < ca.length; i++) {
                            var c = ca[i];
                            while (c.charAt(0) == " ") {
                                c = c.substring(1);
                            }
                            if (c.indexOf(name) == 0) {
                                return c.substring(name.length, c.length);
                            }
                        }
                        return "";
                    }

                    $("#nta-wa-gdpr").change(function() {
                        if (this.checked) {
                            setCookie("nta-wa-gdpr", "accept", 30);
                            if (getCookie("nta-wa-gdpr") != "") {
                                $('.nta-wa-gdpr').hide(500);
                                $('.wa__popup_content_item').each(function(){
                                    $(this).removeClass('pointer-disable');
                                    $('.wa__popup_content_list').off('click');
                                })
                            }
                        }
                    });

                    if (getCookie("nta-wa-gdpr") != "") {
                        $('.wa__popup_content_list').off('click');
                    } else{
                        $('.wa__popup_content_list').click(function(){
                            $('.nta-wa-gdpr').delay(500).css({"background" : "red", "color" : "#fff"});
                        });
                    }
                });
            })(jQuery);
        </script>
    @endpush

@else

    <div class="wa__btn_popup">
        <a href="{{ route('web.asesor') }}">
            <div class="wa__btn_popup_icon"></div>

        </a>
    </div>

@endif
