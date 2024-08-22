const tl = document.querySelector(".woocommerce-product-attributes-item--attribute_pa_maintenance")?.querySelector(".woocommerce-product-attributes-item__value")
console.log(tl)
const arr = tl?.textContent?.trim().split(",")
console.log(arr)
if (tl) {
    tl.innerHTML = "<h1>IS THIS WORKING?</h1>"
}
