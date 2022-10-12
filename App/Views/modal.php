    <!-- modal form-->
    <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="form-title"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <div style="font-size: 13px;" class="text-danger d-none" id="message-name"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Category</label>
                            <select class="form-control" id="category" name="category">
                                <?php
                                foreach ($menus as $value) {
                                    echo '<option class="cate-option" value="' . $value['id'] . '">' . $value['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Product Image</label>
                            <input type="file" class="form-control" style="border: 0;" id="uploadFile" name="file">
                            <div style="font-size: 13px;" class="text-danger d-none" id="message-thumb"></div>
                            <img src="" style="width: 80px; margin-top: 10px;" class="d-none" alt="" id="img">
                            <input type="hidden" name="thumb" id="thumb">
                        </div>
                </div>
                <div class="modal-footer justify-content-start">
                    <button id="send" type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal deltail -->
    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalScrollableTitle">Product detail</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 id="detail-name"></h4>
                    <h5 id="detail-category">Category: </h5>
                    <img id="detail-img" src="" style="width: 100%;" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- confirm modal -->
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="confirm-message"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" id="confirm-yes" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>