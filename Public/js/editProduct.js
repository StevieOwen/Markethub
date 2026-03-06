const data = JSON.parse(localStorage.getItem('selectedProduct'));
const h2=document.querySelector("h2");
const item_id=data.item_id;
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

const cancel_btn=document.querySelector("#cancel-btn");

cancel_btn.addEventListener("click",(e)=>{
    window.location.href="/dashboard";
})

fetch(`/showProductEdit`,{
    method: 'POST',
     headers: {'Content-Type': 'application/json',},
    body: JSON.stringify({item_id:item_id })
}).then(response=>response.json())
.then(data=>{
    console.log(data['item']['item_name'])
    document.querySelector("#item_name").value=`${data['item']['item_name']}`;
    document.querySelector("#item_brand").value=`${data['item']['item_brand']}`;
    document.querySelector("#item_price").value=`${data['item']['item_price']}`;
    document.querySelector("#item_quantity").value=`${data['item']['item_quantity']}`;
    document.querySelector("#item_material").value=`${data['item']['item_quantity']}`;
    document.querySelector("#previewImg").src+=`${data['item']['img_name']}`;
    document.querySelector("#item_description").value=`${data['item']['item_description']}`;
    

    
})
.catch(error => console.log("Error: " + error))

const form=document.querySelector("#productForm");

form.addEventListener("submit",(e)=>{
    e.preventDefault();

    const item_name=form.querySelector("#item_name");
    const item_brand=form.querySelector('#item_brand');
    const item_category=form.querySelector('#item_category');
    const item_price=form.querySelector('#item_price');
    const item_quantity=form.querySelector('#item_quantity');
    const item_material=form.querySelector('#item_material');
    const item_size=form.querySelector('#item_size');
    const item_forgender=form.querySelector('input[name="item_forgender"]:checked');
    const item_description=form.querySelector('#item_description');
    const item_image=form.querySelector("#item_image");
    const add_product=form.querySelector('#add_product');

    const formData = new FormData();

        formData.append("item_name", item_name.value);
        formData.append("item_price", item_price.value );
        formData.append("item_quantity", item_quantity.value );
        formData.append("item_image", item_image.files[0]);
        formData.append("item_id", item_id);
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

        fetch(`/editProduct`, {
            method: 'POST',
           body: formData
        }).then(response=>response.json())
          .then(data=>{
            if(data.status=="Successfully edited"){
            
                const modal = document.querySelector("#editModal");
                document.getElementById("modal-text").textContent=`Product ${item_name.value} successfully edited`;
                if (modal) {
                    modal.setAttribute("style", "display: flex !important;");
                    console.log("Modal should be visible now");
                } else {
                    
                }
                 setTimeout(() => {
                    window.location.href = "/dashboard";
                }, 1500);
            }
          })
          .catch(error => alert("Error: " + error))
})
