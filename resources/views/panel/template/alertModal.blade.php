
<style>

    #alertErrorModalCenter .modal-header{
        border: none;
    }
    #alertErrorModalCenter .modal-title{
        position: relative;
        margin: 0 auto;
    }
    #alertErrorModalCenter button.close{
        position: absolute;
        color: #fff;
        right: 1rem ;
        font-size: 24pt;
    }

    #alertErrorModalCenter .modal-body{
        font-size: 11pt;
    }

</style>

<!-- Modal center alert error -->
<div class="modal fade" id="alertErrorModalCenter" tabindex="-1" role="dialog" aria-labelledby="alertErrorModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="bg-danger text-white modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title" id="alertErrorModalCenterTitle">¡Atención!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <h5 class="titleAlertModal"></h5>
                <div class="contentAlertModal">
                </div>
            </div>
        </div>
    </div>
</div>
