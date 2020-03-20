<template>
    <div id="file-uploader" class="columns is-vcentered is-centered">
            <div v-if="success !== ''" class="image-preview">
                <img :src="filename"><br/>
                <a class="delete is-medium" v-on:click="removeImage"></a>
            </div>
            <div class="clearfix"></div>
            <div v-if="success == ''" class="file is-link" id="file-button" v-on:change="onFileChange">
                <label class="file-label">
                    <input class="file-input" type="file" name="resume">
                    <span class="file-cta">
                    <span class="file-icon">
                        <i class="fa fa-upload"></i>
                    </span>
                    <span class="file-label">
                        Choose a file…
                    </span>
                    </span>
                </label>
            </div>
        </div>
</template>

<script>
    export default {
        mounted() {
            if(this.filename!==""){
                this.success=1;
            }
        },
        data() {
            return {
                filename: document.getElementById("imageUrl").value,
                file: '',
                success: ''
            };
        },
        methods: {
            removeImage(){
                if(confirm("Are you sure?")){
                    let currentObj = this;
                    const config = {
                        headers: {
                            'content-type': 'multipart/form-data',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        }
                    }

                    let formData = new FormData();
                    formData.append('id', document.getElementById("id").value);
                    axios.post('/api/media/delete', formData, config)
                        .then(function (response) {
                            currentObj.success = '';
                            currentObj.filename = '';
                        })
                        .catch(function (error) {
                            currentObj.output = error;
                        });
                }
            },
            onFileChange(e) {
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            
                e.preventDefault();
                let currentObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                }

                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('id', document.getElementById("id").value);

                // send upload request
                axios.post('/api/media', formData, config)
                    .then(function (response) {
                        currentObj.success = response.data.success;
                        currentObj.filename = response.data.url;
                        alert("The image has been attached to this product");
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
            }
        }
    }
</script>