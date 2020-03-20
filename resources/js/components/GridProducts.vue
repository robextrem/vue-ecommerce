<template>
    <article>
        <div class="columns is-multiline is-mobile" v-if="!isproduct">
            <div class="column is-3" v-for="result in results">
                    <div class="card" v-on:click="getProduct(result.id, $event)" :data-slug="result.slug">
                        <div class="card-image">
                            <figure class="image is-4by3">
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
                                <button class="button is-primary add-to-cart-btn" v-on:click="addToCart(product.id, $event)">Add to cart</button>
                                <button class="button is-primary is-outlined">
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
        <div id="product" v-if="isproduct">
            <div class="container">
                <div class="columns">
                    <div class="column is-4">
                        <img :src="product.image" alt="Placeholder image">
                    </div>
                    <div class="column is-7 is-offset-1 has-text-left">
                        <h1 class="is-size-2 title">{{product.name}}</h1>
                        <h2 class="is-size-5 price">${{number_format(product.price,2,".",",")}} {{currency}}</h2>
                        <p class="description">{{product.description}}</p>
                        <button class="button is-primary is-medium add-to-cart-btn" v-on:click="addToCart(product.id, $event)">Add to cart</button>
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
                currency: "MXN"
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
                alert("agregado a carrito");
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