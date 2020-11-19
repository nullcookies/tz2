<div id="myModalBox" class="modal" :class="{'is-active' : modalActive}">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" @click="closeModal()">×</button>
            </div>
            <div class="modal-body">
                <p class="image">
                    <img v-if="Object.keys(file).length !== 0" src=""  :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/image/' + file.original_image" :alt="file.original_image">
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" @click="closeModal()">Закрыть</button>
            </div>
        </div>
    </div>
</div>
