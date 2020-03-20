<template>
    <article>
        <div id="product">
            <div class="container">
                <a class="go-back-link" href="#" @click="$router.push('/')"><i class="fa fa-arrow-left"></i> Go back</a><br/>
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
            console.log("entro aqui");
            let currentObj = this;
                const config = {
                        headers: {
                            'content-type': 'multipart/form-data',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        }
                }

                let formData = new FormData();
                formData.append('slug', this.slug);

                axios.post('/api/products/'+this.slug, formData, config)
                    .then(function (response) {
                        currentObj.product=response.data;
                    })
                    .catch(function (error) {
                    currentObj.output = error;
                });
        },
        data() {
            return {
                slug: this.$route.params.slug,
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

                axios.post('/cart/add/', formData, config)
                    .then(function (response) {
                        window.location.href="/cart"
                    })
                    .catch(function (error) {
                    currentObj.output = error;
                });
            }
        }
    }
</script>