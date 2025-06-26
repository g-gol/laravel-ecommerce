import {defineStore} from "pinia";
import axiosClient from "../axios.js";

const useCartStore = defineStore('cart', {
    state: () => ({
        items: [],
        count: null,
        total: null
    }),
    actions: {
        fetchCart() {
            return axiosClient.get('/api/cart/preview')
                .then(({data}) => {
                    this.items = data.items
                    this.count = data.count
                    this.total =  data.total_price
                })
        },
        addToCart(productId, quantity = 1) {
            axiosClient.put('/api/cart/add', {
                product_id: productId,
                quantity: quantity,
            }).then(() => {
                this.fetchCart()
            })
        }
    }
})

export default useCartStore