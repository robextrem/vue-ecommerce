/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');

window.axios = require('axios').default;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

Vue.component('file-upload-component', require('./components/FileUpload.vue').default);

const btndelete = new Vue({
    el: '#app',
    methods: {
        deleteUser: function (id, evt) {
          evt.preventDefault();
          if(confirm("Are you sure?")){
            axios({
                method:"post",
                url:'/admin/users/delete',
                data:{
                    id: id
                }
            }).then(function (response) {
                window.location.reload();
            })
          }
        },
        deleteProduct: function (id, evt) {
            evt.preventDefault();
            if(confirm("Are you sure?")){
              axios({
                  method:"post",
                  url:'/admin/products/delete',
                  data:{
                      id: id
                  }
              }).then(function (response) {
                  window.location.reload();
              })
            }
          }
      }
});

