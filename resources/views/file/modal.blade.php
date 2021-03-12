<div class="modal" tabindex="-1" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Successfully</h5>
                <button type="button" class="closeModal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>

                    <input type="text" style="border: none"  value="{{route('file',['slug'=>$file->slug])}}" id="linkFile" readonly>
                </div>

                <span style="font-size: 48px; color: Dodgerblue;" class="copyLink">
                            <i class="fa fa-copy" id="copyLink"></i>
                </span>
                <span style="font-size: 48px; color: Dodgerblue;" >
                    <a href="{{route('file',['slug'=>$file->slug])}}" target="_blank">
                       <i class="fa fa-external-link-square" aria-hidden="true"></i>

                    </a>
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeModal " >Close</button>
            </div>
        </div>
    </div>
</div>

