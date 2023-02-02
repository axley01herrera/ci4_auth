<!--MODAL FADE-->
<div class="modal fade" id="modal-privacyPolicy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- MODAL HEADER -->
            <div class="modal-header">
                <!--MODAL TITLE-->
                <h5 class="modal-title" id="staticBackdropLabel"><?php echo lang('Modal.privaciPolicyTitle');?></h5>
                <button type="button" class="btn-close closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- MODAL BODY -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <p>
                            <?php echo lang('Modal.privaciPolicy');?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- MODAL FOOTER -->
            <div class="modal-footer mt-10">
                <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal"><?php echo lang('Button.close')?></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $('#modal-privacyPolicy').modal('show');

        $('.closeModal').on('click', function () {

            $('#modal-privacyPolicy').modal('hide');
            $('#main-modal').html('');
            
        });
    });
</script>