<template>
    <article>
        <div class="container">
            <div class="columns is-multiline is-mobile">
                <div class="column is-3" v-for="result in results">
                        <div class="card" :data-slug="result.slug">
                            <div class="card-image" @click="$router.push('product/'+result.slug)">
                                <figure class="image">
                                <img :src="result.image" :alt="result.name">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                <div class="media-content">
                                    <p class="title is-4">{{result.name}}</p>
                                    <p class="subtitle is-6">${{number_format(result.price,2,".",",")}} {{currency}}</p>
                                </div>
                                </div>
                                <div class="content">
                                    <button class="button is-primary add-to-cart-btn" v-on:click="addToCart(result.id, $event)">Add to cart</button>
                                    <button class="button is-primary is-outlined" @click="$router.push('product/'+result.slug)">
                                        <span>Details</span> 
                                        <span class="icon is-small">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </article>
</template>

<script>
    export default {
        mounted() {
            axios.post("/api/products")
            .then(response => {this.results = response.data})
        },
        data() {
            return {
                results: [],
                isproduct: false,
                product:{},
                currency: ""
            };
        },
        methods:{
            number_format(number, decimals, dec_point, thousands_sep) {
                number = number * 1;//makes sure `number` is numeric value
                var str = number.toFixed(decimals ? decimals : 0).toString().split('.');
                var parts = [];
                for (var i = str[0].length; i > 0; i -= 3) {
                    parts.unshift(str[0].substring(Math.max(0, i - 3), i));
                }
                str[0] = parts.join(thousands_sep ? thousands_sep : ',');
                return str.join(dec_point ? dec_point : '.');
            },
            addToCart(product_id, event){
                event.stopPropagation();
                let currentObj = this;
                const config = {
                        headers: {
                            'content-type': 'multipart/form-data',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        }
                }

                let formData = new FormData();
                formData.append('id', product_id);

                axios.post('/cart/add', formData, config)
                    .then(function (response) {
                        window.location.href="/cart"
                    })
                    .catch(function (error) {
                    currentObj.output = error;
                });
            },
            getProduct(product_id,event){
                event.stopPropagation();
                let currentObj = this;
                const config = {
                        headers: {
                            'content-type': 'multipart/form-data',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        }
                }

                let formData = new FormData();
                formData.append('id', product_id);

                axios.post('/api/products/'+product_id, formData, config)
                    .then(function (response) {
                        currentObj.isproduct=true;
                        currentObj.product=response.data;
                    })
                    .catch(function (error) {
                    currentObj.output = error;
                });
            }
        }
    }
</script>