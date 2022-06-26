    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>portal/admin_logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="viewFeedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModal">-</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">-</div>
                <div class="modal-footer">
                    <a class="btn btn-info attachfile" href="" target="_blank" type="button">Download Attachment</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="sendMessageModal" tabindex="-1" role="dialog" aria-labelledby="messageModal"
        aria-hidden="true">
        <form name="sendmessageadmin">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModal">Send a Message to Admin</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Message</label>
                    <textarea class="form-control supervisor_msg_content" name="message" required></textarea>
                    <input type="hidden" value="<?php echo $this->session->userdata('admin_user_id'); ?>" name="supervisor_id" class="supervisor_msg_id" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary sendmessagebtn" type="button">Send Message</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    
    <div class="modal fade" id="viewMsgModal" tabindex="-1" role="dialog" aria-labelledby="msgModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="msgModal">Message</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">-</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/admin/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>assets/admin/js/sb-admin-2.min.js"></script>
    
    <script>
        jQuery(document).ready(function() {
            jQuery('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        showstudentdiv( jQuery('select[name="usertype"]').val() );
        function showstudentdiv(id) {
            if( id == '4' ) {
                jQuery('.studentshow').removeClass("hidediv");
            }
        }
        jQuery(document).ready( function() {
            jQuery(document).on('change', 'select[name="usertype"]', function() {
                let val = jQuery(this).val();
                if( val == '4' ) {
                    jQuery('.studentshow').removeClass("hidediv");
                } else {
                    jQuery('.studentshow').addClass("hidediv");
                }
            });
        });
        jQuery(".viewfeedback").click( function() {
            let fid = jQuery(this).attr("data-id");
            let attach = jQuery(this).attr("data-attach");
            let date = jQuery(this).find(".date").text();
            let title = jQuery(this).find(".title").text();
            let desc = jQuery(this).find(".desc").text();
            jQuery("#viewFeedbackModal").find(".modal-title").html(title + " - " + date);
            jQuery("#viewFeedbackModal").find(".modal-body").html(desc);
            jQuery("#viewFeedbackModal").find(".attachfile").attr("href", "/assets/uploads/feedback/"+attach);
            jQuery.ajax({
                method: "POST",
                url: "/portal/seenfeedback/",
                data: { id: fid }
            }).done(function( msg ) {
                jQuery(".viewfeedback"+fid).remove();
                let feedbackcounter = parseInt( jQuery(".feedback-counter").text() );
                jQuery(".feedback-counter").text( feedbackcounter - 1 );
            });
        });
        
        jQuery(".sendmessagebtn").click( function() {
            let sid = jQuery(".supervisor_msg_id").val();
            let content = jQuery(".supervisor_msg_content").val();
            if( content != '' ) {
                jQuery.ajax({
                    method: "POST",
                    url: "/portal/sendmessagetoadmin/",
                    data: { sid: sid, content: content }
                }).done(function( msg ) {
                    jQuery("#sendMessageModal").modal("hide");
                    alert("Message submitted!");
                });
            } else {
                alert("Message is required!");
            }
        });
        jQuery(".viewmsg").click( function() {
            let mid = jQuery(this).attr("data-id");
            let from_ = jQuery(".msg_from_field"+mid).text();
            let content = jQuery(".msg_content_field"+mid).text();
            jQuery("#viewMsgModal").find(".modal-title").html(" Message From " + from_);
            jQuery("#viewMsgModal").find(".modal-body").html(content);
            jQuery.ajax({
                method: "POST",
                url: "/portal/seenmessage/",
                data: { id: mid }
            }).done(function( msg ) {
                jQuery(".viewmsg"+mid).remove();
                let messagecounter = parseInt( jQuery(".message-counter").text() );
                jQuery(".message-counter").text( messagecounter - 1 );
            });
        });
    </script>

</body>

</html>