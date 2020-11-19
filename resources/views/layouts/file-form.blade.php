<div class="container">
    <div class="form-container">
        <form id="new-file-form" action="#" method="#" @submit.prevent="submitForm">
            <div class="form-group">
                <p class="help-block">Please Choose Image: </p>
                        <input class="form-control file-input" type="file" ref="file" name="file" @change="addFile()" placeholder="Please choose your image">
                    <button type="submit" class="form-control btn button is-primary">
                        Upload
                    </button>
            </div>
        </form>
    </div>
</div>
