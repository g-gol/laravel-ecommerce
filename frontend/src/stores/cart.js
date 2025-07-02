import {defineStore} from "pinia";
import axiosClient from "../axios.js";

const useCartStore = defineStore('cart', {
    state: () => ({
        items: [],
        count: 0,
        total: 0
    }),
    actions: {
        fetchCart() {
            return axiosClient.get('/api/cart/preview')
                .then(({data}) => {
                    this.items = data.data.items
                    this.count = data.data.count
                    this.total = data.data.total_price
                })
        },
        addToCart(productId, quantity = 1) {
            axiosClient.put('/api/cart/items', {
                product_id: productId,
                quantity: quantity,
            }).then(() => {
                this.fetchCart()
            })
        },
        removeItem(itemId) {
            axiosClient.delete(`/api/cart/items/${itemId}`)
                .then(this.fetchCart)
        },
        unsetCart() {
            this.items = []
            this.count = 0
            this.total = 0
        }
    }
})

export default useCartStore