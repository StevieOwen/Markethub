
document.addEventListener("DOMContentLoaded",function(){
    loadCategory();
    
})

function loadCategory(query=""){

   let list=document.querySelector("#category");
   
   fetch(`/category`)
        .then(response => response.json())
        .then(data => {
           data['category'].forEach((dat)=>{
            let li=document.createElement('li');
            li.classList.add("mb-2");
                li.innerHTML=`
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="" value="${dat["cat_name"]}" id="${dat["cat_id"]}">
                <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="${dat["cat_id"]}">
                    <span id="category">${dat["cat_name"]}</span>
                    <span class="badge rounded-pill bg-light text-muted border">8</span>
                </label>
            </div>
           `
          list.appendChild(li);

        })
    })

}



function filterCategory(){
    // 1. Collect the checked values into an array
   const checkboxes = document.querySelectorAll(".form-check-input:checked");
   const selectedCategories = Array.from(checkboxes).map(cb => cb.value);

   // 2. The "Request" configuration
    fetch(`/categoryfilter`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ categories: selectedCategories }) // Send as JSON string
    })
    .then(response => response.json()) // 3. Get the "Response" back
    .then(data => {
        alert("Filtered products from PHP:", data)
        // console.log("Filtered products from PHP:", data);
        // Here you would update your UI with the filtered products
    })
    .catch(error => console.error('Error:', error));
     
}
document.querySelector(".list-unstyled").addEventListener('change', function(e) {
    // Only run if the thing clicked was actually a checkbox
    if (e.target.classList.contains('form-check-input')) {
        filterCategory();
    }
});


//fetching product from database
fetch(`/renderproducts`)
.then(response=>response.json())
.then(data=>{
    const product_grid=document.querySelector('.products-grid');
    const items=data['items'];
    
    items.forEach((item)=>{
        const prod_img=`<img src="${URLROOT}/uploads/items/${item['img_name']}" class="img-fluid w-100" alt="Product">`;
        product_grid.innerHTML+=`<div class="col-12 col-6 col-lg-4">
                                    <div class="product-card border-0">
                                        <div class="position-relative overflow-hidden bg-light rounded">
                                            <!-- <span class="badge bg-danger position-absolute m-2">Hot</span> -->
                                            ${prod_img}
                                            <button class="btn btn-white position-absolute bottom-0 start-50 translate-middle-x mb-2 shadow-sm w-75 opacity-0 btn-quickview">Quick View</button>
                                        </div>
                                        <div class="pt-3">
                                            <h6 class="mb-1 fw-bold">${item['item_name']}</h6>
                                            <p class="text-primary fw-bold mb-1">${item['item_price']}</p>
                                            <div class="text-warning small">★★★★☆ <span class="text-muted">(2 reviews)</span></div>
                                        </div>
                                    </div>
                                </div>`
    })

})
.catch(error => console.error('Error:', error));

