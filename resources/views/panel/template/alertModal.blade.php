
<style>
    #alertModalCenter{
        z-index: 9999;
        background: rgba(0,0,0,.5)
    }
    #alertModalCenter .modal-header{
        border: none;
    }
    #alertModalCenter .modal-title{
        position: relative;
        margin: 0 auto;
    }
    #alertModalCenter button.close{
        position: absolute;
        color: #fff;
        right: 1rem ;
        font-size: 24pt;
    }

    #alertModalCenter .modal-body{
        font-size: 11pt;
    }

</style>


<!-- Modal center alert -->
<div class="modal fade " id="alertModalCenter" tabindex="-1" role="dialog" aria-labelledby="alertModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-white">
            <div class="modal-header pb-2">
                <h5 class="modal-title" id="alertModalCenterTitle">¡Atención!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="contentAlertModal">
                </div>
            </div>
        </div>
    </div>
</div>
