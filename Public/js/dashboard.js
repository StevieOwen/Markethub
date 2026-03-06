const cust_id=document.querySelector("#cust_id");
const side_menu=document.querySelector(".side-menu");
const menu_item=document.querySelectorAll(".menu-item");
const sections=document.querySelectorAll('section');
const sidebar = document.getElementById('sidebar');

//switch the active link on the side menu
side_menu.addEventListener("click",(e)=>{
    menu_item.forEach((item)=>{
        item.classList.remove("active");
})
    e.target.parentElement.classList.add("active");

})

//switch section
sidebar.addEventListener('click', (e) => {
    e.preventDefault()
    const link = e.target.closest('.menu-item'); // Find the clicked link
    if (!link) return; // Exit if something else was clicked

    const targetId = link.getAttribute('data-target');
    
    sections.forEach((section) => {
        if (section.id === targetId) {
            section.classList.remove('hide');
        } else {
           
                section.classList.add('hide');
            
           
        }
    });
});


//we send the cust_id to php to fetch the shop information

fetch(`/renderShopInfos`, {
     method: 'POST',
     headers: {'Content-Type': 'application/json',},
    body: JSON.stringify({id: cust_id.value })
})
.then(response=>response.json())
.then(data=>{
    document.querySelector("#shopLogo").src+=data['shop']['shop_logo'];
    document.querySelector("#shopName").textContent=data['shop']['shop_name'];
    document.querySelector('#welcome').textContent=`Welcome ${data['shop']['cust_firstname']}`;
    document.querySelector("#shopContact").textContent=data['shop']['shop_contact'];
    
});

// button for side menu on small screen

const mobileToggle = document.getElementById('mobileToggle');


mobileToggle.addEventListener('click', () => {
    sidebar.classList.toggle('open');
});

// Close sidebar when clicking outside on mobile
document.addEventListener('click', (e) => {
    if (window.innerWidth <= 768 && 
        !sidebar.contains(e.target) && 
        !mobileToggle.contains(e.target)) {
        sidebar.classList.remove('open');
    }
});


//image preview for dashboard add product section

document.getElementById('item_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('previewImg');
    // const placeholder = document.querySelector('.upload-placeholder');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            preview.src = event.target.result;
            preview.style.display = 'block';
            // placeholder.style.display = 'none';
        }
        reader.readAsDataURL(file);
    }
});



// Section add product: adding product to the database

const addproductform=document.querySelector("#productForm");

addproductform.addEventListener("submit",(e)=>{
    e.preventDefault();
    
    const item_name=addproductform.querySelector("#item_name");
    const item_brand=addproductform.querySelector('#item_brand');
    const item_category=addproductform.querySelector('#item_category');
    const item_price=addproductform.querySelector('#item_price');
    const item_quantity=addproductform.querySelector('#item_quantity');
    const item_material=addproductform.querySelector('#item_material');
    const item_size=addproductform.querySelector('#item_size');
    const item_forgender=addproductform.querySelector('input[name="item_forgender"]:checked');
    const item_description=addproductform.querySelector('#item_description');
    const item_image=addproductform.querySelector("#item_image");
    const add_product=addproductform.querySelector('#add_product');

    document.querySelectorAll('.error-text').forEach(el => el.innerText = "");
    
    let isValid=true;

    if(item_name.value===""){
        document.querySelector("#emptyName").textContent="The item name is required";
        isValid=false;
    }

    if(item_price===""){
        document.querySelector("emptyPrice").textContent="The item price is required";
        isValid=false;
     }   

     if(item_quantity===""){
        document.querySelector("#emptyQuantity").textContent="The item quantity is required";
        isValid=false;
     }
     if (!item_image.files[0]){
           document.querySelector("#emptyImage").textContent="An item image is required";
           isValid=false;
        }

     if (isValid) {
        //to send the image and texts we use formData instead of json
        const formData = new FormData();

        console.log(item_category.value);

        formData.append("item_name", item_name.value);
        formData.append("item_price", item_price.value );
        formData.append("item_quantity", item_quantity.value );
        formData.append("item_image", item_image.files[0]);
        formData.append("item_seller", cust_id.value);
        if(item_brand!=""){
            formData.append("item_brand", item_brand.value);
        }

        if(item_category!=""){
            formData.append("item_category", item_category.value);
        }

        if(item_material!=""){
            formData.append("item_material", item_material.value);
        }

        if(item_size!=""){
            formData.append("item_size", item_size.value);
        }

        if(item_forgender){
            formData.append("item_forgender", item_forgender.value);
        }
        
        if(item_description!=""){
            formData.append("item_description", item_description.value);
        }

         fetch(`/addProduct`, {
            method: 'POST',
           body: formData
        }).then(response=>response.json())
          .then(data=>{
            if(data.status=="Successfully added"){
            
                const modal = document.querySelector("#successModal");
                document.getElementById("modal-text").textContent=`Product ${item_name.value} successfully added`;
                if (modal) {
                    modal.setAttribute("style", "display: flex !important;");
                    console.log("Modal should be visible now");
                } else {
                    console.error("Could not find #successModal in the DOM");
                }
                 setTimeout(() => {
                    window.location.href = "/dashboard";
                }, 1500);
            }
          })
          .catch(error => alert("Error: " + error))
         
     }   

   

})


//Inventory section, we fetch items from the database and display to the user

fetch(`/renderproducts`)
.then(response=>response.json())
.then(data=>{
    let items=data['items'];
    let inventoryBody=document.getElementById('inventoryBody');
    const modal = document.querySelector("#deleteModal");
    items.forEach(item=>{
        
        const img_tag= `<img src="${URLROOT}/uploads/items/${item['img_name']}"  alt="" class="table-img">`;

        inventoryBody.innerHTML+=`<tr>
                                    <form class="inventory_form" action="" method="POST">
                                    <td>
                                        <div class="product-info">
                                           <span class="img-container">${img_tag} </span>
                                            <div>
                                                <span class="p-name">${item['item_name']}</span>
                                                <small class="p-brand">${item['cust_firstname']}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>${item['item_category']}</td>
                                    <td>${item['item_price']}</td>
                                    <td>${item['item_quantity']}</td>
                                    
                                    <td class="status-column">
                                        <div class="edit-controls d-none">
                                            <button class=" save-btn btn btn-sm btn-success rounded-pill px-3 me-1 shadow-sm">
                                                <i class="bi bi-check-lg"></i>
                                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d='m6 13.626 1.606 1.722c.886.95 1.329 1.424 1.825 1.574.436.131.9.096 1.315-.1.473-.224.852-.761 1.612-1.836L18 7'/></svg>
                                            </button>
                                            <button class="btn cancel-btn btn-sm btn-outline-secondary rounded-pill px-3 opacity-75">
                                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d='M18 6 6 18M6 6l12 12'/></svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            <input type="hidden" value="${item['item_id']}" id="prod_id">
                                            <button class="edit-btn" " title="Edit">Edit<i class="fas fa-edit"></i></button>
                                            <button class="delete-btn"  title="Delete">Delete<i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                    </form>
                                </tr>
        
                                 `
        
           
    })

    
    const prod_id=document.querySelector('#prod_id');
    const btn_controls=document.querySelector('.edit-controls');
    inventoryBody.addEventListener("click",(e)=>{
        // if clicked on edit-button
        if(e.target.classList.contains('edit-btn')){
           const productData = { item_id:e.target.previousElementSibling.value  };
           localStorage.setItem('selectedProduct', JSON.stringify(productData));
           //renders edit page
            window.location.href="/renderedit";
        }
        
        //   if clicked on delete button     
        if(e.target.classList.contains('delete-btn')){
             if (modal) {
                    modal.setAttribute("style", "display: flex !important;");
                    const not_del=modal.querySelector(".not-del");
                    const p=modal.querySelector("#modal-p");
                    const del_prod=modal.querySelector("#del_prod")
                    const del_btn=modal.querySelector(".del-btn");
                    del_prod.value=e.target.previousElementSibling.previousElementSibling.value;
                    p.textContent= `Are you sure you want to delete this item?`;
                    not_del.addEventListener('click',(e)=>{
                        modal.setAttribute("style", "display:none !important;");
                    })
                    //send the item id to delete
                    del_btn.addEventListener("click",(e)=>{
                        fetch(`/deleteProduct`,{
                           method: 'POST',
                           headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ item_id: del_prod.value})      
                        }).then(response=>response.json())
                          .then(data=>{
                            if(data.status=="Successfully delete"){
                                modal.setAttribute("style", "display:none !important;");

                                const delModal=document.querySelector("#successDelModal");
                                if (delModal) {
                                    delModal.setAttribute("style", "display: flex !important;");
                                    
                                } 
                                setTimeout(() => {
                                    window.location.href = "/dashboard";
                                }, 1500);

                            }
                          })
                          .catch(error => console.log("Error: " + error))  
                    })

                }
           
        }
    })
  

})
.catch(error => console.log("Error: " + error))